@extends('layouts.app')

@section("css")
<link rel="stylesheet" href="{{ asset('css/listedit.css') }}" />
@endsection

@section("content")

<div class="content">

    <div class="title-group">
        <div class="content-title">基本情報</div>
        <div class="content-back"><a href="/">トップに戻る</a></div>
    </div>
    @if(session("success"))
        <div class="alert-success">
            {{ session("success") }}
        </div>
    @endif
    <form method="POST" action="{{ route("answerSettingUpdate", $answersetting->id)}}">
        @csrf
        @method("PATCH")
        <div class="content-group">
            <div class="group-title">
                回答書
            </div>

            <div class="group-item">
                <div class="item-title required">
                    回答書採番 （年度末注意）
                </div>
                <div class="item-form">
                    <input type="text" name="numbering_name" value="{{ old("numbering_name", $answersetting->numbering_name) }}">
                </div>
                <div class="item-error">
                        @error('numbering_name')
                        {{ $message }}
                        @enderror
                </div>
            </div>

            <div class="group-item">
                <div class="item-title required">
                    回答書決裁年（年始注意）
                </div>
                <div class="item-form">
                    <input type="text" name="answer_year" value="{{ old("answer_year", $answersetting->answer_year ) }}">
                </div>

                <div class="item-error">
                    @error('answer_year')
                    {{ $message }}
                    @enderror
                </div>
            </div>

        </div>


        <div class="button-submit">
                <button type="submit" class="submit">回答書変更</button>
        </div>
    </form>

        <div class="content-group">
            <div class="group-title">
                担当者
            </div>
            <div class="group-item">
                @foreach($members as $member)
                <div class="item-title">
                    {{ $member->name }}
                </div>
                <form method="POST" action="{{ route("staffDestroy", $member->id)}}" onsubmit="return confirm('本当に削除しますか？');">
                @csrf
                @method("DELETE")
                    <div class="item-form">
                        <button type="submit" class="submit-delete">削除</button>
                    </div>
                </form>
                @endforeach

                <form method="POST" action="/basedata/staff_create_request" style="display: contents;">
                    @csrf
                    <div class="item-title">
                        <input type="text" name="name" value="{{ old("name") }}">
                    </div>
                    <div class="item-form">
                        <button type="submit" class="submit-create">新規追加</button>
                    </div>

                    <div class="item-error">
                            @error('name')
                            {{ $message }}
                            @enderror
                    </div>
                </form>
            </div>
        </div>

</div>

@endsection
