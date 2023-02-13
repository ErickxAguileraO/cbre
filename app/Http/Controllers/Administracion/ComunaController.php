<?php

namespace App\Http\Controllers\Administracion;
use App\Http\Controllers\Controller;

use App\Models\Comuna;
use App\Models\Region;
use Illuminate\Http\Request;

class ComunaController extends Controller
{
    public function comunasList()
    {
        try {
            return Comuna::with(['region'])->get();
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }

    public function comunasPorRegionList(Request $request)
    {
            try {
                return Comuna::whereIn('com_region_id', Region::where('reg_nombre', $request->regionName)->pluck('reg_id'))->get();
            } catch (\Throwable $th) {
                return response()->json(['error' => $th->getMessage()]);
            }
    }
}
