<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StaticsTextUpdateRequest extends FormRequest
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
//        ['generales', 'descargas',
//            'redes-oficinas', 'tarifas-terminos',
//            'cajeros','productos-servicios']
        switch ($this->request->get('tipo')){
            case 'tarifas-terminos':
                return [
                    'home_text'=>'required',
                    'descripcion'=>'required',
                    'tipo'=>'required'
                ];
                break;
            case 'productos-servicios':
                return [
                    'home_text'=>'required',
                    'descripcion'=>'required',
                    'tipo'=>'required'
                ];
            default:
                return [
                    'descripcion'=>'required',
                    'tipo'=>'required'
                ];
                break;
        }

    }
}
