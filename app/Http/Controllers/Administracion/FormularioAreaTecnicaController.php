<?php

namespace App\Http\Controllers\Administracion;

use App\Models\Edificio;
use App\Models\Formulario;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Services\ArchivoService;
use Illuminate\Support\Facades\Storage;

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
        $formulario->form_estado = 4; //Estado "borrador"
        $formulario->save();

        return view('admin.formulario_area_tecnica.create', compact('formulario'));
    }

    public function list(Request $request)
    {
        try {
            $formulario = Formulario::with('funcionario')
            ->with(['preguntas' => function ($query) {
                $query->withCount('archivosFormulario');
            }])
            ->withFilters()
            ->orderByDesc('updated_at')
            ->get();

        foreach ($formulario as $key => $value) {
            $funcionario = $value->funcionario;
            $prevencionistas = User::role('prevencionista')->pluck('name')->toArray();
            $tecnicos = User::role('tecnico')->pluck('name')->toArray();

            if (in_array($funcionario->fun_nombre, $prevencionistas)) {
                $value->rol_funcionario = 'Prevencionista';
            } elseif (in_array($funcionario->fun_nombre, $tecnicos)) {
                $value->rol_funcionario = 'Tecnico';
            }
            // Agregar la cantidad de archivos a cada pregunta
            foreach ($value->preguntas as $pregunta) {
                $pregunta->cantidad_archivos = $pregunta->archivos_formularios_count;
            }

            // Agregar una propiedad adicional para la cantidad de archivos
            $value->cantidad_archivos = $value->preguntas->sum('cantidad_archivos');
        }



        return response()->json($formulario);
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
        return view('admin.formulario_area_tecnica.show', ['formulario' => Formulario::findOrFail($id)]);
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
            $formulario->form_estado = 1;
            $formulario->update();

            DB::commit();

        return response()->json(['success' => '¡El formulario se ha publicado correctamente!'], 200);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json(['error' => $th->getMessage()], 500);
        }

    }

    public function zipArchivos($formId, $preguntaId){
        ArchivoService::generateZip($formId, $preguntaId);
    }

}
