<?php

namespace App\Http\Requests\Certificacion;

use Illuminate\Foundation\Http\FormRequest;

class RegistroCertificacionRequest extends FormRequest
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
            'nombre' => [
                'required',
                'max:255'
            ],
            'imagen' => [
                'required',
                'mimes:jpg,jpeg,png',
                'max:5120'
            ],
            'posicion' => [
                'required',
                'numeric',
                'max:999',
                'min:1'
            ],
            'estado' => [
                'required',
                'boolean'
            ]
        ];
    }

    public function messages()
    {
        return [
            'imagen.mimes' => 'Formatos permitidos: jpg, jpeg, png.',
            'imagen.max' => 'Tamaño de imagen máximo: 5MB',
        ];
    }
}
