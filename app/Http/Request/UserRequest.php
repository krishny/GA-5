<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'first_name' => 'required',
            'sur_name' => 'required',
            'agent_id' => 'required',
            'email' => 'required',
            'login_name' => 'required',
            'password' => 'required',
            'operatorLevel' => 'required',
            'status' => 'required',
            
        ];
    }
}