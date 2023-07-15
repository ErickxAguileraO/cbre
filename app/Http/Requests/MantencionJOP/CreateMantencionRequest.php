<?php

namespace App\Http\Requests\MantencionJOP;

use Illuminate\Foundation\Http\FormRequest;

class CreateMantencionRequest extends FormRequest
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
            'especialidad' => [
                'required',
            ],
            'detalle' => [
                'required',
            ],
            'archivo' => [
                'required',
            ],
        ];
    }

    public function messages()
    {
        return [
            'especialidad.required' => 'Seleccione una especialidad',
            'detalle.required' => 'debe escribir algun detalle de la mantención',
            'archivo.required' => 'Ningun archivo fue cargado',
        ];
    }

}
