<?php

namespace App\Http\Requests\Indicador;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class ModificacionIndicadoresRequest extends FormRequest
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
            'edificios_administrados' => 'required|numeric|min:1|max:999999999',
            'confia_en_nosotros' => 'required|numeric|min:1|max:999999999',
            'en_todo_chile' => 'required|numeric|min:1|max:999999999',
            'en_todo_chile2' => 'required|numeric|min:1|max:999999999', //metros cuadrados
        ];
    }

                /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
        ], 422));
    }
}
