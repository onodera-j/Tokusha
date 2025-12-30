<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClientRequest extends FormRequest
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
            "name" => ["required","string"],
            "short_name" => ["required","string"],
            "prefecture_code" => ["required","integer"],
            "tel" => ["required","string"],
            "fax" => ["required","string"],
            "answer_address1" => ["required","string"],
            "answer_address2" => ["nullable","string"],
            "numbering_name" => ["required","string"],
            "fax_address1" => ["required","string"],
            "fax_address2" => ["nullable","string"],
            "fax_address3" => ["required","string"],
            "hidden" => ["nullable", "boolean"],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => '事務所名を入力してください',
            'short_name.required' => '短縮名を入力してください',
            'prefecture_code.required' => '都道府県を選択してください',
            'tel.required' => '電話番号を入力してください',
            'fax.required' => 'FAX番号を入力してください',
            'answer_address1.required' => '宛先1を入力してください',
            'numbering_name.required' => '相手先の採番名を入力してください',
            'fax_address1.required' => '宛先1を入力してください',
            'fax_address3.required' => '宛先3を入力してください',
        ];
    }
}
