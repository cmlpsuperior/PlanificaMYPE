<?php

namespace PlanificaMYPE\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteUpdateFormRequest extends FormRequest
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
            'nombres' => 'regex:/^[\pL\s\-]+$/u|max:50',
            'apellidoPaterno' => 'regex:/^[\pL\s\-]+$/u|max:100',
            'apellidoMaterno' => 'regex:/^[\pL\s\-]+$/u|max:100',
            'numeroDocumento' => 'required|digits:8|numeric',
            'fechaNacimiento' => 'required|date',
            'genero' => 'required|numeric',

            'telefono' => 'digits_between:4,20|numeric',
            'correo' => 'email|max:100',
            'idZona' => 'required|numeric',
            'direccion' => 'required|max:100',
            
            'referencia' => 'max:100',
            
            //'credito' => 'numeric',
            'idTipoDocumento'  => 'required|numeric',
        ];
    }
}
