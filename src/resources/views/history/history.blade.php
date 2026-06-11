@extends('layouts.app')

@section("css")
<link rel="stylesheet" href="{{ asset('css/history.css') }}" />
@endsection

@section("content")

<div class="content">

    <div class="content-sub">
        <div class="content-title">回答書一覧</div>
        <ul class="tab-menu">
            <li class="list-item1"><a class="link-tab" href="/conditionlist/create">新規作成</a></li>
        </ul>
    </div>
    <div class="content-tab">
        <ul class="condition-tab">
            <li class="tab-index">許可</li>
            <li class="tab-item" data-category="1">幅員</li>
            <li class="tab-item" data-category="2">折進</li>

            <li class="flex-break"></li>
            <li class="tab-index">不許可</li>
            <li class="tab-item" data-category="10">道路現況</li>
            <li class="tab-item" data-category="11">理由</li>
        </ul>

    </div>
    @if(session("success"))
        <div class="alert-success">
            {{ session("success") }}
        </div>
    @endif
    <div class="content-list">
        <table class="list-route">
            <thead>
                <tr>
                    <th>採番</th>
                    <th>相手方</th>
                    <th>申請日</th>
                    <th>協議番号</th>
                    <th>目的地</th>
                    <th>通行路線</th>
                    <th>決裁日</th>
                    <th></th>


                </tr>
            </thead>
            <tbody>
                @foreach($answerDatas as $answerData )
                <tr class="table-row">
                    <td class="td-widthfixed100">{{$answerData['numbering_name']}}{{$answerData['approval_number']}}号</td>
                    <td class="td-widthfixed130">{{$answerData->client->short_name ?? $answerData->counter->name ?? ''}}</td>
                    <td class="td-widthfixed130">{{$answerData['application_date']}}</td>
                    <td class="td-widthfixed130">{{$answerData['consultation_number']}}</td>

                    <td class="td-alignleft">{{$answerData['destination']}}</td>
                    <td class="td-alignleft">
                        @foreach($answerData->allowRoutes as $route)
                        {{$route['short_number']}}
                        @endforeach
                        @foreach($answerData->notAllowRoutes as $notroute)
                        {{$notroute['short_number']}}
                        @endforeach
                    </td>
                    <td class="td-widthfixed150">{{$answerData->approval_date ?? '未登録'}}</td>
                    <td class="td-widthfixed"><a href="{{ route("historyEdit", ["id" => $answerData->id ]) }}"><span class="style-detail">詳細</span></td>
                </tr>
                @endforeach


            </tbody>
        </table>
    </div>



</div>

@endsection
