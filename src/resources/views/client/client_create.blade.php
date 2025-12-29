@extends('layouts.app')

@section("css")
<link rel="stylesheet" href="{{ asset('css/clientedit.css') }}" />
@endsection

@section("content")

<div class="content">

    <div class="content-title">
        <h2>新規登録</h2>
    </div>
    <from method="POST" action="/client_create_request">
        @csrf
    <div class="content-group">
        <div class="group-title">事務所</div>
        <div class="group-item">
            <div class="item-title required">
                事務所名
            </div>
            <div class="item-form">
                <input type="text" name="name">
            </div>
        </div>
        <div class="group-item">
            <div class="item-title required">
                短縮名
            </div>
            <div class="item-form">
                <input type="text" name="short-name">
            </div>
        </div>
    </div>
    <div class="content-group">
        <div class="group-title">電話番号・FAX</div>
        <div class="group-item">
            <div class="item-title required">
                電話番号<br>（ハイフンあり）
            </div>
            <div class="item-form">
                <input type="text" name="tel">
            </div>
        </div>
        <div class="group-item  required">
            <div class="item-title required">
                FAX<br>（ハイフンあり）
            </div>
            <div class="item-form">
                <input type="text" name="fax">
            </div>
        </div>
    </div>
    <div class="content-group">
        <div class="group-title">回答書宛先</div>
        <div class="group-item required">
            <div class="item-title required">
                宛先1<br>（道路管理者）
            </div>
            <div class="item-form">
                <input type="text" name="answer_address1">
            </div>
        </div>
        <div class="group-item">
            <div class="item-title any">
                宛先2<br>（所管長または所管部署）
            </div>
            <div class="item-form">
                <input type="text" name="answer_address2">
            </div>
        </div>
        <div class="group-item">
            <div class="item-title required">
            相手先採番
            </div>
            <div class="item-form">
                <input type="text" name="numbering_name">
            </div>
        </div>
    </div>
    <div class="content-group">
        <div class="group-title required">FAX宛先</div>
        <div class="group-item">
            <div class="item-title required">
                宛先1<br>（道路管理者）
            </div>
            <div class="item-form">
                <input type="text" name="fax_address1">
            </div>
        </div>
        <div class="group-item">
            <div class="item-title any">
                宛先2<br>（所管事務所名）
            </div>
            <div class="item-form">
                <input type="text" name="fax_address2">
            </div>
        </div>
        <div class="group-item">
            <div class="item-title required">
                宛先3<br>（担当宛先）
            </div>
            <div class="item-form">
                <input type="text" name="fax_address3">
            </div>
        </div>
    </div>

    <div class="button-submit">
            <button class="submit">登録</button>
    </div>
    </from>

</div>

@endsection
