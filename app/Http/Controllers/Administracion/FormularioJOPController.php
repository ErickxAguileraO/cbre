<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formulario;

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
}
