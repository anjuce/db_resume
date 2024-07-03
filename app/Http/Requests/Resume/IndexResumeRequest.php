<?php

namespace App\Http\Requests\Resume;

use Illuminate\Foundation\Http\FormRequest;

class IndexResumeRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'company' => 'nullable|integer|exists:companies,id',
            'position' => 'nullable|string',
        ];
    }
}
