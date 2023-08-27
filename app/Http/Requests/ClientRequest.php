<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
{
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
            'name' => 'required',
            'email' => ['nullable', 'email'],
            'phone' => ['required', 'unique:clients,phone,except,id'],
            'city' => 'required',
            'password' => ['required', 'min:6'],

            'home' => 'nullable',
            'longitude' => 'nullable',
            'latitude' => 'nullable',
            'addresses' => 'nullable|array',
            'is_current' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب.',
            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.unique' => 'رقم الهاتف موجود مسبقا.',
            'city.required' => 'اسم المدينة مطلوب.',
            'password.required' => 'كلمة السر مطلوبة.'
        ];
    }
}
