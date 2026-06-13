@extends('layouts.app')

@section("css")
<link rel="stylesheet" href="{{ asset('css/history.css') }}" />
@endsection

@section("content")

<div class="content">

    <div class="content-sub">
        <div class="content-title">回答書一覧</div>
        <form method="get" action="{{ url('history/search') }}">
            @csrf
        <div class="content-search">
            <select class="search-select" name="search_type">
                <option value=0 {{ $type == '0' ? 'selected':''}}>すべて</option>
                <option value=1 {{ $type == '1' ? 'selected':''}}>採番</option>
                <option value=2 {{ $type == '2' ? 'selected':''}}>相手方</option>
                <option value=3 {{ $type == '3' ? 'selected':''}}>協議番号</option>
                <option value=4 {{ $type == '4' ? 'selected':''}}>目的地</option>
                <option value=5 {{ $type == '5' ? 'selected':''}}>通行路線</option>
            </select>
            <input type="text" name="keyword" class="search-box" value="{{$word}}">
            <button type="submit" class="search-button">検索</button>
        </div>
        </form>
        <ul class="tab-menu">
            <li class="list-item1"><a class="link-tab" href="/answersheet">新規作成</a></li>
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
    <div class="pagination-wrapper">
        {{ $answerDatas->appends(request()->query())->links() }}
    </div>



</div>

@endsection
