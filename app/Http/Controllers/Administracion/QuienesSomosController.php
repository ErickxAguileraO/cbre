<?php
namespace App\Http\Controllers\Administracion;

use App\Models\QuienesSomos;
use Illuminate\Http\Request;
use App\Services\ImagenService;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Services\QuienesSomosService;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\QuienesSomos\UpdateQuienesSomosRequest;

class QuienesSomosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.quienes_somos.index', ['quienes_somos' => QuienesSomos::first()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function update(UpdateQuienesSomosRequest $request, $quienesSomos)
    {
        DB::beginTransaction();
        try {
            $quienesSomos = QuienesSomos::findOrFail($quienesSomos);
            $quienesSomos->update([
                'qus_titulo' => $request->input('titulo'),
                'qus_texto' => $request->input('texto'),
            ]);
            if ($request->hasFile('imagen')) {
                Storage::delete($quienesSomos->qus_imagen);
                $quienesSomos->update([
                    'qus_imagen' => ImagenService::subirImagen($request->file('imagen'), 'quienes-somos'),
                ]);
            }
            DB::commit();
            return response()->json(['success' => '¡Quienes somos se ha actualizado correctamente!'], 200);
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
    public function destroy($id)
    {
        //
    }
}
