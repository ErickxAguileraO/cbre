<?php

namespace App\Http\Controllers\Web;
use App\Models\Contacto;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Web\Contacto\StoreContactoRequest;
use App\Mail\ContactoComprobante;
use App\Mail\ContactoEncargado;
use App\Models\DatoGeneral;

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

            $datos_generales = DatoGeneral::first();
            Mail::to($datos_generales->dag_email_encargado)->send(new ContactoEncargado($request, $datos_generales));
            Mail::to($request->email)->send(new ContactoComprobante($request, $datos_generales));

            DB::commit();

            return response()->json(['success' => '¡Formulario completado con éxito! </br> ¡Gracias por contactarnos! Pronto nos comunicaremos contigo.'], 200);
        } catch (\Throwable $th) {
            DB::rollback();

            return response()->json(['error' => $th->getMessage()], 401);
        }
    }
}
