<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MaintenanceTechnicianRequest extends FormRequest
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
            'phone' => ['required', 'unique:maintenance_technicians,phone,except,id'],
            'password' => ['required', 'min:6'],
            'city' => 'required',
            'bank' => 'required',
            'account_number' => 'required',
            'photo' => ['nullable', 'image'],
            'residency_photo' => ['nullable', 'image'],
            'main_category' => 'required',
            'sub_category' => 'required',
            'service' => 'required',

            'longitude' => 'nullable',
            'latitude' => 'nullable'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'الاسم مطلوب.',
            'phone.required' => 'رقم الهاتف مطلوب.',
            'phone.unique' => 'رقم الهاتف موجود مسبقا.',
            'city.required' => 'اسم المدينة مطلوب.',
            'password.required' => 'كلمة السر مطلوبة.',
            'bank.required' => 'اسم البنك مطلوب.',
            'account_number' => 'رقم الحساب مطلوب.',
            'main_category' => 'التصنيف الرئيسي مطلوب.',
            'sub_category' => 'التصنيف الفرعي مطلوب.',
            'service' => 'الخدمة مطلوبة.',
        ];
    }
}
