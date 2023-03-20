<?php

namespace App\Http\Controllers\Administracion;
use App\Models\Region;
use App\Models\DatoGeneral;
use Illuminate\Http\Request;
use App\Services\ImagenService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\DatosGeneralesService;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\DatoGeneral\ModificacionDatoGeneralRequest;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get(Request $request){
        return DatoGeneral::with(['comuna.region'])->first();
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
    public function update(ModificacionDatoGeneralRequest $request, $datosGenerales)
    {
        DB::beginTransaction();

        try {
            $datoGeneral = DatoGeneral::findOrFail($datosGenerales);
            $datoGeneral->update([
                'dag_comuna_id' => $request->input('comuna'),
                'dag_direccion' => $request->input('direccion'),
                'dag_telefono_uno' => $request->input('telefono_uno'),
                'dag_telefono_dos' => $request->input('telefono_dos'),
                'dag_facebook' => $request->input('facebook'),
                'dag_linkedin' => $request->input('linkedin'),
                'dag_instagram' => $request->input('instagram'),
                'dag_twitter' => $request->input('twitter'),
                'dag_youtube' => $request->input('youtube'),
                'dag_email_encargado' => $request->input('email'),
                'dag_nombre_encargado' => $request->input('nombre'),
                'dag_telefono_encargado' => $request->input('telefono'),
                'dag_cargo_encargado' => $request->input('cargo'),
            ]);

            if ($request->hasFile('imagen')) {
                Storage::delete($datoGeneral->dag_imagen_encargado);
                $datoGeneral->update([
                    'dag_imagen_encargado' => ImagenService::subirImagen($request->file('imagen'), 'datos_generales'),
                ]);
            }

            DB::commit();

            return response()->json(['success' => '¡Los datos generales se han actualizado correctamente!'], 200);
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
    public function destroy($id)
    {
        //
    }
}
