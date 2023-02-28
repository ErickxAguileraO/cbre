<?php

namespace App\Http\Controllers\Administracion;

use App\Models\User;
use App\Models\Funcionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Funcionario\RegistroFuncionarioRequest;
use Illuminate\Support\Facades\Hash;
use App\Services\ImagenService;

class FuncionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.funcionarios.index');
    }

            /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        try {
            return Funcionario::with(['userTrashed'])->withTrashed()->get();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.funcionarios.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistroFuncionarioRequest $request)
    {
        DB::beginTransaction();

        try {
            $pathFoto = ImagenService::subirImagen($request->file('foto'), 'funcionarios');
            
            if ( !$pathFoto ) {
                return response()->error('No se pudo subir la imagen.', null);
            }

            $user = User::create([
                'name' => $request->nombre,
                'email' => $request->email,
                'password' => Hash::make('12345678')
            ]);

            $funcionario = $user->funcionario()->create([
                'fun_nombre' => $request->nombre,
                'fun_apellido' => $request->apellidos,
                'fun_telefono' => $request->telefono,
                'fun_foto' => $pathFoto,
                'fun_cargo' => $request->cargo,
                'fun_edificio_id' => $request->edificio
            ]);

            DB::commit();

            return response()->success($funcionario, 201);
        } catch (\Exception $exc) {
            DB::rollback();

            return response()->error($exc->getMessage(), null);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function restore($funcionario)
    {
        DB::beginTransaction();
        try {
            Funcionario::withTrashed()->findOrFail($funcionario)->restore();
            User::withTrashed()->findOrFail(Funcionario::withTrashed()->findOrFail($funcionario)->fun_user_id)->restore();
            DB::commit();
            return response()->json(['success' => '¡Funcionario habilitado correctamente!'], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($funcionario)
    {
        DB::beginTransaction();
        try {
            if(Funcionario::withTrashed()->findOrFail($funcionario)->deleted_at == null){
                Funcionario::findOrFail($funcionario)->delete();
                User::findOrFail(Funcionario::withTrashed()->findOrFail($funcionario)->fun_user_id)->delete();
            }
            DB::commit();
            return response()->json(['success' => '¡Funcionario deshabilitado correctamente!'], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }
}
