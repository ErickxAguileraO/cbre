<?php

namespace App\Http\Requests\Comercio;

use Illuminate\Foundation\Http\FormRequest;

class RegistroComercioRequest extends FormRequest
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
                'string',
                'max:255'
            ],
            'imagen' => [
                'required',
                'mimes:jpg,jpeg,png',
                'max:5120'
            ],
            'descripcionTextarea' => [
                'required',
                'max:1000',
                'min:30'
            ],
            'edificio' => [
                'required',
                'nullable',
                'numeric'
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
