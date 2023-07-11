<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formulario;
use App\Models\Edificio;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class FormularioAreaTecnicaController extends Controller
{
    public function index()
    {
        // $edificios = Edificio::all();
        $funcionarios = Formulario::with('funcionario')->get()->pluck('funcionario');
        // dd($funcionarios);
        return view('admin.formulario_area_tecnica.index', compact('funcionarios'));
    }

    public function create()
    {
        //El formulario se crea en primera instancia, quedando como borrador

        $formulario = new Formulario();
        $formulario->form_funcionario_id = Auth::user()->funcionario->fun_id;
        $formulario->form_nombre = '';
        $formulario->form_descripcion = '';
        $formulario->form_estado = 4; //Estado "borrador"
        $formulario->save();

        return view('admin.formulario_area_tecnica.create', compact('formulario'));
    }

    public function list(Request $request)
    {
        try {
            $formulario = Formulario::with('funcionario')
            ->with(['preguntas' => function ($query) {
                $query->withCount('archivosFormulario');
            }])
            ->withFilters()
            ->orderByDesc('updated_at')
            ->get();

        foreach ($formulario as $key => $value) {
            $funcionario = $value->funcionario;
            $prevencionistas = User::role('prevencionista')->pluck('name')->toArray();
            $tecnicos = User::role('tecnico')->pluck('name')->toArray();

            if (in_array($funcionario->fun_nombre, $prevencionistas)) {
                $value->rol_funcionario = 'Prevencionista';
            } elseif (in_array($funcionario->fun_nombre, $tecnicos)) {
                $value->rol_funcionario = 'Tecnico';
            }
            // Agregar la cantidad de archivos a cada pregunta
            foreach ($value->preguntas as $pregunta) {
                $pregunta->cantidad_archivos = $pregunta->archivos_formularios_count;
            }

            // Agregar una propiedad adicional para la cantidad de archivos
            $value->cantidad_archivos = $value->preguntas->sum('cantidad_archivos');
        }



        return response()->json($formulario);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

}
