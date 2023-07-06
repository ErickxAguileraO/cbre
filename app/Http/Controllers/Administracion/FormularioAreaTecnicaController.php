<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formulario;
use App\Models\Edificio;

class FormularioAreaTecnicaController extends Controller
{
    public function index()
    {
        $edificios = Edificio::all();
        return view('admin.formulario_area_tecnica.index', compact('edificios'));
    }

    public function create()
    {
        return view('admin.formulario_area_tecnica.create');
    }

    public function list(Request $request)
    {
        $edificio = $request->input('edificio');
        $fechaInicio = $request->input('fechaInicio');
        $fechaTermino = $request->input('fechaTermino');
        $estado = $request->input('estado');
        $creadoPor = $request->input('creadoPor');

        $query = Formulario::query();

        if ($fechaInicio) {
            $fechaInicio = date('Y-m-d', strtotime($fechaInicio));
            $query->whereDate('created_at', '>=', $fechaInicio);
        }

        if ($fechaTermino) {
            $fechaTermino = date('Y-m-d', strtotime($fechaTermino));
            $query->whereDate('created_at', '<=', $fechaTermino);
        }

        if ($estado !== null) {
            $estadoValido = [0, 1, 2, 3]; // Estados válidos en la base de datos
            if (in_array($estado, $estadoValido)) {
                $query->where('form_estado', $estado);
            } else {
                // No hay registros para mostrar si el estado no existe
                $query->where('form_estado', '!=', $estado)->whereRaw('1 = 0');
            }
        }

        $data = $query->get();

        return response()->json($data);
        // try {
        //     return Formulario::orderByDesc('created_at')->get();
        // } catch (\Throwable $th) {
        //     return response()->json(['error' => $th->getMessage()]);
        // }
    }

}
