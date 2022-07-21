<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'company_id' => 'required',
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email_address' => 'required|email',
            'position' => 'required|max:255',
            'city' => 'required|max:255',
            'country' => 'required|max:255',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'company_name.required' => 'Company Name is required',
            'first_name.max' => 'First name can not be more than 255 characters',
            'email_address.email' => 'This email address does not exist',
        ];
    }

    public function attributes()
    {
        return [
            'last_name' => 'Sirname',
        ];
    }
}
