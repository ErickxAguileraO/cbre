<?php

namespace App\Http\Controllers\Administracion;

use App\Models\Comuna;
use App\Models\Region;
use App\Models\SubMercado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Services\SubmercadoService;
use App\Http\Controllers\Controller;
use App\Http\Requests\SubMercado\RegistroSubMercadoRequest;
use App\Http\Requests\SubMercado\ModificacionSubMercadoRequest;

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

    public function get(Request $request){
        return SubMercado::where('sub_id', $request->subMercado)->with(['comuna.region'])->first();
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
    public function store(RegistroSubMercadoRequest $request)
    {
        DB::beginTransaction();
        try {
            SubMercado::create([
                'sub_nombre' => $request->nombre,
                'sub_estado' => $request->estado,
                'sub_comuna_id' => $request->comuna,
            ]);
            DB::commit();
            return response()->json(['success' => '¡El submercado se ha registrado correctamente!'], 200);
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
    public function edit($subMercado)
    {
        $subMercado = Submercado::findOrFail($subMercado);
        return view('admin.submercados.edit', compact('subMercado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModificacionSubMercadoRequest $request, $subMercado)
    {
        DB::beginTransaction();
        try {
            SubMercado::findOrFail($subMercado)->update([
                'sub_nombre' => $request->nombre,
                'sub_estado' => $request->estado,
                'sub_comuna_id' => $request->comuna,
            ]);
            DB::commit();
            return response()->json(['success' => '¡El Submercado se ha actualizado correctamente!'], 200);
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
    public function destroy($subMercado)
    {
        DB::beginTransaction();
        try {
            SubMercado::findOrFail($subMercado)->delete();
            DB::commit();
            return response()->json(['success' => '¡Submercado se ha eliminado correctamente!'], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }
}
