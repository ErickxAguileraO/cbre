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
            'direccion' => [
                'required',
                'max:255'
            ],
            'imagenPrincipal' => [
                'required',
                'mimes:jpg,jpeg,png',
                'max:5120'
            ],
            'imagenesGaleria' => [
                'required'
            ],
            'imagenesGaleria.*' => [
                'mimes:jpg,jpeg,png',
                'max:5120'
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
            'jefeNombre' => [
                'required',
                'max:255'
            ],
            'jefeApellidos' => [
                'required',
                'max:255'
            ],
            'jefeEmail' => [
                'required',
                'max:255',
                'email'
            ],
            'jefeTelefono' => [
                'required',
                'numeric',
                'digits_between:8,9'
            ],
            'fotoJefe' => [
                'required',
                'mimes:jpg,jpeg,png',
                'max:5120'
            ],
            'asistenteNombre' => [
                'required',
                'max:255'
            ],
            'asistenteApellidos' => [
                'required',
                'max:255'
            ],
            'asistenteEmail' => [
                'required',
                'max:255',
                'email'
            ],
            'asistenteTelefono' => [
                'required',
                'numeric',
                'digits_between:8,9'
            ],
            'fotoAsistente' => [
                'required',
                'mimes:jpg,jpeg,png',
                'max:5120'
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
            'imagenPrincipal.max' => 'Tamaño de imagen máximo: 5MB',
            'imagenesGaleria.*.mimes' => 'Formatos permitidos: jpg, jpeg, png.',
            'imagenesGaleria.*.max' => 'Tamaño de imagen máximo: 5MB',
            'fotoJefe.mimes' => 'Formatos permitidos: jpg, jpeg, png.',
            'fotoJefe.max' => 'Tamaño de imagen máximo: 5MB.',
            'fotoAsistente.mimes' => 'Formatos permitidos: jpg, jpeg, png.',
            'fotoAsistente.max' => 'Tamaño de imagen máximo: 5MB.',
            'jefeTelefono.digits_between' => 'El teléfono debe tener 8 o 9 dígitos.',
            'asistenteTelefono.digits_between' => 'El teléfono debe tener 8 o 9 dígitos.'
        ];
    }
}
