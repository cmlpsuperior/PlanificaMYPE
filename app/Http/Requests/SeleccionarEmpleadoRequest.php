<?php

namespace PlanificaMYPE\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeleccionarEmpleadoRequest extends FormRequest
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
            'seleccionarEmpleado' =>'required'
        ];
    }

    public function messages()
    {
        return [
            'seleccionarEmpleado.required' => 'Debe seleccionar un empleado',
            // ..
        ];
    }
}
