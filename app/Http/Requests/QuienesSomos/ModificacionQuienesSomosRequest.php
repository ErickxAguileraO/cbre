<?php

namespace App\Http\Requests\QuienesSomos;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class ModificacionQuienesSomosRequest extends FormRequest
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
            'titulo' => 'required|string|max:50',
            'texto' => 'required',
            'imagen' => 'nullable|file|mimes:jpg,jpeg,png|max:20240',
        ];
    }
}
