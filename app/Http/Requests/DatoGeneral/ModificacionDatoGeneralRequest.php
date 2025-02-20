<?php

namespace App\Http\Requests\DatoGeneral;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class ModificacionDatoGeneralRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'comuna' => 'required',
            'direccion' => 'required|string|max:100',
            'telefono_uno' => 'required|digits:9',
            'telefono_dos' => 'required|digits:9',
            'facebook' => 'required|url',
            'linkedin' => 'required|url',
            'instagram' => 'required|url',
            'twitter' => 'required|url',
            'youtube' => 'required|url',
            'email' => 'required|string|email|max:255',
            'nombre' => 'required|string|max:50',
            'telefono' => 'required|digits:9',
            'cargo' => 'required|string|max:50',
            'imagen' => 'nullable|file|mimes:jpg,jpeg,png|max:20240',
        ];
    }
}
