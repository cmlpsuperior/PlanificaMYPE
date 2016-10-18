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
            'nombres' => 'alpha|max:50',
            'apellidoPaterno' => 'alpha|max:100',
            'apellidoMaterno' => 'alpha|max:100',
            //'razonSocial' => 'max:100',
            'telefono' => 'digits_between:4,20|numeric',
            'correo' => 'email|max:100',
            'direccion' => 'max:100',
            'numeroDocumento' => 'digits:8|numeric',
            'referencia' => 'max:100',
            //'zona' => 'different:Seleccionar',
            //'credito' => 'numeric|max:1|requered',
            //'idTipoDocumento'  => 'numeric|requered',
            //'idZona' => 'numeric|requered',
        ];
    }
}
