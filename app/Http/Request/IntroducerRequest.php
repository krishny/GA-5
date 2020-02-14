<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IntroducerRequest extends FormRequest
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
            'int_id' => 'required',
            'introducer_ref' => 'required',
            'contact_name' => 'required',
            'comp_name' => 'required',
            'address' => 'required',
            'phone_no' => 'required',
            'fax_no' => 'required',
            'email' => 'required',
            'url' => 'required',
            'status' => 'required',

            
        ];
    }
}
