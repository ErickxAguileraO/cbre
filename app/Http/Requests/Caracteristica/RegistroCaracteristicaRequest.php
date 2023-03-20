<?php

namespace App\Http\Requests\Caracteristica;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class RegistroCaracteristicaRequest extends FormRequest
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
            'nombre' => 'required|string|max:50',
            'posicion' => 'required|numeric|min:1|max:999',
            'estado' => 'required|boolean',
            'imagen' => 'required|file|mimes:jpg,jpeg,png,svg|max:20240',
        ];
    }
}
