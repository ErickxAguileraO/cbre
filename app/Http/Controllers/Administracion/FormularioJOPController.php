<?php

namespace App\Http\Controllers\Administracion;

use App\Models\Respuesta;
use App\Models\Formulario;
use Illuminate\Http\Request;
use App\Models\ArchivoFormulario;
use App\Models\FormularioEdificio;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FormularioJOPController extends Controller
{
    public function index()
    {
        return view('admin.formularios_jop.index');
    }

    public function list(Request $request)
    {
        try {
            $formulario = Formulario::with('funcionario.edificio')
            ->withFilters()
            ->orderByDesc('updated_at')
            ->get();

        // Obtener los nombres de los funcionarios y los nombres de los edificios
        $funcionarios = $formulario->pluck('funcionario.fun_nombre');

        // Agregar los nombres de los funcionarios y los nombres de los edificios al objeto de cada formulario
        foreach ($formulario as $key => $value) {
            $value->creado_por = $funcionarios[$key];
        }

        return response()->json($formulario);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    public function show($id){

        $this->borrarRespuestasBorrador();

        $formulario = Formulario::findOrFail($id);

        foreach($formulario->preguntas as $pregunta){
            $respuesta = new Respuesta();
            $respuesta->res_formulario_edificio_id = FormularioEdificio::where('foredi_formulario_id', $formulario->form_id)->where('foredi_edificio_id', Auth::user()->funcionario->edificio->edi_id)->first()->foredi_id;
            $respuesta->res_pregunta_id = $pregunta->pre_id;
            $respuesta->res_estado = 0;
            $respuesta->save();
        }

        return view('admin.formularios_jop.show', ['formulario' => $formulario]);
    }

    public function deshacerRespuesta(){

        $this->borrarRespuestasBorrador();

        return view('admin.formularios_jop.index');
    }

    public function borrarRespuestasBorrador(){

        $respuestas = Respuesta::where('res_estado', 0)->get();
        $archivos = ArchivoFormulario::whereIn('arcf_respuesta_id', $respuestas->pluck('res_id'))->get();
        $archivos->each->delete();

        foreach($respuestas as $respuesta){
            $respuesta->opciones()->detach();
        }

        $respuestas->each->delete();
    }

    public function postRespuesta(Request $request){
        DB::beginTransaction();
        try {

            $formulario = Formulario::findOrFail($request->input('formValue'));

            if(Auth::user()->funcionario->edificio->edi_id == $formulario->form_id){
                foreach($formulario->preguntas as $pregunta){
                    $respuesta = Respuesta::where('res_pregunta_id', $pregunta->pre_id)->first();
                    $respuesta->res_estado = 1;
                    $respuesta->update();
                }
            }

            DB::commit();

        return response()->json(['success' => '¡Formulario respondido correctamente!'], 200);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
