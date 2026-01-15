@extends('layouts.app')

@section("css")
<link rel="stylesheet" href="{{ asset('css/listedit.css') }}" />
@endsection

@section("content")

<div class="content">

    <div class="title-group">
        <div class="content-title">通行条件詳細</div>
        <div class="content-back"><a href="{{ url()->previous() }}">一覧に戻る</a></div>
    </div>
    <form method="POST" action="{{ route("conditionStore") }}">
        @csrf
        <div class="content-group">
            <div class="group-title">通行条件</div>
            <div class="group-item">
                <div class="item-title required">
                    カテゴリ
                </div>
                <div class="item-form radio condition">
                    <div class="radio-group">
                        <input type="radio" name="conditioncategory_id" value=1 id="radio1" {{ old('conditioncategory_id') == 1 ? 'checked' : '' }}><label for="radio1">幅員</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" name="conditioncategory_id" value=2 id="radio2" {{ old('conditioncategory_id') == 2 ? 'checked' : '' }}><label for="radio2">折進</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" name="conditioncategory_id" value=3 id="radio3" {{ old('conditioncategory_id') == 3 ? 'checked' : '' }}><label for="radio3">通学路</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" name="conditioncategory_id" value=4 id="radio4" {{ old('conditioncategory_id') == 4 ? 'checked' : '' }}><label for="radio4">注意事項</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" name="conditioncategory_id" value=5 id="radio5" {{ old('conditioncategory_id') == 5 ? 'checked' : '' }}><label for="radio5">土木協議</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" name="conditioncategory_id" value=6 id="radio6" {{ old('conditioncategory_id') == 6 ? 'checked' : '' }}><label for="radio6">
                            警察協議</label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" name="conditioncategory_id" value=7 id="radio7" {{ old('conditioncategory_id') == 7 ? 'checked' : '' }}><label for="radio7">バス
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" name="conditioncategory_id" value=8 id="radio8" {{ old('conditioncategory_id') == 8 ? 'checked' : '' }}><label for="radio8">特殊条件
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" name="conditioncategory_id" value=9 id="radio9" {{ old('conditioncategory_id') == 9 ? 'checked' : '' }}><label for="radio9">必須
                        </label>
                    </div>
                    <div>不許可</div>
                    <div class="radio-group">
                        <input type="radio" name="conditioncategory_id" value=10 id="radio10" {{ old('conditioncategory_id') == 10 ? 'checked' : '' }}><label for="radio10">道路現況
                        </label>
                    </div>
                    <div class="radio-group">
                        <input type="radio" name="conditioncategory_id" value=11 id="radio11" {{ old('conditioncategory_id') == 11 ? 'checked' : '' }}><label for="radio11">理由
                        </label>
                    </div>
                </div>
                <div></div>
                <div class="item-error">
                        @error('conditioncategory_id')
                        {{ $message }}
                        @enderror
                    </div>

            </div>
            <div class="group-item">
                <div class="item-title any">
                    フラグ
                </div>
                <div class="item-form shortcode">
                    <input type="text" name="flag" value="{{ old("flag") }}">
                </div>
                <div class="item-title any">
                    優先順位
                </div>
                <div class="item-form shortcode">
                    <input type="text" name="sort_order" value="{{ old("sort_order") }}">
                    <div class="item-error">
                        @error('sort_order')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="group-item">
                <div class="item-title required">
                    通行条件
                </div>
                <div class="item-form textarea condition">
                    <textarea name="content">{{ old("content") }}</textarea>
                    <div class="item-error">
                        @error('content')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>


        <div class="button-submit">
                <button type="submit" class="submit">変更</button>
        </div>
    </form>

</div>

@endsection
