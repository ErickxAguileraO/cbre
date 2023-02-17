<?php

namespace App\Http\Controllers\Administracion;;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Administrador;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Administrador\RegistroAdministradorRequest;
use App\Http\Requests\Administrador\ModificacionAdministradorRequest;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.administradores.index');
    }

        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        try {
            return Administrador::with(['user'])->get();
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
        return view('admin.administradores.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegistroAdministradorRequest $request)
    {
        DB::beginTransaction();
        try {
            $user = User::create([
                'name' => $request->nombre.$request->apellido,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
            Administrador::create([
                'adm_user_id' => $user->id,
                'adm_nombre' => $request->nombre,
                'adm_apellido' => $request->apellido,
            ]);
            DB::commit();
            return response()->json(['success' => '¡Administrador creado correctamente!'], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => $th->getMessage()], 401);
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
    public function edit(Administrador $administrador)
    {
        return view('admin.administradores.edit', compact('administrador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModificacionAdministradorRequest $request, Administrador $administrador)
    {
/*         DB::beginTransaction();
        try {
            $caracteristica->update([
                'car_nombre' => $request->input('nombre'),
                'car_video_url' => $request->input('video'),
                'car_posicion' => $request->input('posicion'),
                'car_estado' => $request->input('estado'),
            ]);
            if ($request->hasFile('imagen')) {
                Storage::delete($caracteristica->car_imagen);
                $caracteristica->update([
                    'car_imagen' => ImagenService::subirImagen($request->file('imagen'), 'caracteristicas'),
                ]);
            }
            DB::commit();
            return response()->json(['success' => '¡La característica se ha actualizado correctamente!'], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => $th->getMessage()], 401);
        } */
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
/*         DB::beginTransaction();
        try {
            $caracteristica->edificios()->detach();
            Storage::delete($caracteristica->car_imagen);
            $caracteristica->delete();
            DB::commit();
            return response()->json(['success' => '¡La característica se ha eliminado correctamente!'], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => $th->getMessage()], 401);
        } */
    }

}
