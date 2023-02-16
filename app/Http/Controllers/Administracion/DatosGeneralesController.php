<?php

namespace App\Http\Controllers\Administracion;
use App\Http\Controllers\Controller;
use App\Http\Requests\DatoGeneral\UpdateDatoGeneralRequest;
use App\Models\DatoGeneral;
use App\Models\Region;
use App\Services\DatosGeneralesService;
use Illuminate\Http\Request;

class DatosGeneralesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.datos_generales.index', ['datos_generales' => DatoGeneral::first()]);
    }

    public function get(Request $request){
        return DatoGeneral::where('dag_id', $request->datosGenerales)->with(['comuna.region'])->first();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    public function update(UpdateDatoGeneralRequest $request, $datosGenerales)
    {
        try {
            DatosGeneralesService::actualizarDatosGenerales($request, DatoGeneral::findOrFail($datosGenerales));
            return response()->json(['success' => '¡Los datos generales se han actualizado correctamente!'], 200);
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
    public function destroy($id)
    {
        //
    }
}
