<?php

namespace App\Http\Requests\Noticia;

use Illuminate\Foundation\Http\FormRequest;

class RegistroNoticiaRequest extends FormRequest
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
            'titulo' => [
                'required',
                'max:255'
            ],
            'fecha' => [
                'required',
            ],
            'imagen' => [
                'required',
                'mimes:jpg,jpeg,png',
                'max:5120'
            ],
            'cuerpo' => [
                'required',
                'max:1000',
                'min:30'
            ],
            'edificio' => [
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
