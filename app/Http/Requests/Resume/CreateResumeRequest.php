<?php

namespace App\Http\Requests\Resume;

use Illuminate\Foundation\Http\FormRequest;

class CreateResumeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'company_id' => 'required|exists:companies,id',
            'position' => 'required|string',
            'resume_text' => 'nullable|string',
            'resume_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ];
    }
}
