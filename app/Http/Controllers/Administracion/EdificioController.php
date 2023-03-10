<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Edificio\RegistroEdificioRequest;
use App\Http\Requests\Edificio\ModificacionEdificioRequest;
use App\Models\Certificacion;
use App\Models\Caracteristica;
use App\Models\Edificio;
use App\Models\SubMercado;
use App\Models\User;
use App\Models\Funcionario;
use App\Services\ImagenService;
use App\Services\EdificioService;

class EdificioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.edificios.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.edificios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistroEdificioRequest $request)
    {
        DB::beginTransaction();

        try {
            $pathImagenPrincipal = ImagenService::subirImagen($request->file('imagenPrincipal'), 'edificios');

            if ( !$pathImagenPrincipal ) {
                return response()->error('No se pudo subir la imagen.', null);
            }

            $pathImagenListado = ImagenService::subirImagen($request->file('imagenListado'), 'edificios');

            if ( !$pathImagenListado ) {
                return response()->error('No se pudo subir la imagen.', null);
            }

            $edificio = Edificio::create([
                'edi_nombre' => $request->nombre,
                'edi_descripcion' => $request->descripcionTextarea,
                'edi_direccion' => $request->direccion,
                'edi_imagen' => $pathImagenPrincipal,
                'edi_imagen_listado' => $pathImagenListado,
                'edi_submercado_id' => $request->submercado,
                'ubi_titulo' => $request->ubicacionTitulo,
                'ubi_descripcion' => $request->ubicacionDescripcion,
                'edi_latitud' => $request->latitud,
                'edi_longitud' => $request->longitud,
                'edi_video' => $request->video,
                'edi_subdominio' => Str::lower(Str::remove(' ', $request->subdominio))
            ]);

            $imagenesStorage = ImagenService::subirGaleriaCroppie('edificios', $request->imagenesGaleria);
            $edificio->imagenes()->createMany($imagenesStorage);

            foreach ($request->certificaciones as $certificacion) {
                $edificio->certificaciones()->attach($certificacion);
            }

            foreach ($request->caracteristicas as $caracteristica) {
                $edificio->caracteristicas()->attach($caracteristica);
            }

            DB::commit();

            return response()->success($edificio, 201);
        } catch (\Exception $exc) {
            DB::rollback();

            return response()->error($exc->getMessage(), null);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edificio = Edificio::find($id);

        return view('admin.edificios.edit', ['edificio' => $edificio]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModificacionEdificioRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $edificio = Edificio::findOrFail($id);

            if ( $request->file('imagenPrincipal') !== null ) {
                Storage::delete($edificio->edi_imagen);
                $pathImagenPrincipal = ImagenService::subirImagen($request->file('imagenPrincipal'), 'edificios');

                if ( !$pathImagenPrincipal ) {
                    return response()->error('No se pudo subir la imagen.', null);
                }

                $edificio->edi_imagen = $pathImagenPrincipal;
            }

            if ( $request->file('imagenListado') !== null ) {
                Storage::delete($edificio->edi_imagen_listado);
                $pathImagenListado = ImagenService::subirImagen($request->file('imagenListado'), 'edificios');

                if ( !$pathImagenListado ) {
                    return response()->error('No se pudo subir la imagen.', null);
                }

                $edificio->edi_imagen_listado = $pathImagenListado;
            }

            $edificio->edi_nombre = $request->nombre;
            $edificio->edi_descripcion = $request->descripcionTextarea;
            $edificio->edi_direccion = $request->direccion;
            $edificio->edi_submercado_id = $request->submercado;
            $edificio->ubi_titulo = $request->ubicacionTitulo;
            $edificio->ubi_descripcion = $request->ubicacionDescripcion;
            $edificio->edi_latitud = $request->latitud;
            $edificio->edi_longitud = $request->longitud;
            $edificio->edi_video = $request->video;
            $edificio->edi_subdominio = Str::lower(Str::remove(' ', $request->subdominio));
            $edificio->save();

            EdificioService::descartarImagenes($edificio, $request->idImagenes);
            $imagenesStorage = ImagenService::subirGaleriaCroppie('edificios', $request->imagenesGaleria);

            if ( !empty($imagenesStorage) ) {
                $edificio->imagenes()->createMany($imagenesStorage);
            }

            $edificio->certificaciones()->detach();
            $edificio->caracteristicas()->detach();

            foreach ($request->certificaciones as $certificacion) {
                $edificio->certificaciones()->attach($certificacion);
            }

            foreach ($request->caracteristicas as $caracteristica) {
                $edificio->caracteristicas()->attach($caracteristica);
            }

            DB::commit();

            return response()->success($edificio, 201);
        } catch (\Exception $exc) {
            DB::rollback();

            return response()->error($exc->getMessage(), null);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $edificio = Edificio::findOrFail($id);

            $edificio->certificaciones()->detach();
            $edificio->caracteristicas()->detach();

            Storage::delete($edificio->edi_imagen);
            Storage::delete($edificio->edi_imagen_listado);
            EdificioService::eliminarGaleriaImagenes($edificio);
            $edificio->funcionarios()->delete();
            $edificio->comercios()->delete();
            $edificio->delete();

            DB::commit();

            return response()->success($edificio, 200);
        } catch (\Exception $exc) {
            DB::rollback();

            return response()->error($exc->getMessage(), null);
        }
    }

    public function list()
    {
        $usuarioSesion = Auth::user();

        if ( $usuarioSesion->hasRole('funcionario') && $usuarioSesion->funcionario != null ) {
            return $usuarioSesion->funcionario->edificio;
        } else {
            return Edificio::orderByDesc('created_at')->get();
        }
    }
}
