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
                <input type="radio" name="answersheet_type" value=1 id="radio1" {{ old('answersheet_type', '1') == '1' ? 'checked' : '' }}><label for="radio1" >許可回答</label>
            </div>
                <div class="radio-group">
                <input type="radio" name="answersheet_type" value=2 id="radio2" {{ old('answersheet_type') == '2' ? 'checked' : '' }}><label for="radio2">許可兼不許可回答</label>
            </div>
                <div class="radio-group">
                <input type="radio" name="answersheet_type" value=3 id="radio3" {{ old('answersheet_type') == '3' ? 'checked' : '' }}><label for="radio3">不許可回答</label>
            </div>
                <div class="radio-group">
                <input type="radio" name="answersheet_type" value=4 id="radio4" {{ old('answersheet_type') == '4' ? 'checked' : '' }}><label for="radio4">窓口申請回答</label>
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
                                    {{ old('staff_id') == $staffMember->id ? 'selected' : ''}}>
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
                                    {{ old('client_id') == $client->id ? 'selected' : ''}}>{{$client->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="item-title required">
                        特車申請日
                    </div>
                    <div class="item-form">
                        <input type="date" name="application_date" value="{{ old('application_date') }}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="item-title required">
                        相手方の協議番号
                    </div>
                    <div class="item-form">
                        <input type="text" name="consultation_number" value="{{old('consultation_number')}}" placeholder="123456">
                    </div>
                </div>
                <div class="form-group">
                    <div class="item-title required">
                        目的地
                    </div>
                    <div class="item-form">
                        <input type="text" name="destination" value="{{old('destination')}}" placeholder="宇田川町1-1">
                    </div>
                </div>
                <div class="form-group">
                    <div class="item-title required">
                        決裁番号
                    </div>
                    <div class="item-form">
                        <input type="text" name="approval_number" value="{{old('approval_number')}}" placeholder="1">
                    </div>
                </div>
            </div>
            <div class="form-block">
                <div class="form-group">
                    <div class="item-title required">
                        回答書採番
                    </div>
                    <div class="item-form">
                        <input type="text" name="numbering_name" value="{{ old('numbering_name',$answerSetting->numbering_name)}}" >
                    </div>
                </div>
                <div class="form-group">
                    <div class="item-title required">
                        回答書決裁年
                    </div>
                    <div class="item-form">
                        <input type="text" name="answer_year" value="{{old('answer_year',$answerSetting->answer_year)}}">
                    </div>
                </div>

                <div class="form-group">
                    <div class="item-title madoguchi">
                        申請者名
                    </div>
                    <div class="item-form">
                        <input type="text" name="applicant_name" value="{{old('applicant_name')}}" placeholder="">
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
                                    {{ old('permission_period') == $permissionPeriod->id ? 'selected' : ''}}>{{$permissionPeriod->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="item-title any">
                        目的地2
                    </div>
                    <div class="item-form">
                        <input type="text" name="destination2" value="{{old('destination2')}}" placeholder="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="item-title any">
                        決裁日
                    </div>
                    <div class="item-form">
                        <input type="date" name="approval_date" value="{{old('approval_date')}}" placeholder="">
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
                        <input type="text" name="roadname_both" value="{{old('roadname_both')}}">
                        区道名
                        <input type="text" name="roadname_one" value="{{old('roadname_one')}}">
                    </div>

                    <div class="roadinformation-group">
                        最小幅員（cm）
                        <input type="text" class="js-both-min" name="minwidth_both" value="{{old('minwidth_both')}}">
                        最小幅員（cm）
                        <input type="text" class="js-one-min" name="minwidth_one" value="{{old('minwidth_one')}}">
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
                        {{ is_array(old('width_condition')) && in_array('1', old('width_condition')) ? 'checked' : '' }}><label for="widthB_2">寸法条件B</label>
                        <input type="checkbox" name="width_condition[]" value="2" class="js-sync-width-C" id="widthC_2"
                        {{ is_array(old('width_condition')) && in_array('2', old('width_condition')) ? 'checked' : '' }}><label for="widthC_2">寸法条件C</label>
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
                        $oldInputs = old('application_number', ['']);
                    @endphp

                @foreach($oldInputs as $index => $val)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><input type="text" name="application_number[]" value="{{ old('application_number.'.$index) }}"></td>
                        <td><input type="text" name="car_weight[]" value="{{ old('car_weight.'.$index) }}"></td>
                        <td><input type="text" name="car_length[]" value="{{ old('car_length.'.$index) }}"></td>
                        <td><input type="text" name="car_width[]" value="{{ old('car_width.'.$index) }}"></td>
                        <td><input type="text" name="car_height[]" value="{{ old('car_height.'.$index) }}"></td>
                        <td><input type="text" name="car_radius[]" value="{{ old('car_radius.'.$index) }}"></td>
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
                        // oldの値がある場合はその件数分、初回用1件表示させる
                        $oldRouteCategories = old('route_category', ['']);
                    @endphp

                    @foreach($oldRouteCategories as $index => $oldRouCatId)
                        <div class="route-row" data-index="{{ $index }}">
                            <button type="button" class="btn-delete-row">×</button>
                            <span class="route-number">{{ $index + 1 }}</span>

                            {{-- カテゴリ選択 --}}
                            <select class="route-category" name="route_category[]"
                                data-fetch-url="{{ route('routes.byCategory', ':id') }}">
                                <option value="">カテゴリ</option>
                                @foreach($routeCategories as $routeCategory)
                                <option value="{{ $routeCategory->id }}"
                                    {{ $oldRouCatId == $routeCategory->id ? 'selected' : '' }}>
                                    {{ $routeCategory->name }}
                                </option>
                                @endforeach
                            </select>

                            {{-- 路線選択 (route_id) --}}
                            {{-- 注意: バリデーションエラー時は JavaScript で中身を再構築する必要があるため、
                                ここでは一旦「選択されていたID」を保持する仕組みだけ用意します --}}
                            <select class="route-select {{ old('route_id.'.$index) ? '' : 'hidden' }}"
                                    name="route_id[]"
                                    {{ old('route_id.'.$index) ? '' : 'disabled' }}
                                    data-old-value="{{ old('route_id.'.$index) }}">
                                <option value="">路線を選択してください</option>
                                {{-- ※ここは空のままにして、JavaScriptで後から流し込むのが一般的です --}}
                            </select>

                            <div class="route-remarks hidden"></div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="right-column">
                <div class="width-check-block">
                    <div class="width-check-group">
                    <input type="checkbox" name="width_condition[]" value="1" class="js-sync-width-B" id="widthB_1"
                    {{ is_array(old('width_condition')) && in_array('1', old('width_condition')) ? 'checked' : '' }}><label for="widthB_1">寸法条件B</label>
                    <input type="checkbox" name="width_condition[]" value="2" class="js-sync-width-C" id="widthC_1"
                    {{ is_array(old('width_condition')) && in_array('2', old('width_condition')) ? 'checked' : '' }}><label for="widthC_1">寸法条件C</label>
                    </div>
                </div>
                @foreach ($conditions as $categoryId => $conditionList)
                    <div class="condition-title">
                        {{$conditionList->first()->conditionCategory->name ?? 'カテゴリ'.$categoryId}}
                    </div>
                    @foreach($conditionList as $condition)
                        <label class="condition-content">
                            <input type="checkbox" name="condition_id[]" value="{{$condition->id}}" id="check{{$condition->id}}" {{is_array(old('condition_id')) && in_array($condition->id, old('condition_id')) ? 'checked' : '' }}>
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
                    {{ is_array(old('condition_id')) && in_array('-1', old('condition_id')) ? 'checked' : '' }}>
                    <textarea class="detail-text" name="conditions_free">{{old('conditions_free')}}</textarea>
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
                        $oldNotRouteCategories = old('not_route_category', ['']);
                    @endphp
                    @foreach($oldNotRouteCategories as $index => $oldNotRouCatId)
                        <div class="route-row" data-index="{{ $index }}">
                            <button type="button" class="btn-delete-row">×</button>
                            <span class="route-number">{{ $index + 1 }}</span>

                            {{-- カテゴリ選択 --}}
                            <select class="route-category" name="not_route_category[]"
                                data-fetch-url="{{ route('routes.byCategory', ':id') }}">
                                <option value="">カテゴリ</option>
                                @foreach($routeCategories as $routeCategory)
                                <option value="{{ $routeCategory->id }}"
                                    {{ $oldNotRouCatId == $routeCategory->id ? 'selected' : '' }}>
                                    {{ $routeCategory->name }}
                                </option>
                                @endforeach
                            </select>

                            {{-- 路線選択 (not_route_id) --}}
                            {{-- 注意: バリデーションエラー時は JavaScript で中身を再構築する必要があるため、
                                ここでは一旦「選択されていたID」を保持する仕組みだけ用意します --}}

                            <select class="route-select {{ old('not_route_id.'.$index) ? '' : 'hidden' }} " name="not_route_id[]"
                            {{ old('not_route_id.'.$index) ? '' : 'disabled' }}
                            data-old-value="{{ old('not_route_id.'.$index) }}">
                                <option value="">路線を選択してください</option>
                                {{-- ※ここは空のままにして、JavaScriptで後から流し込むのが一般的です --}}
                            </select>
                            <div class="route-remarks hidden">
                            </div>
                        </div>
                    @endforeach
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
                            {{ is_array(old('not_condition_id')) && in_array($notAllow->id, old('not_condition_id')) ? 'checked' : '' }}>
                            <span class="flag">{{$notAllow->flag}}</span>
                            <span class="condition-detail">{{$notAllow->content}}</span>
                        </label>
                    @endforeach

                <label class="condition-content">
                    @php
                        // 数値（10, 11など）にマイナスをつける
                        $freeValue = "-" . $categoryId;
                    @endphp
                    <input type="checkbox" name="not_condition_id[]" id="check{{$freeValue}}" value="{{$freeValue}}"
                    {{ is_array(old('not_condition_id')) && in_array($freeValue, old('not_condition_id')) ? 'checked' : '' }}>
                    <textarea class="detail-text" name="not_conditions_free[{{$categoryId}}]">{{old("not_conditions_free.$categoryId")}}</textarea>
                </label>

                @endforeach

            </div>
        </div>
    </div>

    </div>

    <div class="button-submit">
        <button type="submit" name="action" value="create" class="submit">登録</button>
    </div>

    </form>
</div>


@endsection
