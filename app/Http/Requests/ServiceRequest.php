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
        $id = $this->service ? $this->service->id : null;

        return [
            'name'     => 'required|unique:services,name,'.$id,
            'price'    => 'required|integer',
            'sale'     => 'required|integer',
            'quantity' => 'required|integer',
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
