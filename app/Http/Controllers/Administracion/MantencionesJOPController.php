<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListadoMantencion;
use App\Models\Mantencion;

class MantencionesJOPController extends Controller
{
    public function index()
    {
        $listadoEspecialidades =  ListadoMantencion::all();
        return view('admin.mantenciones_jop.index', compact('listadoEspecialidades'));
    }

    public function create()
    {
        return view('admin.mantenciones_jop.create');
    }

    public function list(Request $request)
    {
        try {
            $mantencion = Mantencion::with('listadoMantencion')
            ->withFilters()
            ->orderByDesc('updated_at')
            ->get();

        // Obtener los nombres de las especialidades como una colección
        $especialidades = $mantencion->pluck('listadoMantencion.lism_nombre');

        // Agregar los nombres de las especialidades al objeto de cada mantención
        foreach ($mantencion as $key => $value) {
            $value->especialidades = $especialidades[$key];
        }

        return response()->json($mantencion);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }
}
