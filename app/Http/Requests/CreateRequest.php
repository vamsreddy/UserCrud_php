<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class CreateRequest extends FormRequest
{

    public function failedValidation(Validator $validator) 
    { 
       throw new HttpResponseException(response()->json($validator->errors(), 422)); 
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required','min:3','max:20','unique:users'],
            'email' => ['required','email','unique:users'],
            'password' =>['required','min:8','max:16','regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[!@#$%^&*-])/'],
            'status' => ['required','boolean'],
        ];
    }


    // public function messages()
    // {
    //     return [
    //         'name.required' => __('validation.users.name.required'),
    //         'name.unique' => __('validation.users.name.unique'),
    //         'name.min' => __('validation.user.name.must be at least 3 characters'),
    //         'email.required' => __('validation.users.email.required'),
    //         'email.unique' => __('validation.users.email.unique'),
    //         'password.required' => __('validation.users.password.required'),
    //         'status.required' => __('validation.users.status.required'),
    //     ];
    // }
}
