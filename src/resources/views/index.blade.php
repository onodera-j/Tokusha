@extends('layouts.app')

@section("css")
<link rel="stylesheet" href="{{ asset('css/index.css') }}" />
@endsection

@section("content")

<div class="content">
    <div class="content-menu content-main">
        新規回答書作成
        <a class="content-link" href="/answersheet"></a>
    </div>
    <div class="content-menu content-main">
        回答書作成履歴
        <a class="content-link" href="/history"></a>
    </div>
    <div class="content-menu content-sub">
        登録路線一覧
        <a class="content-link" href="/routelist"></a>
    </div>
    <div class="content-menu content-sub">
        回答条件一覧
        <a class="content-link" href="/conditionlist"></a>
    </div>
    <div class="content-menu content-sub">
        相手先一覧
        <a class="content-link" href="/clientlist"></a>
    </div>
    <div class="content-menu content-sub">
        基本情報
        <a class="content-link" href="/basedata"></a>
    </div>



</div>

@endsection
