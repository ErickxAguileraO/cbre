<?php

namespace App\Http\Requests\Edificio;

use Illuminate\Foundation\Http\FormRequest;

class RegistroEdificioRequest extends FormRequest
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
            'descripcion' => [
                'required',
                'max:1000',
                'min:30'
            ],
            'imagenPrincipal' => [
                'required',
                'mimes:jpg,jpeg,png',
                'max:5120'
            ],
            'imagenesGaleria' => [
                'required'
            ],
            'video' => [
                'nullable',
                'max:255'
            ],
            'submercado' => [
                'required',
                'numeric'
            ],
            'ubicacionTitulo' => [
                'required',
                'max:255'
            ],
            'ubicacionDescripcion' => [
                'required',
                'max:1000',
                'min:30'
            ],
            'certificaciones' => [
                'required'
            ],
            'certificaciones.*' => [
                'numeric'
            ],
            'caracteristicas' => [
                'required'
            ],
            'caracteristicas.*' => [
                'numeric'
            ],
            'subdominio' => [
                'required',
                'max:255'
            ]
        ];
    }

    public function messages()
    {
        return [
            'imagenPrincipal.mimes' => 'Formatos permitidos: jpg, jpeg, png.',
            'imagenPrincipal.max' => 'Tamaño de imagen máximo: 5MB'
        ];
    }
}