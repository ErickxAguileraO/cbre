<?php

namespace App\Http\Controllers\Administracion;

use App\Exports\RespuestasExport;
use App\Http\Controllers\Controller;
use App\Models\Formulario;
use App\Models\Pregunta;
use App\Models\Respuesta;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportarController extends Controller
{
    public function index()
    {

        $rolLogeado = auth()->user()->roles->first()->name;

        $formulario = Formulario::with('funcionario')
        ->with(['edificios' => function ($query) {
            // Aquí cargamos la relación "edificios" con las columnas seleccionadas
            $query->select('edi_id', 'edi_nombre', 'foredi_estado','foredi_edificio_id');

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
        ->orderByDesc('updated_at')
        ->get();

    $modifiedFormulario = collect();

    foreach ($formulario as $key => $value) {
        $funcionario = $value->funcionario;

        // Agregar los nombres de los edificios al formulario
        $edificios = $value->edificios;

        $value->cantidad_edificios = $edificios->count();
        $value->estado = $edificios->pluck('foredi_estado')->toArray();
        $value->edificio_id = $edificios->pluck('edi_id')->toArray();
        $value->edificio = $edificios->pluck('edi_nombre')->toArray();
        $modifiedFormulario->push($value);

    }

    return view('admin.exportar.index', compact('modifiedFormulario'));
    }

    public function list(Request $request)
    {

        try {
            $rolLogeado = auth()->user()->roles->first()->name;

            $formulario = Formulario::with('funcionario')
            ->with(['edificios' => function ($query) use ($request) {
                // Aquí cargamos la relación "edificios" con las columnas seleccionadas
                $query->select('edi_id', 'edi_nombre', 'foredi_estado','foredi_edificio_id');
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

            $value->updated_at_formatted = date('d-m-Y', strtotime($value->updated_at));

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

    public function downloadExcel($formId)
    {
        try {
            // Obtenemos el formulario y el área del usuario logeado
            $formulario = Formulario::findOrFail($formId);
            $area = auth()->user()->roles->first()->name;

            $export = new RespuestasExport($formulario, $area);
            $fileName = 'Respuestas.xlsx';

            return Excel::download($export, $fileName);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }
}
