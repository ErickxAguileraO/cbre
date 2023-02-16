<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\Indicador\UpdateIndicadoresRequest;
use App\Models\Indicador;
use Illuminate\Http\Request;

class IndicadorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.indicadores.index', ['indicadores' => Indicador::first()]);
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
    public function update(UpdateIndicadoresRequest $request, $indicador)
    {
        try {
            Indicador::findOrFail($indicador)->update([
                'ind_administrados' => $request->input('edificios_administrados'),
                'ind_confia_en_nosotros' => $request->input('confia_en_nosotros'),
                'ind_en_todo_chile' => $request->input('en_todo_chile'),
                'ind_en_todo_chile2' => $request->input('en_todo_chile2'),
            ]);
            return response()->json(['success' => '¡Los indicadores se han actualizado correctamente!'], 200);
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
