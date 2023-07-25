<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use App\Models\Formulario;
use App\Models\User;
use Illuminate\Http\Request;

class ExportarController extends Controller
{
    public function index()
    {
        // $edificios = Edificio::all();
        $funcionarios = Formulario::with('funcionario')->get()->pluck('funcionario');
        // dd($funcionarios);
        return view('admin.exportar.index', compact('funcionarios'));
    }

    public function list(Request $request)
    {

        try {
            $rolLogeado = auth()->user()->roles->first()->name;

            $formulario = Formulario::with('funcionario')
            ->with(['preguntas' => function ($query) {
                $query->withCount('archivosFormulario');
            }])
            ->with(['edificios' => function ($query) use ($request) {
                // Aquí cargamos la relación "edificios" con las columnas seleccionadas
                $query->select('edi_id', 'edi_nombre', 'foredi_estado','foredi_edificio_id');

                // Filtrar por el estado seleccionado (si está presente en la solicitud)
                if (isset($request->estado)) {
                    $query->where('foredi_estado', $request->estado);
                }
                // Filtrar por el estado seleccionado (si está presente en la solicitud)
                if (isset($request->edificio)) {
                    $query->where('edi_nombre', $request->edificio);
                }
            }])
            ->when($rolLogeado !== 'super-admin', function ($query) use ($rolLogeado) {
                $query->whereHas('funcionario', function ($subquery) use ($rolLogeado) {
                    $subquery->whereHas('user', function ($userQuery) use ($rolLogeado) {
                        $userQuery->whereHas('roles', function ($roleQuery) use ($rolLogeado) {
                            $roleQuery->where('name', $rolLogeado);
                        });
                    });
                });
            })
            ->withFilters($request->all())
            ->orderByDesc('updated_at')
            ->get();

        $modifiedFormulario = collect();

        foreach ($formulario as $key => $value) {
            $funcionario = $value->funcionario;

            $prevencionistas = User::role('prevencionista')->pluck('name')->toArray();
            $tecnicos = User::role('tecnico')->pluck('name')->toArray();

            $rolFuncionario = '';

            if (in_array($funcionario->fun_nombre, $prevencionistas)) {
                $rolFuncionario = 'Prevencionista';
            } elseif (in_array($funcionario->fun_nombre, $tecnicos)) {
                $rolFuncionario = 'Técnico';
            }

            $value->rol_funcionario = $rolFuncionario;

            // Agregar la cantidad de archivos a cada pregunta
            foreach ($value->preguntas as $pregunta) {
                $pregunta->cantidad_archivos = $pregunta->archivosFormulario->count();
            }
            $value->updated_at_formatted = date('d-m-Y', strtotime($value->updated_at));
            // Obtener la cantidad total de archivos vinculados al formulario
            $cantidadArchivosFormulario = 0;
            foreach ($value->preguntas as $pregunta) {
                $cantidadArchivosFormulario += $pregunta->cantidad_archivos;
            }
            $value->cantidad_archivos_formulario = $cantidadArchivosFormulario;

            // Agregar los nombres de los edificios al formulario
            $edificios = $value->edificios;

            $value->cantidad_edificios = $edificios->count();
            $value->estado = $edificios->pluck('foredi_estado')->toArray();
            $value->edificio_id = $edificios->pluck('edi_id')->toArray();
            $value->edificio = $edificios->pluck('edi_nombre')->toArray();
            $modifiedFormulario->push($value);

        }
        return response()->json($modifiedFormulario);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }
}
