<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreConditionRequest extends FormRequest
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
            "conditioncategory_id" => ["required","integer"],
            "flag" => ["nullable","string"],
            "sort_order" => ["nullable","integer"],
            "content" => ["required","string"],
            "delete_flags" => ["nullable","boolean"],
        ];
    }

    public function messages(): array
    {
        return [
            'conditioncategory_id.required' => 'カテゴリを選択してください',
            'content.required' => '通行条件を入力してください',
            'sort_order.integer' => '優先順位は数値を入力してください'
        ];
    }
}
