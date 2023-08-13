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
            'phone' => 'required',
            'city' => 'required',
            'password' => ['required', 'min:6'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب.',
            'phone.required' => 'رقم الهاتف مطلوب.',
            'city.required' => 'اسم المدينة مطلوب.',
            'password.required' => 'كلمة السر مطلوبة.'
        ];
    }
}
