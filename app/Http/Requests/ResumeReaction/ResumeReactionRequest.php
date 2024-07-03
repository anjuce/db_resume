<?php

namespace App\Http\Requests\ResumeReaction;

use Illuminate\Foundation\Http\FormRequest;

class ResumeReactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
    {
        return [
            'company_id' => 'required|exists:companies,id',
            'resume_id' => 'required|exists:resumes,id',
            'is_positive' => 'required|boolean',
        ];
    }
}
