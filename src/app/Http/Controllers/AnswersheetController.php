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
                    $answer->counters()->create([
                        'name' => $validated['applicant_name'],
                        'permission_period' => $validated['permission_period'],
                    ]);
                }

                if($validated['destination2']) {
                    $answer->otherDestinations()->create([
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
                            $answer->notAllowConditions()->attach($notconditionIds);
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

    }catch(\Exception $e) {
        DB::rollback();
        Log::error("Error: " . $e->getMessage());
        return back()->withErrors(["error", "エラーが発生しました"]);
        }
    }


}
