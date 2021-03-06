<?php

namespace PlanificaMYPE\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticuloFormRequest extends FormRequest
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
            'nombre' => 'max:100',
            'precioBase' => 'required|numeric',
            'stock' => 'required|numeric',
            'volumen' => 'required|numeric',
            'minimoDivisible' => 'required|numeric',
            //'combinable' => 'required',
            'idMarca' => 'required|integer',
            'idTipoCarga' => 'required|integer',
            'idUnidadMedida' => 'required|integer',

                    ];
    }
}
