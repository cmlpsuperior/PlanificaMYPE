<?php

namespace PlanificaMYPE\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpleadoEditRequest extends FormRequest
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
            'nombres'=> 'required|regex:/^[\pL\s\-]+$/u|max:100',
            'apellidoPaterno' => 'required|regex:/^[\pL\s\-]+$/u|max:100' ,
            'apellidoMaterno'=> 'required|regex:/^[\pL\s\-]+$/u|max:100',
            //'numeroDocumento'=> 'required|digits_between:8,20|numeric',
            'correo' => 'email|max:100',
            'sueldo' => 'required|numeric',
            //'fechaIngreso' => 'required|date',
            'idCargo' => 'required|numeric',
            //'idTipoDocumento' => 'required|numeric',
        ];
    }
}
