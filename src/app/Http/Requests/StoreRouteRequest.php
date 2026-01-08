<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRouteRequest extends FormRequest
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
            "routecategory_id" => ["required","integer"],
            "name" => ["required","string"],
            "remarks" => ["nullable","string"],
            "short_name" => ["nullable","string"],
            "short_number" => ["nullable","integer"],
            "delete_flags" => ["nullable","boolean"],
        ];
    }

     public function messages(): array
    {
        return [
            'routecategory_id.required' => 'カテゴリーを選択してください',
            'name.required' => '路線名を入力してください',
            'short_number.integer' => '短縮番号は数値を入力してください'
        ];
    }
}
