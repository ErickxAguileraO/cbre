<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Certificacion\RegistroCertificacionRequest;
use App\Http\Requests\Certificacion\ModificacionCertificacionRequest;
use App\Models\Certificacion;
use App\Services\ImagenService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CertificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.certificaciones.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.certificaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistroCertificacionRequest $request)
    {
        try {
            $pathImagen = ImagenService::subirImagen($request->file('imagen'), 'certificaciones');
            
            if ( !$pathImagen ) {
                return response()->error('No se pudo subir la imagen.', null);
            }
            
            $certificacion = Certificacion::create([
                'cer_imagen' => $pathImagen,
                'cer_nombre' => $request->nombre,
                'cer_posicion' => $request->posicion,
                'cer_estado' => $request->estado
            ]);
    
            return response()->success($certificacion, 201);
        } catch (\Exception $exc) {
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
        $certificacion = Certificacion::find($id);
        
        return view('admin.certificaciones.edit', ['certificacion' => $certificacion]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModificacionCertificacionRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $certificacion = Certificacion::findOrFail($id);

            if ($request->file('imagen') !== null) {
                Storage::delete($certificacion->cer_imagen);
                $pathImagen = ImagenService::subirImagen($request->file('imagen'), 'certificaciones');

                if ( !$pathImagen ) {
                    return response()->error('No se pudo subir la imagen.', null);
                }

                $certificacion->cer_imagen = $pathImagen;
            }

            $certificacion->cer_nombre = $request->nombre;
            $certificacion->cer_posicion = $request->posicion;
            $certificacion->cer_estado = $request->estado;
            $certificacion->save();

            DB::commit();

            return response()->success($certificacion, 201);
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
    public function destroy($certificacion)
    {
        DB::beginTransaction();

        try {
            $certificacion = Certificacion::findOrFail($certificacion);
            $certificacion->edificios()->detach();
            Storage::delete($certificacion->cer_imagen);
            $certificacion->delete();
            
            DB::commit();

            return response()->success($certificacion, 204);
        } catch (\Exception $exc) {
            DB::rollback();

            return response()->error($exc->getMessage(), null);
        }
    }

    public function list()
    {
        return Certificacion::orderByDesc('created_at')->get();
    }
}
