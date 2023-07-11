<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\MantencionJOP\CreateMantencionRequest;
use App\Models\ArchivoMantencion;
use Illuminate\Http\Request;
use App\Models\ListadoMantencion;
use App\Models\Mantencion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MantencionesJOPController extends Controller
{
    public function index()
    {
        $listadoEspecialidades =  ListadoMantencion::all();
        return view('admin.mantenciones_jop.index', compact('listadoEspecialidades'));
    }

    public function create()
    {
        $listadoEspecialidades =  ListadoMantencion::all();
        return view('admin.mantenciones_jop.create', compact('listadoEspecialidades'));
    }

    public function store(CreateMantencionRequest $request)
    {
        DB::beginTransaction();

        try {
            Mantencion::create([
                'man_listado_mantencions_id' => $request->especialidad,
                'man_descripcion' => $request->detalle,
                'man_edificio_id' => Auth::user()->funcionario->edificio->edi_id,
            ]);

            ArchivoMantencion::create([
                'car_estado' => $request->archivo,
            ]);

            DB::commit();

            return response()->json(['success' => '¡La mantención se ha registrado correctamente!'], 200);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json(['error' => $th->getMessage()], 401);
        }
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
