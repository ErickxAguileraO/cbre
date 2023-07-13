<?php

namespace App\Http\Controllers\Administracion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Formulario;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FormularioJOPController extends Controller
{
    public function index()
    {
        return view('admin.formularios_jop.index');
    }

    public function list(Request $request)
    {
        try {
            // Obtener el ID del edificio del funcionario logeado
            $edificioId = Auth::user()->funcionario->edificio->edi_id;

            $formulario = Formulario::whereHas('edificios', function ($query) use ($edificioId) {
                $query->where('foredi_edificio_id', $edificioId);
            })
            ->withFilters($request->all())
            ->orderByDesc('updated_at')
            ->get();
            foreach ($formulario as $key => $value) {
                $funcionario = $value->funcionario;
                $prevencionistas = User::role('prevencionista')->pluck('name')->toArray();
                $tecnicos = User::role('tecnico')->pluck('name')->toArray();

                if (in_array($funcionario->fun_nombre, $prevencionistas)) {
                    $value->rol_funcionario = 'Prevencionista';
                } elseif (in_array($funcionario->fun_nombre, $tecnicos)) {
                    $value->rol_funcionario = 'Técnico';
                }
            }

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
