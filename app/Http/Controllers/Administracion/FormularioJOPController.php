<?php

namespace App\Http\Controllers\Administracion;

use App\Models\User;
use App\Models\Respuesta;
use App\Models\Formulario;
use Illuminate\Http\Request;
use App\Models\ArchivoFormulario;
use App\Models\FormularioEdificio;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FormularioJOPController extends Controller
{
    public function index()
    {
        $this->borrarRespuestasBorrador();

        return view('admin.formularios_jop.index');
    }

    public function list(Request $request)
    {
        try {
            // Obtener el ID del edificio del funcionario logeado
            $edificioId = Auth::user()->funcionario->edificio->edi_id;

            $formulario = Formulario::whereHas('edificios', function ($query) use ($edificioId, $request) {
                // Filtrar por el ID del edificio del funcionario logeado
                $query->where('foredi_edificio_id', $edificioId);

                // Filtrar por el estado seleccionado (si está presente en la solicitud)
                if (isset($request->estado)) {
                    $query->where('formulario_edificio.foredi_estado', $request->estado);
                }
            })->with(['edificios' => function ($query) {
                $query->select('foredi_estado', 'foredi_edificio_id');
                }])
                ->withFilters($request->all())
                ->orderByDesc('updated_at')
                ->get();

            foreach ($formulario as $key => $value) {
                $funcionario = $value->funcionario;
                $prevencionistas = User::role('prevencionista')->pluck('name')->toArray();
                $tecnicos = User::role('tecnico')->pluck('name')->toArray();

                if (in_array($funcionario->fun_nombre, $prevencionistas)) {
                    $value->rol_funcionario = 'Prevencionista';
                } elseif (in_array($funcionario->fun_nombre, $tecnicos)) {
                    $value->rol_funcionario = 'Técnico';
                }

                // Obtener el estado del edificio relacionado
                $edificio = $value->edificios->first();
                if ($edificio) {
                    $value->edificio_id = $edificio->foredi_edificio_id;
                    $value->estado = $edificio->foredi_estado;
                } else {
                    $value->edificio_id = $edificio->foredi_edificio_id;
                    $value->estado = null;
                }
            }

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

        return view('admin.formularios_jop.show', [
            'formulario' => $formulario,
        ]);
    }

    public function deshacerRespuesta(){

        $this->borrarRespuestasBorrador();

        return view('admin.formularios_jop.index');
    }

    public function borrarRespuestasBorrador(){

        $respuestas = Respuesta::where('res_estado', 0)->get();

        foreach($respuestas as $respuesta){
            $respuesta->opciones()->detach();
            Storage::delete($respuesta->res_documentacion);
            Storage::delete($respuesta->res_documento_accidentabilidad);

            $respuesta->archivosFormulario->each(function ($archivo) {
                Storage::delete($archivo->arcf_url);
                $archivo->delete();
            });
        }

        $respuestas->each->delete();
    }

    public function postRespuesta(Request $request){

        DB::beginTransaction();
        try {

            $formulario = Formulario::findOrFail($request->input('formValue'));

                foreach($formulario->preguntas as $pregunta){
                    $respuesta = Respuesta::where('res_pregunta_id', $pregunta->pre_id)
                    ->where('res_formulario_edificio_id', FormularioEdificio::where('foredi_formulario_id', $formulario->form_id)->where('foredi_edificio_id', Auth::user()->funcionario->edificio->edi_id)->first()->foredi_id)
                    ->first();
                    $respuesta->res_estado = 1;
                    $respuesta->update();
                }

            $formEdificio = FormularioEdificio::where('foredi_formulario_id', $formulario->form_id)
            ->where('foredi_edificio_id', Auth::user()->funcionario->edificio->edi_id)
            ->first();
            $formEdificio->foredi_estado = 2;
            $formEdificio->update();

            DB::commit();

            return response()->json(['success' => '¡Formulario respondido correctamente!'], 200);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json(['error' => $th->getMessage()], 500);
        }
    }
}
