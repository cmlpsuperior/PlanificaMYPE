<?php

namespace PlanificaMYPE\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CargarMaterialesRequest extends FormRequest
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
            'idVehiculo' => 'required',
            'horaAlmacen' => 'date'
        ];
    }

    public function messages()
    {
        return [
            'idVehiculo.required' => 'Debe seleccionar el vehiculo utilizado',
            // ..
        ];
    }

}
