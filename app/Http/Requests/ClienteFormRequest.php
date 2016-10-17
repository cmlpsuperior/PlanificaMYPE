<?php

namespace PlanificaMYPE\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteFormRequest extends FormRequest
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
            'nombres' => 'max:50',
            'apellidoPaterno' => 'max:100',
            'apellidoMaterno' => 'max:100',
            //'razonSocial' => 'max:100',
            'telefono' => 'numeric|max:20',
            'correo' => 'email|max:100',
            'direccion' => 'max:100',
            'numeroDocumento' => 'numeric|max:20',
            'referencia' => 'max:100'
            //'credito' => 'numeric|max:1|requered',
            //'idTipoDocumento'  => 'numeric|requered',
            //'idZona' => 'numeric|requered',
        ];
    }
}
