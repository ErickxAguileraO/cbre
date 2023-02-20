<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as FortifyLoginResponse;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LoginResponse implements FortifyLoginResponse
{
    public function toResponse($request)
    {
        $usuarioLogeado = Auth::user();
        $urlHome = '/admin';

        return response()->success(compact('urlHome'));
    }
}