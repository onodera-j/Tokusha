<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswersheetRequest extends FormRequest
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
            //◎基本情報
            'answersheet_type' => 'required|in:1,2,3,4',
            'staff_id' => 'required', // 担当者・送り先など
            'client_id' => 'required',
            'application_date' => 'required|date',
            //窓口(4)以外の場合は「相手方の協議番号」必須
            'consultation_number' => 'required_if:answersheet_type,1,2,3',
            'destination' => 'required',
            'destination2' => 'string|nullable',
            'approval_number' => 'required',
            'numbering_name' => 'required',
            'answer_year' => 'required',
            'approval_date' => 'nullable|date',
            // 窓口(4) の時だけ「申請者名」と「通行許可期間」を必須にする
            'applicant_name' => 'required_if:answersheet_type,4',
            'permission_period' => 'required_if:answersheet_type,4',

            //◎幅員チェック
            'width_condition' => 'array',
            'roadname_both' => 'string|nullable',
            'roadname_one' => 'string|nullable',
            'minwidth_both' => 'integer|nullable',
            'minwidth_one' => 'integer|nullable',

            'application_number.0' => 'required|string',
            'application_number.*' => 'nullable|string',
            'car_weight.0' => 'integer|required',
            'car_weight.*' => 'integer|nullable|',
            'car_length.0' => 'integer|required',
            'car_length.*' => 'integer|nullable',
            'car_width.0' => 'integer|required',
            'car_width.*' => 'integer|nullable',
            'car_height.0' => 'integer|required',
            'car_height.*' => 'integer|nullable',
            'car_radius.0' => 'integer|required',
            'car_radius.*' => 'integer|nullable',


            //◎経路・通行条件
            // 許可(1), 許可兼不許可(2), 窓口(4) の場合は「経路」「条件」が必須
            'route_category' => [
                'required_if:answersheet_type,1,2,4',
                'array',
                'min:1',
            ],
            'route_category.0' => 'required_if:answersheet_type,1,2,4',
            'route_category.*' => 'nullable',

            'condition_id' => [
                'required_if:answersheet_type,1,2,4',
                'array',
            ],
            'condition_id.*' => 'nullable',

            'route_id' => 'array|nullable',
            'route_id.*' => 'integer|nullable',

            //◎不許可経路・理由
            // 不許可(3), 許可兼不許可(2) の場合は「不許可経路」「不許可理由」のチェックが必須
            'not_route_category' => [
                'required_if:answersheet_type,2,3',
                'array',
                'min:1',
            ],
            'not_route_category.0' => 'required_if:answersheet_type,2,3',
            'not_route_category.*' => 'nullable',
            'not_condition_id' => [
                'required_if:answersheet_type,2,3',
                'array'
            ],
            'not_condition_id.*' => 'nullable',

            'not_route_id' => 'array|nullable',
            'not_route_id.*' => 'integer|nullable',


            // 自由記述にチェックがあるときはテキスト入力を必須にする
            'conditions_free' => 'required_if:condition_id.*,-1',
            'not_conditions_free' => 'required_if:condition_id.*,-10,-11',

            'answer_remarks' => 'nullable',
            'fax_remarks' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'answersheet_type.required' => '【基本情報】作成する回答書の種類を選択してください',
            'staff_id.required' => '【基本情報】担当者を選択してください',
            'client_id.required' => '【基本情報】送り先を選択してください。窓口申請の場合は「窓口申請（右欄に申請者名）を選択してください」',
            'application_date.required' => '【基本情報】特車申請日を入力してください',
            'application_date.date' => '【基本情報】特車申請日は日付「Y-m-d」で入力してください',
            'consultation_number.required_if' => '【基本情報】相手方の協議番号を入力してください',
            'destination.required' => '【基本情報】目的地を入力してください',
            'approval_number.required' => '【基本情報】決裁番号を入力してください',
            'numbering_name.required' => '【基本情報】回答書採番を入力してください',
            'answer_year.required' => '【基本情報】回答書決裁年を入力してください',
            'application_date.date' => '【基本情報】特車申請日は日付「Y-m-d」で入力してください',

            'applicant_name.required_if' => '【基本情報】申請者名を入力してください',
            'permission_period.required_if' => '【基本情報】通行許可期間を入力してください',

            'minwidth_both' => '【幅員チェック】双方通行：最小幅員は数値を入力してください',
            'minwidth_one' => '【幅員チェック】一方通行：最小幅員は数値を入力してください',

            'application_number.0.required' => '【幅員チェック】番号は少なくとも１件入力してください',
            'car_weight.0.required' => '【幅員チェック】重量は少なくとも1件入力してください',
            'car_weight.*.integer'  => '【幅員チェック】重量は数値を入力してください',
            'car_length.0.required' => '【幅員チェック】長さは少なくとも1件入力してください',
            'car_length.*.integer'  => '【幅員チェック】長さは数値を入力してください',
            'car_width.0.required' => '【幅員チェック】幅は少なくとも1件入力してください',
            'car_width.*.integer'  => '【幅員チェック】幅は数値を入力してください',
            'car_height.0.required' => '【幅員チェック】高さは少なくとも1件入力してください',
            'car_height.*.integer'  => '【幅員チェック】高さは数値を入力してください',
            'car_radius.0.required' => '【幅員チェック】最小回転半径は少なくとも1件入力してください',
            'car_radius.*.integer'  => '【幅員チェック】最小回転半径は数値を入力してください',

            'route_category.0.required_if' => '【経路・通行条件】経路を選択してください',
            'condition_id.required_if' => '【経路・通行条件】通行条件を選択してください',
            'conditions_free.required_if' => '【経路・通行条件】通行条件の自由記述欄に内容を入力してください',
            'not_route_category.0.required_if' => '【不許可経路・理由】不許可となる経路を選択してください',
            'not_condition_id.required_if' => '【不許可経路・理由】不許可となる道路状況と理由を選択してください',
            'not_conditions_free.required_if' => '【不許可経路・理由】自由記述欄に内容を入力してください',
        ];
    }
}
