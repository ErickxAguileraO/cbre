<?php

namespace App\Http\Requests\Certificacion;

use Illuminate\Foundation\Http\FormRequest;

class ModificacionCertificacionRequest extends FormRequest
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
            'fileImagen' => [
                'nullable',
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
            ],
        ];
    }

    public function messages()
    {
        return [
            'fileImagen.mimes' => 'Formatos permitidos: jpg, jpeg, png.',
            'fileImagen.max' => 'Tamaño de imagen máximo: 5MB',
        ];
    }
}
