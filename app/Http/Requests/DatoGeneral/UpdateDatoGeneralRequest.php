<?php

namespace App\Http\Requests\DatoGeneral;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDatoGeneralRequest extends FormRequest
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
            'comuna' => 'required',
            'direccion' => 'required',
            'telefono_uno' => 'required',
            'telefono_dos' => 'required',
            'facebook' => 'required',
            'linkedin' => 'required',
            'instagram' => 'required',
            'twitter' => 'required',
            'youtube' => 'required',
            'email' => 'required',
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
