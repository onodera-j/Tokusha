@extends('layouts.app')

@section("css")
<link rel="stylesheet" href="{{ asset('css/clientlist.css') }}" />
@endsection

@section("content")

<div class="content">

    <div class="content-sub">
        <div class="content-title">相手先一覧</div>
        <ul class="tab-menu">
            <li class="list-item1"><a class="link-tab" href="/clientlist/create">新規作成</a></li>
            <li class="list-item2"><a class="link-tab" href="/clientlist/hidden"> 非表示リスト</a></li>
        </ul>
    </div>
    @if(session("success"))
        <div class="alert-success">
            {{ session("success") }}
        </div>
    @endif

    <table class="list-client">
        <thead>
            <tr>
                <th>事務所名</th>
                <th>採番</th>
                <th>FAX</th>
                <th>TEL</th>
                <th>短縮名</th>
                <th></th>
                <th></th>
                <th></th>

            </tr>
        </thead>
        <tbody>
            @foreach ($clients as $client)
            <tr>
                <td>{{ $client->name }}</td>
                <td>{{ $client->numbering_name }}</td>
                <td>{{ $client->fax }}</td>
                <td>{{ $client->tel }}</td>
                <td>{{ $client->short_name }}</td>
                <td></td>
                <td><a href="{{ route("clientEdit", ["id" => $client->id ]) }}"><span class="style-detail">詳細</span></td>
                <td>
                    <form method="POST" action="{{ route("clientHide", $client->id) }}">
                        @method("PATCH")
                        @csrf
                        <button class="button-submit" type="submit"><img class="hidden" src="{{ asset('/img/icon_hidden.png') }}" width="15" height="15"></button>
                    </form>
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>



</div>

@endsection
