<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            'name'     => 'required',
            'price'    => 'required|numeric|min:1',
            'sale'     => 'required|numeric|min:0',
            'quantity' => 'required|numeric|min:1',
            'status'   => 'required'
        ];
    }

    public function messages()
    {
        parent::messages();

        return [
            'status.required' => 'Choose status service'
        ];
    }
}
