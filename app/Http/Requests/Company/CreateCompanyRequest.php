<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class CreateCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'website' => 'nullable|string|url|max:255',
            'address' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:20',
        ];
    }
}
