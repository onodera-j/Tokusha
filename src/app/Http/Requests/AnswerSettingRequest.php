<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswerSettingRequest extends FormRequest
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
            "numbering_name" => ["required","string"],
            "answer_year" => ["required","string"],
        ];
    }

    public function messages(): array
    {
        return [
            'numbering_name.required' => '回答書採番名してください',
            'answer_year.required' => '回答書決裁年を入力してください',
        ];
    }
}
