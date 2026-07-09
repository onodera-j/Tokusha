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
            "position" => ["required","string"],
            "administrator_name" => ["required","string"],
            "department" => ["required","string"],
            "tel" => ["required","string"],
            "fax" => ["required","string"],
            "extension" => ["nullable","integer"],
            "postcode" => ["required","string"],
            "address" => ["required","string"],

        ];
    }

    public function messages(): array
    {
        return [
            'numbering_name.required' => '回答書採番名してください',
            'answer_year.required' => '回答書決裁年を入力してください',
            'position.required' => '道路管理者 役職名を入力してください',
            'administrator_name.required' => '道路管理者 名前を入力してください',
            'department.required' => '担当部署を入力してください',
            'tel.required' => 'TELを入力してください',
            'fax.required' => 'FAXを入力してください',
            'extension.integer' => '係内線は数値を入力してください',
            'postcode.required' => '郵便番号を入力してください',
            'address.required' => '住所を入力してください',

        ];
    }
}
