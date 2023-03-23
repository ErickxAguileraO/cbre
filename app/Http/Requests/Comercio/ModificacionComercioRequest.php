<?php

namespace App\Http\Requests\Comercio;

use Illuminate\Foundation\Http\FormRequest;

class ModificacionComercioRequest extends FormRequest
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
                'nullable',
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
