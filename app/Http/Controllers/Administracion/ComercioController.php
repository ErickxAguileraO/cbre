<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Comercio\RegistroComercioRequest;
use App\Http\Requests\Comercio\ModificacionComercioRequest;
use App\Models\Comercio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Services\ImagenService;

class ComercioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.comercios.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.comercios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistroComercioRequest $request)
    {
        DB::beginTransaction();

        try {
            $pathImagen = ImagenService::subirImagen($request->file('imagen'), 'comercios');

            if ( !$pathImagen ) {
                return response()->error('No se pudo subir la imagen.', null);
            }

            $comercio = Comercio::create([
                'loc_nombre' => $request->nombre,
                'loc_imagen' => $pathImagen,
                'loc_descripcion' => $request->descripcion,
                'loc_edificio_id' => $request->edificio
            ]);

            DB::commit();

            return response()->success($comercio, 201);
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
        $comercio = Comercio::find($id);

        return view('admin.comercios.edit', ['comercio' => $comercio]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModificacionComercioRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $comercio = Comercio::findOrFail($id);

            if ($request->file('imagen') !== null) {
                Storage::delete($comercio->loc_imagen);
                $pathImagen = ImagenService::subirImagen($request->file('imagen'), 'comercios');

                if ( !$pathImagen ) {
                    return response()->error('No se pudo subir la imagen.', null);
                }

                $comercio->loc_imagen = $pathImagen;
            }

            $comercio->loc_nombre = $request->nombre;
            $comercio->loc_descripcion = $request->descripcion;
            $comercio->loc_edificio_id = $request->edificio;
            $comercio->save();

            DB::commit();

            return response()->success($comercio, 201);
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
            $comercio = Comercio::findOrFail($id);
            Storage::delete($comercio->loc_imagen);
            $comercio->delete();

            DB::commit();

            return response()->success($comercio, 200);
        } catch (\Exception $exc) {
            DB::rollback();

            return response()->error($exc->getMessage(), null);
        }
    }

    public function list()
    {
        return Comercio::whereHas('edificio', function ($query) {
            $query->whereNull('deleted_at');
        })
        ->orderByDesc('created_at')
        ->get();
    }
}
