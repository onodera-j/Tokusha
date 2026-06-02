@extends('layouts.app')

@section("css")
<link rel="stylesheet" href="{{ asset('css/conditionlist.css') }}" />
@endsection

@section("content")

<div class="content">

    <div class="content-sub">
        <div class="content-title">通行条件一覧</div>
        <ul class="tab-menu">
            <li class="list-item1"><a class="link-tab" href="/conditionlist/create">新規作成</a></li>
        </ul>
    </div>
    <div class="content-tab">
        <ul class="condition-tab">
            <li class="tab-index">許可</li>
            <li class="tab-item" data-category="1">幅員</li>
            <li class="tab-item" data-category="2">折進</li>
            <li class="tab-item" data-category="3">通学路</li>
            <li class="tab-item" data-category="4">注意事項</li>
            <li class="tab-item" data-category="5">土木協議</li>
            <li class="tab-item" data-category="6">警察協議</li>
            <li class="tab-item" data-category="7">バス</li>
            <li class="tab-item" data-category="8">特殊条件</li>
            <li class="tab-item" data-category="9">必須</li>
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
                    <th>カテゴリ</th>
                    <th>フラグ</th>
                    <th>内容</th>
                    <th></th>


                </tr>
            </thead>
            <tbody>

                <tr class="table-row" >
                    <td class="td-widthfixed">

                    </td>
                    <td class="td-widthfixed"></td>
                    <td class="td-alignleft"></td>
                    <td class="td-widthfixed"><a href=""><span class="style-detail">詳細</span></td>
                </tr>


            </tbody>
        </table>
    </div>



</div>

@endsection
