<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Http\Requests\MantencionJOP\CreateMantencionRequest;
use App\Models\ArchivoMantencion;
use Illuminate\Http\Request;
use App\Models\ListadoMantencion;
use App\Models\Mantencion;
use App\Services\ArchivoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        // dd($request->all());
        DB::beginTransaction();

        try {
            $edificio = Auth::user()->funcionario->edificio;
            $mantencion = Mantencion::create([
                'man_listado_mantencions_id' => $request->especialidad,
                'man_descripcion' => $request->detalle,
                'man_edificio_id' => $edificio->edi_id,
            ]);
            $url = ArchivoService::subirArchivos($request->archivo, 'mantencion', $mantencion->man_id);
            ArchivoMantencion::create([
                'arcm_mantencion_id' => $mantencion->man_id,
                'arcm_url' => $url,
            ]);

            DB::commit();

            return response()->json(['success' => '¡La mantención se ha registrado correctamente!'], 200);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json(['error' => $th->getMessage()], 401);
        }
    }

    public function edit($id)
    {
        $mantencion = Mantencion::findOrFail($id);
        $listadoEspecialidades =  ListadoMantencion::findOrFail($mantencion->man_listado_mantencions_id);
        $rutaArchivo = Storage::url('/storage/archivos/mantencion/'.$mantencion->man_listado_mantencions_id.'/nombre');
        $nombreArchivo = basename($rutaArchivo);
        return view('admin.mantenciones_jop.view', compact('mantencion','listadoEspecialidades','nombreArchivo'));
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

    public function zipArchivos($mantencionId, $idCarpeta){
        try {
            ArchivoService::generateZipMantenciones($mantencionId, $idCarpeta);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
