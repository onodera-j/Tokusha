@extends('layouts.app')

@section("css")
<link rel="stylesheet" href="{{ asset('css/listedit.css') }}" />
@endsection

@section("content")

<div class="content">

    <div class="title-group">
        <div class="content-title">相手先詳細</div>
        <div class="content-back"><a href="{{ url()->previous() }}">一覧に戻る</a></div>
    </div>
    <form method="POST" action="{{ route("clientUpdate", $client->id)}}">
        @csrf
        @method("PATCH")
        <div class="content-group">
            <div class="group-title">事務所</div>
            <div class="group-item">
                <div class="item-title required">
                    事務所名
                </div>
                <div class="item-form">
                    <input type="text" name="name" value="{{ old("name", $client->name) }}">
                    <div class="item-error">
                        @error('name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="group-item">
                <div class="item-title required">
                    短縮名
                </div>
                <div class="item-form">
                    <input type="text" name="short_name" value="{{ old("short_name", $client->short_name) }}">
                    <div class="item-error">
                        @error('short_name')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="group-item">
                <div class="item-title required">
                    都道府県
                </div>
                <div class="item-form">
                    <select name="prefecture_code">
                        <option value="">選択してください</option>
                        @foreach (config('prefectures') as $code => $name)
                            <option value="{{ $code }}" @selected( old("prefecture_code", $client->prefecture_code) == $code)>{{ $name }}</option>
                        @endforeach
                    </select>
                    <div class="item-error">
                        @error('prefecture_code')
                        {{ $message }}
                        @enderror
                    </div>
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
                    <input type="text" name="tel" value="{{ old("tel", $client->tel) }}">
                    <div class="item-error">
                        @error('tel')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="group-item  required">
                <div class="item-title required">
                    FAX<br>（ハイフンあり）
                </div>
                <div class="item-form">
                    <input type="text" name="fax" value="{{ old("fax", $client->fax) }}">
                    <div class="item-error">
                        @error('fax')
                        {{ $message }}
                        @enderror
                    </div>
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
                    <input type="text" name="answer_address1" value="{{ old("answer_address1", $client->answer_address1) }}">
                    <div class="item-error">
                        @error('answer_address1')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="group-item">
                <div class="item-title any">
                    宛先2<br>（所管長または所管部署）
                </div>
                <div class="item-form">
                    <input type="text" name="answer_address2"  value="{{ old("answer_address2", $client->answer_address2) }}">
                </div>
            </div>
            <div class="group-item">
                <div class="item-title required">
                相手先採番
                </div>
                <div class="item-form">
                    <input type="text" name="numbering_name" value="{{ old("numbering_name", $client->numbering_name) }}">
                    <div class="item-error">
                        @error('numbering_name')
                        {{ $message }}
                        @enderror
                    </div>
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
                    <input type="text" name="fax_address1" value="{{ old("fax_address1", $client->fax_address1) }}">
                    <div class="item-error">
                        @error('fax_address1')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="group-item">
                <div class="item-title any">
                    宛先2<br>（所管事務所名）
                </div>
                <div class="item-form">
                    <input type="text" name="fax_address2" value="{{ old("fax_address2", $client->fax_address2) }}">
                </div>
            </div>
            <div class="group-item">
                <div class="item-title required">
                    宛先3<br>（担当宛先）
                </div>
                <div class="item-form">
                    <input type="text" name="fax_address3" value="{{ old("fax_address3", $client->fax_address3) }}">
                    <div class="item-error">
                        @error('fax_address3')
                        {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="content-group">
            <div class="group-title required">表示/非表示</div>
            <div class="group-item">
                <div class="item-title any">
                    一覧から非表示にする
                </div>
                <div class="item-form">
                    <input type="hidden" name="hidden" value="0">
                    <input type="checkbox" name="hidden" value="1"
                    @checked(old("hidden", $client->hidden ?? 0))>
                </div>
            </div>
        </div>

        <div class="button-submit">
                <button type="submit" class="submit">変更</button>
        </div>
    </form>

    <form method="POST" action="{{ route("clientDestroy", $client->id) }}" onsubmit="return confirm('本当に削除しますか？');">
        @method("DELETE")
        @csrf
        <div class="button-delete">
        <button type="submit" class="delete">削除する</button>
        </div>
    </form>

</div>

@endsection
