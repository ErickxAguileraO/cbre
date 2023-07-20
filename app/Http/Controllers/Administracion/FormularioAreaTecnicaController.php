<?php

namespace App\Http\Controllers\Administracion;

use App\Models\User;
use App\Models\Edificio;
use App\Models\Respuesta;
use App\Models\Formulario;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use App\Models\RespuestaOpcion;
use App\Services\ArchivoService;
use App\Models\FormularioEdificio;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class FormularioAreaTecnicaController extends Controller
{

     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $edificios = Edificio::all();
        $funcionarios = Formulario::with('funcionario')->get()->pluck('funcionario');
        // dd($funcionarios);
        return view('admin.formulario_area_tecnica.index', compact('funcionarios'));
    }

     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //El formulario se crea en primera instancia, quedando como borrador

        $formulario = new Formulario();
        $formulario->form_funcionario_id = Auth::user()->funcionario->fun_id;
        $formulario->form_nombre = '';
        $formulario->form_descripcion = '';
        $formulario->save();

        return view('admin.formulario_area_tecnica.create', compact('formulario'));
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

            if ($edificios->count() > 1) {
                foreach ($edificios as $edificio) {
                    $modifiedFormulario->push($value->replicate()->forceFill([
                        'estado' => $edificio->foredi_estado,
                        'edificio_id' => $edificio->edi_id,
                        'edificio' => $edificio->edi_nombre,
                        'form_id' => $value->form_id // Asignar el form_id original al formulario duplicado
                    ]));
                }
            } else {
                if ($edificios->isEmpty()) {
                    $value->estado = [4];
                } else {
                    $value->estado = $edificios->pluck('foredi_estado')->toArray();
                }
                $value->edificio_id = $edificios->pluck('edi_id')->toArray();
                $value->edificio = $edificios->pluck('edi_nombre')->toArray();
                $modifiedFormulario->push($value);
            }
        }
        return response()->json($modifiedFormulario);
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
/*         return view('admin.formulario_area_tecnica.show', [
            'formulario' => Formulario::findOrFail($id),
            'respuestaOpcion' => RespuestaOpcion::all()
        ]); */
    }

    public function verFormulario()
    {
        $idFormulario = request('formulario');
        $idEdificio = request('edificio');

        if($idFormulario && $idEdificio && !isEmpty(FormularioEdificio::where('foredi_formulario_id', $idFormulario)
        ->where('foredi_edificio_id', $idEdificio)
        ->first()->respuestas)){
            return view('admin.formulario_area_tecnica.show', [
                'formulario' => Formulario::findOrFail($idFormulario),

                'respuestaOpcion' => RespuestaOpcion::where('reop_respuesta_id', Respuesta::where('res_formulario_edificio_id', FormularioEdificio::where('foredi_formulario_id', $idFormulario)
                ->where('foredi_edificio_id', $idEdificio)
                ->first()->foredi_id)->first()->res_id)->get(),

                'respuestas' => FormularioEdificio::where('foredi_formulario_id', $idFormulario)
                ->where('foredi_edificio_id', $idEdificio)
                ->first()
                ->respuestas()
                ->where('res_estado', 1)
                ->get(),
            ]);
        }elseif($idFormulario){
            return view('admin.formulario_area_tecnica.show', [
                'formulario' => Formulario::findOrFail($idFormulario),
                'respuestaOpcion' => RespuestaOpcion::all()
            ]);
        }else{
            abort(404);
        }
    }

        /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.formulario_area_tecnica.edit', ['formulario' => Formulario::findOrFail($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $formulario = Formulario::findOrFail($id);

            $preguntas = $formulario->preguntas;

            foreach ($preguntas as $pregunta) {
                $pregunta->opciones()->delete();

                $pregunta->archivosFormulario->each(function ($archivo) {
                    Storage::delete($archivo->arcf_url);
                    $archivo->delete();
                });
            }

            $preguntas->each->delete();

            $formulario->delete();

            DB::commit();

            return response()->json(['success' => '¡El formulario se ha eliminado correctamente!'], 200);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function postFormulario(Request $request){

        DB::beginTransaction();
        try {

            $formulario = Formulario::findOrFail($request->input('formValue'));
            $formEdificios = FormularioEdificio::where('foredi_formulario_id', $formulario->form_id)->get();
            foreach($formEdificios as $formEdificio){
                $formEdificio->foredi_estado = 1;
                $formEdificio->update();
            }

            DB::commit();

        return response()->json(['success' => '¡El formulario se ha publicado correctamente!'], 200);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json(['error' => $th->getMessage()], 500);
        }

    }

    public function zipArchivos($formId, $preguntaId){
        try {
            ArchivoService::generateZip($formId, $preguntaId);
        } catch (\Throwable $th) {
            return redirect()->route('formulario-area-tecnica.index')->with('error', $th->getMessage());
        }
    }

}
