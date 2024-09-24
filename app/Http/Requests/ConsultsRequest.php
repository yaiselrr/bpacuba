<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsultsRequest extends FormRequest
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
            'mensaje' => 'required',
            'nombre' => 'required',
            'email' => 'required|email',
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'El campo correo es requerido',
            'nombre.required' => 'El campo nombre es requerido',
            'mensaje.required' => 'El campo mensaje es requerido',
            'mensaje.email' => 'La dirección de correo no es válida'
        ];
    }
}
