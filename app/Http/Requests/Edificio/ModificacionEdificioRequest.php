<?php

namespace App\Http\Requests\Edificio;

use Illuminate\Foundation\Http\FormRequest;

class ModificacionEdificioRequest extends FormRequest
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
            'descripcionTextarea' => [
                'required',
                'max:1000',
                'min:30'
            ],
            'imagenPrincipal' => [
                'nullable',
                'mimes:jpg,jpeg,png',
                'max:5120'
            ],
/*             'imagenListado' => [
                'nullable',
                'dimensions:width=435,height=285',
                'mimes:jpg,jpeg,png',
                'max:5120'
            ], */
            'imagenListado' => [
                'nullable',
            ],
            'imagenesGaleria' => [
                'required_without:idImagenes'
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
            'ubicacionDescripcionTextarea' => [
                'required',
                'max:1000',
                'min:30'
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
            'imagenPrincipal.max' => 'Tamaño de imagen máximo: 5MB',
            'imagenesGaleria.required_without' => 'La galería debe tener al menos una imagen.',
            'imagenListado.dimensions' => 'La imagen debe tener el tamaño 435x285.'
        ];
    }
}
