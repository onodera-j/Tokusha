@extends('layouts.app')

@section("css")
<link rel="stylesheet" href="{{ asset('css/answersheet.css') }}" />
@endsection

@section("content")

<div class="content">
    <form method="POST" action="/answersheet/registration">
        @csrf
    <div class="content-menu">
        <div class="menu-title">
            作成する回答書の種類
        </div>
        <div class="radio-form">
            <div class="radio-group">
                <input type="radio" name="answersheet_type" value=1 id="radio1" {{ old('answersheet_type', $answerData->sheet_type) == '1' ? 'checked' : '' }}><label for="radio1" >許可回答</label>
            </div>
                <div class="radio-group">
                <input type="radio" name="answersheet_type" value=2 id="radio2" {{ old('answersheet_type', $answerData->sheet_type) == '2' ? 'checked' : '' }}><label for="radio2">許可兼不許可回答</label>
            </div>
                <div class="radio-group">
                <input type="radio" name="answersheet_type" value=3 id="radio3" {{ old('answersheet_type', $answerData->sheet_type) == '3' ? 'checked' : '' }}><label for="radio3">不許可回答</label>
            </div>
                <div class="radio-group">
                <input type="radio" name="answersheet_type" value=4 id="radio4" {{ old('answersheet_type', $answerData->sheet_type) == '4' ? 'checked' : '' }}><label for="radio4">窓口申請回答</label>
            </div>
        </div>
    </div>
    <div class="alert-error">
        <ul>
            @foreach($errors->all() as $error)
                        <li>
                        {{ $error }}
                        </li>
            @endforeach
            @if(session("success"))
                <li class="alert-success">
                    {{ session("success") }}
                </li>
    @endif
        </ul>
    </div>

    <div class="content-sub">
        <ul class="tab-menu">
            <li class="list-item1">
                <button type="submit" name="action" value="create" class="link-button">新規で登録</button>
            </li>
        </ul>
    </div>

    <div class="tab-1">
    <label class="tab-label">
        <input type="radio" name="tab-1" checked>
        基本情報
    </label>
    <div class="tab-content">
        <div class="form-container two-column">
            <div class="form-block">
                <div class="form-group">
                    <div class="item-title required">
                        担当者
                    </div>
                    <div class="item-form">
                        <select name="staff_id">
                            <option value="">担当者を選択してください</option>
                            @foreach($staffMembers as $staffMember)
                                <option value={{$staffMember->id}}
                                    {{ old('staff_id', $answerData->staff_id ?? '') == $staffMember->id ? 'selected' : ''}}>
                                    {{$staffMember->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="item-title required">
                        送り先
                    </div>
                    <div class="item-form">
                        <select name="client_id">
                            <option value="" {{ old('client_id') == '' ? 'selected' : ''}}>相手先を選択してください</option>
                            <option value="0" {{ old('client_id') == '0' ? 'selected' : ''}}>窓口申請(右欄に申請者名)</option>
                            @foreach($clients as $client)
                                <option value={{$client->id}}
                                    {{ old('client_id', $answerData->client_id ?? '') == $client->id ? 'selected' : ''}}>{{$client->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="item-title required">
                        特車申請日
                    </div>
                    <div class="item-form">
                        <input type="date" name="application_date" value="{{ old('application_date', $answerData->application_date ?? '') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="item-title required">
                        相手方の協議番号
                    </div>
                    <div class="item-form">
                        <input type="text" name="consultation_number" value="{{old('consultation_number', $answerData->consultation_number ?? '')}}" placeholder="123456">
                    </div>
                </div>
                <div class="form-group">
                    <div class="item-title required">
                        目的地
                    </div>
                    <div class="item-form">
                        <input type="text" name="destination" value="{{old('destination', $answerData->destination ?? '')}}" placeholder="宇田川町1-1">
                    </div>
                </div>
                <div class="form-group">
                    <div class="item-title required">
                        決裁番号
                    </div>
                    <div class="item-form">
                        <input type="text" name="approval_number" value="{{old('approval_number', $answerData->approval_number ?? '')}}" placeholder="1">
                    </div>
                </div>
            </div>
            <div class="form-block">
                <div class="form-group">
                    <div class="item-title required">
                        回答書採番
                    </div>
                    <div class="item-form">
                        <input type="text" name="numbering_name" value="{{ old('numbering_name',$answerData->numbering_name)}}" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="item-title required">
                        回答書決裁年
                    </div>
                    <div class="item-form">
                        <input type="text" name="answer_year" value="{{old('answer_year',$answerData->answer_year)}}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="item-title madoguchi">
                        申請者名
                    </div>
                    <div class="item-form">
                        <input type="text" name="applicant_name" value="{{old('applicant_name', $answerData->counter->name ?? '')}}" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="item-title madoguchi">
                        通行許可期間
                    </div>
                    <div class="item-form">
                        <select name="permission_period">
                            <option value="">窓口の場合のみ選択</option>
                            @foreach($permissionPeriods as $permissionPeriod)
                                <option value={{$permissionPeriod->id}}
                                    {{ old('permission_period', $answerData->counter->permission_period ?? '') == $permissionPeriod->id ? 'selected' : ''}}>{{$permissionPeriod->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="item-title any">
                        目的地2
                    </div>
                    <div class="item-form">
                        <input type="text" name="destination2" value="{{old('destination2', $answerData->otherDestinations->second_destination ?? '')}}" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="item-title any">
                        決裁日
                    </div>
                    <div class="item-form">
                        <input type="date" name="approval_date" value="{{old('approval_date', $answerData->approval_date ?? '')}}" placeholder="">
                    </div>
                </div>

            </div>
        </div>
    </div>

    <label class="tab-label">
        <input type="radio" name="tab-1">
        幅員チェック
    </label>
    <div class="tab-content">
        <div class="form-container two-column">
            <div class="left-column">
                <div class="roadinformation-block">
                    <div class="roadinformation-group">
                        <div><span class="style-bold">最小幅員道路</span></div>
                        <div><span class="style-bold">双方通行</span></div>
                        <div></div>
                        <div><span class="style-bold">一方通行</span></div>
                    </div>
                    <div class="roadinformation-group">
                        区道名
                        <input type="text" name="roadname_both" value="{{old('roadname_both', $answerData->minWidths->where('road_condition', 1)->first()?->road_name) }}">
                        区道名
                        <input type="text" name="roadname_one" value="{{old('roadname_one', $answerData->minWidths->where('road_condition', 2)->first()?->road_name) }}">
                    </div>

                    <div class="roadinformation-group">
                        最小幅員（cm）
                        <input type="text" class="js-both-min" name="minwidth_both" value="{{old('minwidth_both', $answerData->minWidths->where('road_condition', 1)->first()?->min_width)}}">
                        最小幅員（cm）
                        <input type="text" class="js-one-min" name="minwidth_one" value="{{old('minwidth_one', $answerData->minWidths->where('road_condition', 2)->first()?->min_width)}}">
                    </div>
                </div>
            </div>
            <div class="right-column content-right">
                <div class="text-left">
                ◎通行条件<br>
                基準値-車両幅<br>
                -50まで：A<br>
                -51から-100まで：B<br>
                -101以下：C
                    <div class="width-check-block">
                        <div class="width-check-group">
                        <input type="checkbox" name="width_condition[]" value="1" class="js-sync-width-B" id="widthB_2"
                        {{ (is_array(old('width_condition')) && in_array('1', old('width_condition'))) || (!old() && $answerData->minWidths->where('width_condition', 1)->first()?->width_condition == 1) ? 'checked' : '' }}><label for="widthB_2">寸法条件B</label>
                        <input type="checkbox" name="width_condition[]" value="2" class="js-sync-width-C" id="widthC_2"
                        {{ (is_array(old('width_condition')) && in_array('2', old('width_condition'))) || (!old() && $answerData->minWidths->where('width_condition', 2)->first()?->width_condition == 2) ? 'checked' : '' }}><label for="widthC_2">寸法条件C</label>
                    </div>
                </div>
                </div>
            </div>
        </div>
        <div class="content-table">
            <table class="table-car">
                <thead>
                <tr>
                    <th>No.</th>
                    <th>番号</th>
                    <th>重量</th>
                    <th>長さ</th>
                    <th>幅</th>
                    <th>高さ</th>
                    <th>最小回転半径</th>
                    <th>基準値-車両幅<br>（双方）</th>
                    <th>通行条件<br>（双方）</th>
                    <th>基準値-車両幅<br>（片方）</th>
                    <th>通行条件<br>（片方）</th>
                </tr>
                </thead>
                <tbody>
                    @php
                        // oldの値がある場合はその件数分、ない場合は初回用に空配列[0]を用意して1行表示させる
                        $loopData = old('application_number', $answerData->vehicles ?? []);
                    @endphp

                @foreach($loopData as $index => $val)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><input type="text" name="application_number[]" value="{{ old('application_number.'.$index, $val->application_number ?? '') }}"></td>
                        <td><input type="text" name="car_weight[]" value="{{ old('car_weight.'.$index, $val->weight ?? '') }}"></td>
                        <td><input type="text" name="car_length[]" value="{{ old('car_length.'.$index, $val->length ?? '') }}"></td>
                        <td><input type="text" name="car_width[]" value="{{ old('car_width.'.$index, $val->width ?? '') }}"></td>
                        <td><input type="text" name="car_height[]" value="{{ old('car_height.'.$index, $val->height ?? '') }}"></td>
                        <td><input type="text" name="car_radius[]" value="{{ old('car_radius.'.$index,$val->radius ?? '') }}"></td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                        <td>-</td>
                    </tr>
                @endforeach
                </tbody>

            </table>

        </div>

    </div>

    <label  class="tab-label" id="label-route-condition">
        <input type="radio" name="tab-1">
        経路・通行条件
    </label>
    <div class="tab-content">
        <div class="form-container two-column">
            <div class="left-column">
                <div class="route-rows">
                    @php
                        $dbRoutes = isset($answerData->allowRoutes) ? $answerData->allowRoutes->values()->all() : [];
                        // oldの値がある場合はその件数分、初回用1件表示させる
                        $oldRouteCategories = old('route_category');

                        if(is_array($oldRouteCategories)) {
                            $loopCount = count($oldRouteCategories);
                        } else {
                            $loopCount = max(count($dbRoutes), 1);
                        }
                    @endphp

                    @for($index = 0; $index < $loopCount; $index++)
                        @php
                            // 対応する行のDBデータを特定
                            $dbRoute = $dbRoutes[$index] ?? null;

                            // 💡 3. 現在この行で選択されるべきカテゴリIDと路線ID（route_id）を割り出す
                            // oldがあればold、なければDB、どちらもなければ空文字
                            $currentCategoryId = old('route_category.'.$index, $dbRoute?->routecategory_id ?? '');
                            $currentRouteId    = old('route_id.'.$index, $dbRoute?->id ?? '');
                        @endphp

                        <div class="route-row" data-index="{{ $index }}">
                            <span class="route-number">{{ $index + 1 }}</span>

                            {{-- カテゴリ選択 --}}
                            <select class="route-category" name="route_category[]"
                                data-fetch-url="{{ route('routes.byCategory', ':id') }}">
                                <option value="">カテゴリ</option>
                                @foreach($routeCategories as $routeCategory)
                                <option value="{{ $routeCategory->id }}"
                                    {{ $currentCategoryId == $routeCategory->id ? 'selected' : '' }}>
                                    {{ $routeCategory->name }}
                                </option>
                                @endforeach
                            </select>

                            {{-- 路線選択 (route_id) --}}
                            {{-- 💡 カテゴリが選択されている状態（$currentCategoryIdがあるとき）はhiddenとdisabledを解除します --}}
                            <select class="route-select {{ $currentRouteId ? '' : 'hidden' }}"
                                    name="route_id[]"
                                    {{ $currentRouteId ? '' : 'disabled' }}
                                    data-old-value="{{ $currentRouteId }}">
                                <option value="">路線を選択してください</option>
                                {{-- ※ここは空のままにして、JavaScriptで後から流し込むのが一般的です --}}
                                @if($currentCategoryId)
                                    @php
                                        // マスタデータの全体から、このカテゴリに属する路線（routes）を絞り込む
                                        // ※コントローラーから全路線のマスタ（$allRoutes等）を渡しておく、もしくはカテゴリ配下から引っ張る必要があります
                                        // ここでは、カテゴリが持っている routes リレーションを利用して表示する例です
                                        $selectedCategory = $routeCategories->find($currentCategoryId);
                                        $targetRoutes = $selectedCategory ? $selectedCategory->routes : [];
                                    @endphp

                                    @foreach($targetRoutes as $route)
                                        <option value="{{ $route->id }}" {{ $currentRouteId == $route->id ? 'selected' : '' }}>
                                            {{ $route->short_number }} </option>
                                    @endforeach
                                @endif

                            </select>

                            <div class="route-remarks hidden"></div>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="right-column">
                <div class="width-check-block">
                    <div class="width-check-group">
                    <input type="checkbox" name="width_condition[]" value="1" class="js-sync-width-B" id="widthB_2"
                        {{ (is_array(old('width_condition')) && in_array('1', old('width_condition'))) || (!old() && $answerData->minWidths->where('width_condition', 1)->first()?->width_condition == 1) ? 'checked' : '' }}><label for="widthB_2">寸法条件B</label>
                        <input type="checkbox" name="width_condition[]" value="2" class="js-sync-width-C" id="widthC_2"
                        {{ (is_array(old('width_condition')) && in_array('2', old('width_condition'))) || (!old() && $answerData->minWidths->where('width_condition', 2)->first()?->width_condition == 2) ? 'checked' : '' }}><label for="widthC_2">寸法条件C</label>
                    </div>
                </div>
                @foreach ($conditions as $categoryId => $conditionList)
                    <div class="condition-title">
                        {{$conditionList->first()->conditionCategory->name ?? 'カテゴリ'.$categoryId}}
                    </div>
                    @foreach($conditionList as $condition)
                        <label class="condition-content">
                            <input type="checkbox" name="condition_id[]" value="{{$condition->id}}" id="check{{$condition->id}}" {{ (is_array(old('condition_id')) && in_array($condition->id, old('condition_id'))) || (!old() && isset($answerData->allowConditions) && $answerData->allowConditions->contains('id', $condition->id)) ? 'checked' : '' }}>
                            <span class="flag">{{$condition->flag}}</span>
                            <span class="condition-detail">{{$condition->content}}</span>
                        </label>
                    @endforeach
                @endforeach
                <div class="condition-title">
                    自由記述
                </div>

                <label class="condition-content">
                    <input type="checkbox" name="condition_id[]" value="-1" id="-1"
                    {{ (is_array(old('condition_id')) && in_array('-1', old('condition_id'))) || (!old() && !empty($answerData->allowFreeCondition?->condition_free)) ? 'checked' : '' }}>
                    <textarea class="detail-text" name="conditions_free">{{old('conditions_free', $answerData->allowFreeCondition?->condition_free)}}</textarea>
                </label>

            </div>
        </div>
    </div>


    <label class="tab-label" id="label-disallow-reason">
        <input type="radio" name="tab-1">
        不許可経路・理由
    </label>
    <div class="tab-content">
        <div class="form-container two-column">
            <div class="left-column">
                <div class="route-rows">
                    @php
                        // oldの値がある場合はその件数分、初回用1件表示させる
                        $dbNotRoutes = isset($answerData->notAllowRoutes) ? $answerData->notAllowRoutes->values()->all() : [];
                        $oldNotRouteCategories = old('not_route_category');

                        if(is_array($oldNotRouteCategories)) {
                            $loopCount = count($oldNotRouteCategories);

                        }else{
                            $loopCount = max(count($dbNotRoutes), 1);
                        }
                    @endphp

                    @for($index = 0; $index < $loopCount; $index++)
                        @php
                            $dbNotRoute = $dbNotRoutes[$index] ?? null;

                            $currentNotCategoryId = old('not_route_category.'.$index, $dbNotRoute?->routecategory_id ?? '');
                            $currentNotRouteId = old('not_route_id.'.$index, $dbNotRoute?->id ?? '');
                        @endphp
                        <div class="route-row" data-index="{{ $index }}">
                            <span class="route-number">{{ $index + 1 }}</span>

                            {{-- カテゴリ選択 --}}
                            <select class="route-category" name="not_route_category[]"
                                data-fetch-url="{{ route('routes.byCategory', ':id') }}">
                                <option value="">カテゴリ</option>
                                @foreach($routeCategories as $routeCategory)
                                <option value="{{ $routeCategory->id }}"
                                    {{ $currentNotCategoryId == $routeCategory->id ? 'selected' : '' }}>
                                    {{ $routeCategory->name }}
                                </option>
                                @endforeach
                            </select>

                            {{-- 路線選択 (not_route_id) --}}
                            {{-- 注意: バリデーションエラー時は JavaScript で中身を再構築する必要があるため、
                                ここでは一旦「選択されていたID」を保持する仕組みだけ用意します --}}

                            <select class="route-select {{ $currentNotRouteId ? '' : 'hidden' }} " name="not_route_id[]"
                            {{ $currentNotRouteId ? '' : 'disabled' }}
                            data-old-value="{{ $currentNotRouteId }}">
                                <option value="">路線を選択してください</option>
                                {{-- ※ここは空のままにして、JavaScriptで後から流し込むのが一般的です --}}
                                @if($currentNotCategoryId)
                                    @php
                                        $notSelectedCategory = $routeCategories->find($currentNotCategoryId);
                                        $notTargetRoutes = $notSelectedCategory ? $notSelectedCategory->routes : [];
                                    @endphp

                                    @foreach($notTargetRoutes as $route)
                                        <option value="{{ $route->id }}" {{ $currentNotRouteId == $route->id ? 'selected' : '' }}>
                                            {{ $route->short_number }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                            <div class="route-remarks hidden">
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="right-column">
                @foreach ($notAllows as $categoryId => $notAllowList)
                    <div class="condition-title">
                        {{$notAllowList->first()->conditionCategory->name ?? 'カテゴリ'.$categoryId}}
                    </div>
                    @foreach($notAllowList as $notAllow)
                        <label class="condition-content">
                            <input type="checkbox" name="not_condition_id[]" value={{$notAllow->id}} id="check{{$notAllow->id}}"
                            {{ (is_array(old('not_condition_id')) && in_array($notAllow->id, old('not_condition_id'))) || (!old() && isset($answerData->notAllowConditions) && $answerData->notAllowConditions->contains('id', $notAllow->id)) ? 'checked' : '' }}>
                            <span class="flag">{{$notAllow->flag}}</span>
                            <span class="condition-detail">{{$notAllow->content}}</span>
                        </label>
                    @endforeach

                <label class="condition-content">
                    @php
                        // 数値（10, 11など）にマイナスをつける
                        $freeValue = "-" . $categoryId;
                        $dbNotFreeCondition = isset($answerData->notFreeConditions) ? $answerData->notFreeConditions->where('not_condition_id', $freeValue)->first() : null;
                    @endphp
                    <input type="checkbox" name="not_condition_id[]" id="check{{$freeValue}}" value="{{$freeValue}}"
                    {{ (is_array(old('not_condition_id')) && in_array($freeValue, old('not_condition_id'))) || (!old() && !empty($dbNotFreeCondition?->condition_free)) ? 'checked' : '' }}>
                    <textarea class="detail-text" name="not_conditions_free[{{$categoryId}}]">{{old("not_conditions_free.$categoryId", $dbNotFreeCondition?->condition_free ?? '')}}</textarea>
                </label>

                @endforeach

            </div>
        </div>
    </div>

    </div>

    <div class="button-submit">
        <input type="hidden" name="answer_id" value="{{$answerData->id}}">
        <button type="submit" name="action" value="update" class="submit">修正</button>
        <button type="submit" name="action" value="print" class="submit">印刷</button>
    </div>

    </form>
</div>


@endsection
