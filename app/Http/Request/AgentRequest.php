<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgentRequest extends FormRequest
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
            'code' => 'required | unique',
            'name' => 'required',
            'addressI' => 'required',
            'addressII' => 'required',
            'addressIII' => 'required',
            'addressIV' => 'required',
           // 'postcode' => 'required|min:6|integer',
           //'postcode' => 'required|min:6|numeric',
           'postcode' => 'required',
            'website' => 'required',
            //'telephone_no' => 'required|numeric|size:10',
            'telephone_no' => 'required',
            'fax_no' => 'required',
            //'fax_no' => 'required|regex:/(01)[0-9]{9}/',
            'letter_head' => 'required',
            'logo_header_file' => 'required',
            'blank_lines' => 'required',
            'status' => 'required',
            'type' => 'required',
            'belongs_to' => 'required',
        ];
    }
}
