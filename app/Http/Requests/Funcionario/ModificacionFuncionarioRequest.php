<?php

namespace App\Http\Requests\Funcionario;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ModificacionFuncionarioRequest extends FormRequest
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
                'max:50'
            ],
            'apellidos' => [
                'required', 
                'string', 
                'max:50'
            ],
            'telefono' => [
                'required',
                'digits_between:8,9'
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($this->route('funcionario')->user->id)->whereNull('deleted_at')
            ],
            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:5120'
            ],
            'cargo' => [
                'required'
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
            'foto.mimes' => 'Formatos permitidos: jpg, jpeg, png.',
            'foto.max' => 'Tamaño de imagen máximo: 5MB',
            'telefono.digits_between' => 'El teléfono debe tener entre 8 y 9 dígitos.'
        ];
    }
}
