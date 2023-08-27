<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
            // 'type' => 'required',
            'name_en' => ['required', 'string'],
            'name_ar' => ['required', 'string'],
            'image' => ['nullable', 'image'],
            'sub_category' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'نوع التصنيف مطلوب.',
            'name_ar.required' => 'اسم التصنيف باللغة العربية مطلوب.',
            'name_en.required' => 'اسم التصنيف باللغة الانكليزية مطلوب.',
            'sub_category.required' => 'التصنيف الفرعي لهذه الخدمة مطلوب.'
        ];
    }
}
