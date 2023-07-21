<?php

namespace App\Http\Requests\Observacion;

use Illuminate\Foundation\Http\FormRequest;

class CreateObservacionRequest extends FormRequest
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
            'descripcion' => [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'descripcion.required' => 'Debe completar el campo antes de enviar',
        ];
    }
}
