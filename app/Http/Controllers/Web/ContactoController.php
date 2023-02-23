<?php

namespace App\Http\Controllers\Web;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\Web\Contacto\StoreContactoRequest;
use App\Models\Contacto;

class ContactoController extends Controller
{
        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreContactoRequest $request)
    {
        DB::beginTransaction();
        try {
            Contacto::create([
                'con_nombre_completo' => $request->nombre,
                'con_email' => $request->email,
                'con_telefono' => $request->telefono,
                'con_mensaje' => $request->mensaje,
            ]);
            DB::commit();
            return response()->json(['success' => '¡Formulario completado con éxito! ¡Gracias por contactarnos! Pronto nos comunicaremos contigo.'], 200);
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['error' => $th->getMessage()], 401);
        }
    }
}
