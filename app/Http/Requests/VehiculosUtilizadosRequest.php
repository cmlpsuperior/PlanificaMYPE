<?php

namespace PlanificaMYPE\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VehiculosUtilizadosRequest extends FormRequest
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
            'idTiposVehiculos' => 'required'            
        ];
    }

    public function messages()
    {
        return [
            'idTiposVehiculos.required' => 'Debe seleccionar al menos un tipo de vehiculo',
            // ..
        ];
    }
}
