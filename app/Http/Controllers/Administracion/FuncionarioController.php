<?php

namespace App\Http\Controllers\Administracion;

use App\Models\User;
use App\Models\DatoGeneral;
use App\Models\Funcionario;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\ImagenService;
use App\Services\EdificioService;
use App\Mail\NotificacionRegistro;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Funcionario\RegistroFuncionarioRequest;
use App\Http\Requests\Funcionario\ModificacionFuncionarioRequest;

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
        $usuarioSesion = Auth::user();

        if ( $usuarioSesion->hasRole('funcionario') && $usuarioSesion->funcionario != null ) {
            return $usuarioSesion->funcionario()->with(['edificio'])->get();
        } else {
            return Funcionario::orderByDesc('created_at')->with(['edificio'])->get();
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
                'password' => Hash::make(Str::before($request->email, '@').bin2hex(openssl_random_pseudo_bytes(2))),
            ]);

            $funcionario = $user->funcionario()->create([
                'fun_nombre' => $request->nombre,
                'fun_apellido' => $request->apellidos,
                'fun_telefono' => $request->telefono,
                'fun_foto' => $pathFoto,
                'fun_cargo' => $request->cargo,
                'fun_edificio_id' => EdificioService::obtenerEdificioRoleFuncionario() ?: $request->edificio
            ]);

            $user->assignRole('funcionario');

            Mail::to($request->email)->send(new NotificacionRegistro($request, DatoGeneral::first(), $user));

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
    public function edit(Funcionario $funcionario)
    {
        return view('admin.funcionarios.edit', ['funcionario' => $funcionario]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModificacionFuncionarioRequest $request, Funcionario $funcionario)
    {
        DB::beginTransaction();

        try {
            if ($request->file('foto') !== null) {
                Storage::delete($funcionario->fun_foto);
                $pathFoto = ImagenService::subirImagen($request->file('foto'), 'funcionarios');

                if ( !$pathFoto ) {
                    return response()->error('No se pudo subir la imagen.', null);
                }

                $funcionario->fun_foto = $pathFoto;
            }

            $funcionario->fun_nombre = $request->nombre;
            $funcionario->fun_apellido = $request->apellidos;
            $funcionario->fun_telefono = $request->telefono;
            $funcionario->fun_cargo = $request->cargo;
            $funcionario->fun_edificio_id = EdificioService::obtenerEdificioRoleFuncionario() ?: $request->edificio;
            $funcionario->save();

            if($funcionario->user->email !== $request->email){
                $funcionario->user->email = $request->email;
                Mail::to($request->email)->send(new NotificacionRegistro($request, DatoGeneral::first()));
            }

            $funcionario->user->save();

            DB::commit();

            return response()->success($funcionario, 201);
        } catch (\Exception $exc) {
            return response()->error($exc->getMessage(), null);
        }
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funcionario $funcionario)
    {
        DB::beginTransaction();

        try {
            Storage::delete($funcionario->fun_foto);
            $funcionario->delete();
            $funcionario->user->delete();

            DB::commit();

            return response()->success($funcionario, 200);
        } catch (\Exception $exc) {
            DB::rollback();

            return response()->error($exc->getMessage(), null);
        }
    }
}
