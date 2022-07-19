<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ComapnyRequest extends FormRequest
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
            'company_name' => 'required|unique:companies|max:255',
            'company_type' => 'required',
            'website' => 'required|url',
            'company_description' => 'required'
        ];
    }
}
