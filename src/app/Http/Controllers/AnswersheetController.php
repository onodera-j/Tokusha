<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\Client;
use App\Models\Route;
use App\Models\RouteCategory;
use App\Models\Condition;
use App\Models\ConditionCategory;
use App\Models\AnswerDocumentSetting;
use App\Models\StaffMember;
use App\Models\PermissionPeriod;
use App\Models\Answerbase;
use App\Models\AnswerbaseFreeCondition;
use App\Models\AnswerbaseFreeNotCondition;
use App\Models\Counter;
use App\Models\Minwidth;
use App\Models\OtherDestination;
use App\Models\Vehicle;
use App\Http\Requests\AnswersheetRequest;

class AnswersheetController extends Controller
{
    public function answersheetCreate(){

        $staffMembers = StaffMember::where("delete_flags", 0)
                            ->get();
        $clients = Client::where("hidden", 0)
                            ->orderBy('prefecture_code', 'asc')->get();
        $answerSetting = AnswerDocumentSetting::first();
        $permissionPeriods = PermissionPeriod::all();
        $routeCategories = RouteCategory::all();
        $conditions = Condition::with('conditionCategory')
            ->where('delete_flags',0)
            ->wherebetween('conditioncategory_id',[1,9])
            ->orderByRaw("
                CASE
                    WHEN conditioncategory_id = 9 THEN 0
                    ELSE conditioncategory_id
                END
            ")
            ->orderByRaw('flag IS NULL')      // NULLを後ろへ
            ->orderBy('flag', 'asc')
            ->orderByRaw('sort_order IS NULL') // NULLを後ろへ
            ->orderBy('sort_order')
            ->get()
            ->groupBy('conditioncategory_id');

        $notAllows = Condition::with('conditionCategory')
            ->where('delete_flags',0)
            ->wherebetween('conditioncategory_id',[10,11])
            ->orderByRaw('flag IS NULL')      // NULLを後ろへ
            ->orderBy('flag', 'asc')
            ->orderByRaw('sort_order IS NULL') // NULLを後ろへ
            ->orderBy('sort_order')
            ->get()
            ->groupBy('conditioncategory_id');


        return view("answersheet.answersheet_create",compact("staffMembers","clients","answerSetting","permissionPeriods","routeCategories","conditions","notAllows"));
    }

     public function routeByCategory($categoryId)
    {
        return Route::where('routecategory_id', $categoryId)
            ->select('id', 'name', 'remarks')
            ->orderBy('id')
            ->get();
    }

    //協議回答書の新規作成
    public function answersheetRegistration(AnswersheetRequest $request){

        $action = $request->input('action');

        $validated = $request->validated();
        //寸法条件の抽出
        $widthConditions = $request->input('width_condition', []);
        if (in_array(2, $widthConditions)) {
            $widthConditionValue = 2;
        } elseif (in_array(1, $widthConditions)) {
            $widthConditionValue = 1;
        } else {
            $widthConditionValue = 0;
        }

        DB::beginTransaction();
        try{
            if($action === 'create'){
                //1.回答書ベースの登録
                $answer = Answerbase::create([
                    'sheet_type' => $validated['answersheet_type'],
                    'numbering_name' => $validated['numbering_name'],
                    'approval_number' => $validated['approval_number'],
                    'client_id' => $validated['client_id'],
                    'application_date' => $validated['application_date'],
                    'consultation_number' => $validated['consultation_number'],
                    'destination' => $validated['destination'],
                    'answer_year' => $validated['answer_year'],
                    'staff_id' => $validated['staff_id'],
                    'approval_date' => $validated['approval_date'],
                ]);

                $answerId = $answer->id;

                if($validated['answersheet_type'] == 4) {
                    $answer->counter()->create([
                        'name' => $validated['applicant_name'],
                        'permission_period_id' => $validated['permission_period'],
                    ]);
                }

                if($validated['destination2']) {
                    $answer->otherDestination()->create([
                        'second_destination' => $validated['destination2'],
                    ]);
                }

                //2.車両情報の登録

                if(!empty($validated['roadname_both'])) {
                    $answer->minWidths()->create([
                        'road_condition' => 2,
                        'road_name' => $validated['roadname_both'],
                        'min_width' => $validated['minwidth_both'],
                        'width_condition' => $widthConditionValue
                    ]);
                }
                if(!empty($validated['roadname_one'])) {
                    $answer->minWidths()->create([
                        'road_condition' => 1,
                        'road_name' => $validated['roadname_one'],
                        'min_width' => $validated['minwidth_one'],
                        'width_condition' => $widthConditionValue
                    ]);
                }

                if($request->has('application_number')) {
                    foreach($validated['application_number'] as $index => $val) {
                        $weight = $validated['car_weight'][$index] ??null;
                        $length = $validated['car_length'][$index] ??null;
                        $width = $validated['car_width'][$index] ??null;
                        $height = $validated['car_height'][$index] ??null;
                        $radius = $validated['car_radius'][$index] ??null;

                        if(!empty($val) || !empty($weight) || !empty($width)) {
                            $answer->vehicles()->create([
                                'application_number' => $val,
                                'weight'         => $weight,
                                'length'         => $length,
                                'width'          => $width,
                                'height'         => $height,
                                'radius'         => $radius,
                            ]);
                        }
                    }
                }

                //3.経路・通行条件の登録
                $validated['route_id'] = $validated['route_id'] ?? [];
                $validated['not_route_id'] = $validated['not_route_id'] ?? [];
                $validated['condition_id'] = $validated['condition_id'] ?? [];
                $validated['not_condition_id'] = $validated['not_condition_id'] ?? [];

                $routeIds = array_filter($validated['route_id']);
                $notRouteIds = array_filter($validated['not_route_id']);
                $conditionIds = [];
                $notConditionIds = [];

                if($validated['answersheet_type'] != 3) {
                    //(1)回答書1,2,4の経路・通行条件の登録

                    if(!empty($routeIds)) {
                        $answer->allowRoutes()->attach($routeIds);
                    }


                    foreach($validated['condition_id'] as $index => $val) {
                        if(empty($val)){
                            continue;
                        }

                        if($val != -1) {
                            $conditionIds[] = $val;
                        }
                    }

                    if(!empty($conditionIds)) {
                        $answer->allowConditions()->attach($conditionIds);
                    }

                    if(in_array('-1', $validated['condition_id']) && !empty($validated['conditions_free'])) {
                        $answer->allowFreeCondition()->create([
                            'condition_id' => -1,
                            'condition_free' => $validated['conditions_free'],
                        ]);
                    }


                    //（2）回答書2の不許可経路・理由の登録
                    if($validated['answersheet_type'] == 2){

                        if(!empty($notRouteIds)){
                            $answer->notAllowRoutes()->attach($notRouteIds);
                        }


                        foreach($validated['not_condition_id'] as $index => $val) {
                            if(empty($val)){
                                continue;
                            }

                            if($val != -10 && $val != -11) {
                                $notConditionIds[] = $val;
                            }else{
                                    $categoryId = abs($val);
                                    $freeText = $validated['not_conditions_free'][$categoryId] ?? null;
                                if(!empty($freeText)) {
                                    $answer->notFreeConditions()->create([
                                        'not_condition_id' => $val,
                                        'condition_free' => $freeText,
                                    ]);
                                }
                            }
                        }

                        if(!empty($notConditionIds)) {
                            $answer->notAllowConditions()->attach($notConditionIds);
                        }
                    }

                }else{
                    //（3）回答書3の不許可経路・理由の登録
                    if(!empty($notRouteIds)) {
                            $answer->notAllowRoutes()->attach($notRouteIds);
                        }


                    foreach($validated['not_condition_id'] as $index => $val) {
                        if(empty($val)){
                            continue;
                        }

                        if($val != -10 && $val != -11) {
                            $notConditionIds[] = $val;
                        }else{
                                $categoryId = abs($val);
                                $freeText = $validated['not_conditions_free'][$categoryId] ?? null;
                            if(!empty($freeText)) {
                                $answer->notFreeConditions()->create([
                                    'not_condition_id' => $val,
                                    'condition_free' => $freeText,
                                ]);
                            }
                        }
                    }

                    if(!empty($notConditionIds)) {
                            $answer->notAllowConditions()->attach($notConditionIds);
                        }
                }

            DB::commit();

            return redirect("/history")->with("success", "新規登録が完了しました");
            }

            if($action === 'update' || $action === 'preview'){

                $answer = Answerbase::findOrFail($request->input('answer_id'));

                //1.回答書ベースの更新
                $answer->update([
                    'sheet_type' => $validated['answersheet_type'],
                    'numbering_name' => $validated['numbering_name'],
                    'approval_number' => $validated['approval_number'],
                    'client_id' => $validated['client_id'],
                    'application_date' => $validated['application_date'],
                    'consultation_number' => $validated['consultation_number'],
                    'destination' => $validated['destination'],
                    'answer_year' => $validated['answer_year'],
                    'staff_id' => $validated['staff_id'],
                    'approval_date' => $validated['approval_date'],
                ]);

                if(!empty($validated['destination2'])){
                    $answer->otherDestination()->updateOrCreate(
                        ['answerbase_id' => $answer->id],
                        ['second_destination' => $validated['destination2']],
                    );
                }else{
                    if($answer->otherDestination()->exists()) {
                        $answer->otherDestination()->delete();
                    }
                }

                if($validated['answersheet_type'] == 4){
                    $answer->counter()->updateOrCreate(
                        ['answerbase_id' => $answer->id],
                        [
                            'name' => $validated['applicant_name'],
                            'permission_period_id' => $validated['permission_period'],
                        ],
                    );
                }else{
                    if ($answer->counter()->exists()) {
                        $answer->counter()->delete();
                    }
                }

                //2.車両情報の更新

                if(!empty($validated['roadname_both'])) {
                    $answer->minWidths()->updateOrCreate(
                        [
                            'answerbase_id' => $answer->id,
                            'road_condition' => 2,
                        ],
                        [
                            'road_name' => $validated['roadname_both'],
                            'min_width' => $validated['minwidth_both'],
                            'width_condition' => $widthConditionValue
                        ]
                    );
                }else{
                    $answer->minWidths()->where('road_condition', 2)->delete();
                }

                if(!empty($validated['roadname_one'])) {
                    $answer->minWidths()->updateOrCreate(
                        [
                            'answerbase_id' => $answer->id,
                            'road_condition' => 1,
                        ],
                        [
                            'road_name' => $validated['roadname_one'],
                            'min_width' => $validated['minwidth_one'],
                            'width_condition' => $widthConditionValue
                        ]
                    );
                }else{
                    $answer->minWidths()->where('road_condition', 1)->delete();
                }

                $answer->vehicles()->delete();

                if($request->has('application_number')) {
                    foreach($validated['application_number'] as $index => $val) {
                        $weight = $validated['car_weight'][$index] ??null;
                        $length = $validated['car_length'][$index] ??null;
                        $width = $validated['car_width'][$index] ??null;
                        $height = $validated['car_height'][$index] ??null;
                        $radius = $validated['car_radius'][$index] ??null;

                        if(!empty($val) || !empty($weight) || !empty($width)) {
                            $answer->vehicles()->create([
                                'application_number' => $val,
                                'weight'         => $weight,
                                'length'         => $length,
                                'width'          => $width,
                                'height'         => $height,
                                'radius'         => $radius,
                            ]);
                        }
                    }
                }

                //3.通路・通行条件の更新

                $validated['route_id'] = $validated['route_id'] ?? [];
                $validated['not_route_id'] = $validated['not_route_id'] ?? [];
                $validated['condition_id'] = $validated['condition_id'] ?? [];
                $validated['not_condition_id'] = $validated['not_condition_id'] ?? [];

                $routeIds = array_filter($validated['route_id']);
                $notRouteIds = array_filter($validated['not_route_id']);
                $conditionIds = [];
                $notConditionIds = [];
                $checkedNotFreeIds = [];

                foreach($validated['condition_id'] as $index => $val) {
                    if(empty($val)){
                        continue;
                    }

                    if($val != -1) {
                        $conditionIds[] = $val;
                    }
                }

                $answer->allowRoutes()->sync($routeIds);
                $answer->allowConditions()->sync($conditionIds);

                if(in_array('-1', $validated['condition_id']) && !empty($validated['conditions_free'])) {
                    $answer->allowFreeCondition()->updateOrCreate(
                        ['condition_id' => -1],
                        ['condition_free' => $validated['conditions_free'],]
                    );
                } else {
                    if($answer->allowFreeCondition()->exists()) {
                        $answer->allowFreeCondition()->delete();
                    }
                }


                foreach($validated['not_condition_id'] as $index => $val) {
                    if(empty($val)){
                        continue;
                    }

                    if($val != -10 && $val != -11) {
                        $notConditionIds[] = $val;
                    }else{
                        $checkedNotFreeIds[] = $val;
                        $categoryId = abs($val);
                        $freeText = $validated['not_conditions_free'][$categoryId] ?? null;
                        if(!empty($freeText)) {
                            $answer->notFreeConditions()->updateOrCreate(
                                [
                                    'answerbase_id' => $answer->id,
                                    'not_condition_id' => $val,
                                ],
                                ['condition_free' => $freeText,]
                            );
                        }
                    }
                }

                $answer->notAllowRoutes()->sync($notRouteIds);
                $answer->notAllowConditions()->sync($notConditionIds);
                if ($answer->notFreeConditions()->whereNotIn('not_condition_id', $checkedNotFreeIds)->exists()) {
                    $answer->notFreeConditions()->whereNotIn('not_condition_id', $checkedNotFreeIds)->delete();
                }
            DB::commit();

            if($action === 'preview'){
                $answerData = Answerbase::with([
                    'allowRoutes',
                    'notAllowRoutes',
                    'allowConditions',
                    'allowFreeCondition',
                    'notAllowConditions',
                    'notFreeConditions',
                    'otherDestination',
                    'counter',
                    'client',
                    'staffs',
                ])->find($answer->id);

                $answerSetting = AnswerDocumentSetting::first();


                return view("history.history_preview", compact('answerData', 'answerSetting'));

            }

            return redirect()->back()->with('success', 'データを上書きしました');
            }

    }catch(\Exception $e) {
        DB::rollback();
        Log::error("Error: " . $e->getMessage());
        return back()->withErrors(["error", "エラーが発生しました"]);
        }
    }

    //回答書作成履歴ページの表示
    public function historyList() {

        $answerDatas = Answerbase::with(['allowRoutes', 'notAllowRoutes', 'client', 'counter'])
                        ->orderBy('numbering_name', 'desc')
                        ->orderByRaw('CAST(approval_number AS UNSIGNED) DESC')
                        ->latest()->paginate(5);

        $type = 0;
        $word = null;


        return view("history.history", compact('answerDatas', 'type', 'word'));
    }

    //回答書作成履歴の検索
    public function historySearch(Request $request) {

        $type = $request->input('search_type');
        $word = $request->input('keyword');

        $query = Answerbase::with(['allowRoutes', 'notAllowRoutes', 'client', 'counter']);

        if(!empty($word)) {
            switch($type) {
                case 1:
                    $query->where(function($q) use ($word) {
                        $q->where('numbering_name', 'LIKE', "%{$word}%")
                          ->orWhere('approval_number', 'LIKE', "%{$word}%");
                    });
                break;

                case 2:
                    $query->whereHas('client', function($q) use ($word) {
                        $q->where('name', 'LIKE', "%{$word}%");
                    });
                break;

                case 3:
                $query->where('consultation_number', 'LIKE', "%{$word}%");
                break;

                case 4: // 目的地（例: destination カラムや、別テーブルの second_destination）
                    $query->where(function($q) use ($word) {
                        $q->where('destination', 'LIKE', "%{$word}%")
                        ->orWhereHas('otherDestination', function($sq) use ($word) {
                            $sq->where('second_destination', 'LIKE', "%{$word}%");
                        });
                    });
                break;

                case 5:
                    $query->where(function($q) use ($word) {
                        $q->whereHas('allowRoutes', function($sq) use ($word) {
                            $sq->where('short_name', 'LIKE', "%{$word}%")
                               ->orWhere('short_number', 'LIKE', "%{$word}%");
                        })
                        ->orWhereHas('notAllowRoutes', function($sq) use ($word) {
                            $sq->where('short_name', 'LIKE', "%{$word}%")
                               ->orWhere('short_number', 'LIKE', "%{$word}%");
                        });
                    });
                break;

                default:
                    $query->where(function($q) use ($word) {
                        $q->where('numbering_name', 'LIKE', "%{$word}%")
                          ->orWhere('approval_number', 'LIKE', "%{$word}%")
                          ->orWhere('consultation_number', 'LIKE', "%{$word}%")
                          ->orWhere('destination', 'LIKE', "%{$word}%")
                          ->orWhereHas('client', function($sq) use ($word) {
                                $sq->where('name', 'LIKE', "%{$word}%"); })
                          ->orWhereHas('otherDestination', function($sq) use ($word) {
                                $sq->where('second_destination', 'LIKE', "%{$word}%"); })
                          ->orWhereHas('allowRoutes', function($sq) use ($word) {
                                $sq->where('short_name', 'LIKE', "%{$word}%")
                                    ->orWhere('short_number', 'LIKE', "%{$word}%"); })
                          ->orWhereHas('notAllowRoutes', function($sq) use ($word) {
                                $sq->where('short_name', 'LIKE', "%{$word}%")
                                    ->orWhere('short_number', 'LIKE', "%{$word}%"); });
                    });
                break;
            }
        }

        $answerDatas = $query
                        ->orderBy('numbering_name', 'desc')
                        ->orderBy('approval_number', 'desc')
                        ->latest()->paginate(5);


        return view("history.history", compact('answerDatas', 'type', 'word' ));

    }

    //回答書作成履歴詳細ページの表示
    public function historyEdit(Request $request){
        $id = $request->id;
        $answerData = Answerbase::with(['allowRoutes', 'notAllowRoutes', 'allowConditions', 'allowFreeCondition', 'notAllowConditions', 'notFreeConditions', 'counter', 'minWidths', 'otherDestination', 'vehicles', 'client', 'staffs', ])->find($id);

        $staffMembers = StaffMember::where("delete_flags", 0)
                            ->get();
        $clients = Client::where("hidden", 0)
                            ->orderBy('prefecture_code', 'asc')->get();
        $answerSetting = AnswerDocumentSetting::first();
        $permissionPeriods = PermissionPeriod::all();
        $routeCategories = RouteCategory::all();
        $conditions = Condition::with('conditionCategory')
            ->where('delete_flags',0)
            ->wherebetween('conditioncategory_id',[1,9])
            ->orderByRaw("
                CASE
                    WHEN conditioncategory_id = 9 THEN 0
                    ELSE conditioncategory_id
                END
            ")
            ->orderByRaw('flag IS NULL')      // NULLを後ろへ
            ->orderBy('flag', 'asc')
            ->orderByRaw('sort_order IS NULL') // NULLを後ろへ
            ->orderBy('sort_order')
            ->get()
            ->groupBy('conditioncategory_id');

        $notAllows = Condition::with('conditionCategory')
            ->where('delete_flags',0)
            ->wherebetween('conditioncategory_id',[10,11])
            ->orderByRaw('flag IS NULL')      // NULLを後ろへ
            ->orderBy('flag', 'asc')
            ->orderByRaw('sort_order IS NULL') // NULLを後ろへ
            ->orderBy('sort_order')
            ->get()
            ->groupBy('conditioncategory_id');

        return view("history.history_edit", compact("answerData", "staffMembers", "clients", "answerSetting", "permissionPeriods", "routeCategories", "conditions", "notAllows"));
    }


}
