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
            $formularios = Formulario::withFilters()->orderByDesc('created_at')->get();
            return response()->json($formularios);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }
}
