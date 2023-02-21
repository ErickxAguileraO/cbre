<?php

namespace App\Http\Controllers\Administracion;;

use Illuminate\Http\Request;
use App\Models\Caracteristica;
use App\Services\ImagenService;
use PhpParser\Node\Stmt\TryCatch;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\CaracteristicaService;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Caracteristica\RegistroCaracteristicaRequest;
use App\Http\Requests\Caracteristica\ModificacionCaracteristicaRequest;

class CaracteristicaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.caracteristicas.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        try {
            return Caracteristica::orderBy('car_posicion', 'asc')->get();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.caracteristicas.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistroCaracteristicaRequest $request)
    {
        DB::beginTransaction();
        try {
            Caracteristica::create([
                'car_nombre' => $request->nombre,
                'car_posicion' => $request->posicion,
                'car_estado' => $request->estado,
                'car_imagen' => ImagenService::subirImagen($request->file('imagen'), 'caracteristicas'),
            ]);
            DB::commit();
            return response()->json(['success' => '¡La característica se ha registrado correctamente!'], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => $th->getMessage()], 401);
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
    public function edit(Caracteristica $caracteristica)
    {
        return view('admin.caracteristicas.edit', compact('caracteristica'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModificacionCaracteristicaRequest $request, Caracteristica $caracteristica)
    {
        DB::beginTransaction();
        try {
            $caracteristica->update([
                'car_nombre' => $request->input('nombre'),
                'car_posicion' => $request->input('posicion'),
                'car_estado' => $request->input('estado'),
            ]);
            if ($request->hasFile('imagen')) {
                Storage::delete($caracteristica->car_imagen);
                $caracteristica->update([
                    'car_imagen' => ImagenService::subirImagen($request->file('imagen'), 'caracteristicas'),
                ]);
            }
            DB::commit();
            return response()->json(['success' => '¡La característica se ha actualizado correctamente!'], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Caracteristica $caracteristica)
    {
        DB::beginTransaction();
        try {
            $caracteristica->edificios()->detach();
            Storage::delete($caracteristica->car_imagen);
            $caracteristica->delete();
            DB::commit();
            return response()->json(['success' => '¡La característica se ha eliminado correctamente!'], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }
}
