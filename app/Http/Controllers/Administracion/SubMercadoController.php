<?php

namespace App\Http\Controllers\Administracion;

use App\Models\Comuna;
use App\Models\Region;
use App\Models\SubMercado;
use Illuminate\Http\Request;
use App\Services\SubmercadoService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubMercado\StoreSubMercadoRequest;

class SubMercadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.submercados.index');
    }

    public function list(){
        return SubMercado::with('comuna.region')->get();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.submercados.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubMercadoRequest $request)
    {
        try {
            SubmercadoService::registrarSubMercado($request);
            return response()->json(['success' => '¡El submercado se ha registrado correctamente!'], 200);
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($subMercado)
    {
        try {
            SubMercado::findOrFail($subMercado)->delete();
            return response()->json(['success' => '¡Submercado se ha eliminado correctamente!'], 200);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }
}
