<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ListadoMantencion;
use App\Models\Mantencion;

class MantencionSoporteTecnicoController extends Controller
{
    public function index()
    {
        $listadoEspecialidades =  ListadoMantencion::all();
        $mantencion = Mantencion::with(['listadoMantencion', 'edificios'])
        ->withFilters()
        ->orderByDesc('updated_at')
        ->get();

        // Marcar todas las mantenciones como leídas
        foreach ($mantencion as $mantenciones) {
            $mantenciones->man_leida = true;
            $mantenciones->save();
        }
        return view('admin.mantencion_soporte_tecnico.index', compact('listadoEspecialidades'));
    }

    public function edit($id)
    {
        $mantencion = Mantencion::findOrFail($id);
        $listadoEspecialidades =  ListadoMantencion::findOrFail($mantencion->man_listado_mantencions_id);
        return view('admin.mantencion_soporte_tecnico.view', compact('mantencion','listadoEspecialidades'));
    }

    public function list(Request $request)
    {
        try {
            $mantencion = Mantencion::with(['listadoMantencion', 'edificios'])
            ->withFilters()
            ->orderByDesc('created_at')
            ->get();

        // Obtener los nombres de las especialidades como una colección
        $especialidades = $mantencion->pluck('listadoMantencion.lism_nombre');

        // Agregar los nombres de las especialidades al objeto de cada mantención
        foreach ($mantencion as $key => $value) {
            $value->especialidades = $especialidades[$key];
        }

        // Obtener los nombres de los edificios como una colección
        $nombresEdificios = $mantencion->pluck('edificios.edi_nombre');

        // Agregar los nombres de los edificios al objeto de cada mantención
        foreach ($mantencion as $key => $value) {
            $value->edi_nombre = $nombresEdificios[$key];
        }

        return response()->json($mantencion);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }
}
