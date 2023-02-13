<?php

namespace App\Http\Controllers\Administracion;;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCaracteristicaRequest;
use App\Http\Requests\UpdateCaracteristicaRequest;
use App\Models\Caracteristica;
use App\Services\CaracteristicaService;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;

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
    public function store(StoreCaracteristicaRequest $request)
    {
        try {
            CaracteristicaService::registrarCaracteristica($request);
            return response()->json(['success' => '¡La caracteristica se ha registrado correctamente!'], 200);
        } catch (\Throwable $th) {
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
    public function update(UpdateCaracteristicaRequest $request, Caracteristica $caracteristica)
    {
        try {
            CaracteristicaService::actualizarCaracteristica($request, $caracteristica);
            return response()->json(['success' => '¡La caracteristica se ha actualizado correctamente!'], 200);
        } catch (\Throwable $th) {
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
        try {
            $caracteristica->delete();
            return response()->json(['success' => '¡La caracteristica se ha eliminado correctamente!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }
}
