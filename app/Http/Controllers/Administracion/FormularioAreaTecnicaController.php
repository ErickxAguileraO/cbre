<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formulario;
use App\Models\Edificio;
use App\Models\Funcionario;
use Illuminate\Support\Facades\Auth;

class FormularioAreaTecnicaController extends Controller
{
    public function index()
    {
        // $edificios = Edificio::all();
        // $funcionarios = Formulario::with('funcionario')->get()->pluck('funcionario');
        // dd($funcionarios);
        return view('admin.formulario_area_tecnica.index');
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
            $formulario = Formulario::with('funcionario.edificio')
            ->withFilters()
            ->orderByDesc('updated_at')
            ->get();

        // Obtener los nombres de los funcionarios y los nombres de los edificios
        $funcionarios = $formulario->pluck('funcionario.fun_nombre');
        $edificios = $formulario->pluck('funcionario.edificio.edi_nombre');

        // Agregar los nombres de los funcionarios y los nombres de los edificios al objeto de cada formulario
        foreach ($formulario as $key => $value) {
            $value->creado_por = $funcionarios[$key];
            $value->edificio = isset($edificios[$key]) ? $edificios[$key] : null;
        }

        return response()->json($formulario);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

}
