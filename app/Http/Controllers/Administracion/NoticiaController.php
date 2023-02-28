<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Noticia\RegistroNoticiaRequest;
use App\Http\Requests\Noticia\ModificacionNoticiaRequest;
use App\Models\Noticia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Services\ImagenService;

class NoticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.noticias.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.noticias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistroNoticiaRequest $request)
    {
        DB::beginTransaction();

        try {
            $pathImagen = ImagenService::subirGaleriaCroppie('noticias', $request->imagenesGaleria)[0]['ima_url'];

            if ( !$pathImagen ) {
                return response()->error('No se pudo subir la imagen.', null);
            }

            $noticia = Noticia::create([
                'not_imagen' => $pathImagen,
                'not_titulo' => $request->titulo,
                'not_fecha' => $request->fecha,
                'not_texto' => $request->cuerpo,
                'not_destacada' => $request->has('destacada') ? 1 : 0,
                'not_edificio_id' => $request->edificio
            ]);

            DB::commit();

            return response()->success($noticia, 201);
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
        $noticia = Noticia::find($id);

        return view('admin.noticias.edit', ['noticia' => $noticia]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModificacionNoticiaRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $noticia = Noticia::findOrFail($id);

            if ( $request->imagenesGaleria !== null ) {
                Storage::delete($noticia->not_imagen);
                $pathImagen = ImagenService::subirGaleriaCroppie('noticias', $request->imagenesGaleria)[0]['ima_url'];

                if ( !$pathImagen ) {
                    return response()->error('No se pudo subir la imagen.', null);
                }

                $noticia->not_imagen = $pathImagen;
            }

            $noticia->not_titulo = $request->titulo;
            $noticia->not_fecha = $request->fecha;
            $noticia->not_texto = $request->cuerpo;
            $noticia->not_destacada = $request->has('destacada') ? 1 : 0;
            $noticia->not_edificio_id = $request->edificio;
            $noticia->save();

            DB::commit();

            return response()->success($noticia, 201);
        } catch (\Exception $exc) {
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
            $noticia = Noticia::findOrFail($id);
            Storage::delete($noticia->not_imagen);
            $noticia->delete();

            DB::commit();

            return response()->success($noticia, 200);
        } catch (\Exception $exc) {
            DB::rollback();

            return response()->error($exc->getMessage(), null);
        }
    }

    public function list()
    {
        return Noticia::orderByDesc('created_at')->get();
    }
}
