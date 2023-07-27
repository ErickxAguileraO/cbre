<?php

namespace App\Http\Controllers\Administracion;;

use App\Models\User;
use App\Models\DatoGeneral;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Administrador;
use App\Mail\NotificacionRegistro;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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
            return Administrador::with(['userTrashed'])->withTrashed()->orderByDesc('created_at')->get();
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
                'name' => $request->nombre,
                'email' => $request->email,
                'password' => Hash::make(Str::before($request->email, '@').bin2hex(openssl_random_pseudo_bytes(2))),
            ]);

            Administrador::create([
                'adm_user_id' => $user->id,
                'adm_nombre' => $request->nombre,
                'adm_apellido' => $request->apellido,
            ]);

            $user->assignRole('super-admin');

            Mail::to($request->email)->send(new NotificacionRegistro($request, DatoGeneral::first(), $user));

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
    public function edit($administrador)
    {
        $administrador = Administrador::withTrashed()->findOrFail($administrador);
        return view('admin.administradores.edit', compact('administrador'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ModificacionAdministradorRequest $request, $administrador)
    {
        DB::beginTransaction();

        try {
            $administrador = Administrador::withTrashed()->findOrFail($administrador);
            $administrador->adm_nombre = $request->nombre;
            $administrador->adm_apellido = $request->apellido;

            if($request->estado == 0){
                $this->destroy($administrador->adm_id);
            }elseif($request->estado == 1){
                $this->restore($administrador->adm_id);
            }

            $administrador->save();

            if($administrador->userTrashed->name !== $request->nombre){
                $administrador->userTrashed->name = $request->nombre;
                $administrador->userTrashed->save();
            }

            if ($administrador->userTrashed->email !== $request->email) {
                $administrador->userTrashed->email = $request->email;
                Mail::to($request->email)->send(new NotificacionRegistro($request, DatoGeneral::first(), $administrador->userTrashed));
            }

            $administrador->userTrashed->save();

            DB::commit();

            return response()->json(['success' => '¡Administrador actualizado correctamente!'], 200);
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
    public function restore($administrador)
    {
        DB::beginTransaction();

        try {
            Administrador::withTrashed()->findOrFail($administrador)->restore();
            User::withTrashed()->findOrFail(Administrador::withTrashed()->findOrFail($administrador)->adm_user_id)->restore();

            DB::commit();

            return response()->json(['success' => '¡Administrador habilitado correctamente!'], 200);
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
    public function destroy($administrador)
    {
        DB::beginTransaction();

        try {
            if(Administrador::withTrashed()->findOrFail($administrador)->deleted_at == null){
                Administrador::findOrFail($administrador)->delete();
                User::findOrFail(Administrador::withTrashed()->findOrFail($administrador)->adm_user_id)->delete();
            }

            DB::commit();

            return response()->json(['success' => '¡Administrador deshabilitado correctamente!'], 200);
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
    public function forceDestroy($administrador)
    {
        DB::beginTransaction();

        try {
            $admin = Administrador::withTrashed()->findOrFail($administrador);
            $user = User::withTrashed()->findOrFail($admin->adm_user_id);
            $admin->forceDelete();
            $user->forceDelete();

            DB::commit();

            return response()->json(['success' => '¡Administrador eliminado correctamente!'], 200);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json(['error' => $th->getMessage()], 401);
        }
    }

}
