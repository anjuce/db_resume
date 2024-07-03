<?php

namespace App\Http\Requests\Company;

use Illuminate\Foundation\Http\FormRequest;

class IndexCompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'search' => 'nullable|string|max:255',
        ];
    }
}
