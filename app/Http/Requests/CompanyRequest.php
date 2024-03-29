<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'image_path' => 'nullable|string',
            'location' => 'required|string',
            'industry' => 'required|string'
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'name' => __('models/company.fillable.name'),
            'image_path' => __('models/company.fillable.image_path'),
            'location' => __('models/company.fillable.location'),
            'industry' => __('models/company.fillable.industry'),
        ];
    }
}
