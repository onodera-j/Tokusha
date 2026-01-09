@extends('layouts.app')

@section("css")
<link rel="stylesheet" href="{{ asset('css/listedit.css') }}" />
@endsection

@section("content")

<div class="content">

    <div class="title-group">
        <div class="content-title">路線詳細</div>
        <div class="content-back"><a href="{{ url()->previous() }}">一覧に戻る</a></div>
    </div>
    <form method="POST" action="/route_create_request">
        @csrf
        <div class="content-group">
            <div class="group-title">路線</div>
            <div class="group-item">
                <div class="item-title required">
                    路線名（例：渋特車5号線）
                </div>
                <div class="item-form">
                    <input type="text" name="name" value="{{ old("name") }}">
                    <div class="item-error">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="group-item">
                <div class="item-title any">
                    短縮名（例：渋特）
                </div>
                <div class="item-form shortcode">
                    <input type="text" name="short_name" value="{{ old("short_name") }}">
                </div>
                <div class="item-title any">
                    短縮番号（例：5）
                </div>
                <div class="item-form shortcode">
                    <input type="text" name="short_number" value="{{ old("short_number") }}">
                    <div class="item-error">
                        @error('short_number')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="group-item">
                <div class="item-title required">
                    カテゴリー
                </div>
                <div class="item-form radio">
                    <div class="radio-group">
                        <input type="radio" name="routecategory_id" value=1 id="radio1" {{ old('routecategory_id') ? 'checked' : '' }}><label for="radio1">採択路線</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" name="routecategory_id" value=2 id="radio2" {{ old('routecategory_id') == 2 ? 'checked' : '' }}><label for="radio2">特車線</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" name="routecategory_id" value=3 id="radio3" {{ old('routecategory_id') == 3 ? 'checked' : '' }}><label for="radio3">特別区道1-299</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" name="routecategory_id" value=4 id="radio4" {{ old('routecategory_id') == 4 ? 'checked' : '' }}><label for="radio4">特別区道300-599</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" name="routecategory_id" value=5 id="radio5" {{ old('routecategory_id') == 5 ? 'checked' : '' }}><label for="radio5">特別区道600-899</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" name="routecategory_id" value=6 id="radio6" {{ old('routecategory_id') == 6 ? 'checked' : '' }}><label for="radio6">特別区道900-</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" name="routecategory_id" value=7 id="radio7" {{ old('routecategory_id') == 7 ? 'checked' : '' }}><label for="radio7">経路表示 （例：【経路2】）
                        </label>
                    </div>
                    <div class="item-error">
                        @error('routecategory_id')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="group-item">
                <div class="item-title any">
                    備考<br>（橋梁耐荷重、狭小など）
                </div>
                <div class="item-form textarea">
                    <textarea name="remarks">{{ old("remarks") }}</textarea>

                </div>
            </div>
        </div>


        <div class="button-submit">
                <button type="submit" class="submit">登録</button>
        </div>
    </form>


</div>

@endsection
