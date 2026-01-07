@extends('layouts.app')

@section("css")
<link rel="stylesheet" href="{{ asset('css/routelist.css') }}" />
@endsection

@section("content")

<div class="content">

    <div class="content-sub">
        <div class="content-title">登録路線一覧</div>
        <ul class="tab-menu">
            <li class="list-item1"><a class="link-tab" href="/clientlist/create">新規作成</a></li>
            <li class="list-item2"><a class="link-tab" href="/clientlist/hidden"> 非表示リスト</a></li>
        </ul>
    </div>
    <div class="content-tab">
        <ul class="route-tab">
            <li class="tab-item" data-category="1">採択路線</li>
            <li class="tab-item" data-category="2">特車線</li>
            <li class="tab-item" data-category="3">特別区道1～299</li>
            <li class="tab-item" data-category="4">特別区道300～599</li>
            <li class="tab-item" data-category="5">特別区道600～899</li>
            <li class="tab-item" data-category="6">特別区道900～</li>
            <li class="tab-item" data-category="7">経路表示</li>
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
                    <th>短縮名</th>
                    <th>道路名</th>
                    <th>備考</th>
                    <th></th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                @foreach ($routes as $route)
                <tr class="table-row" data-category="{{$route->routecategory_id}}">
                    <td>{{ $route->short_name }}{{ $route->short_number }}</td>
                    <td>{{ $route->name }}</td>
                    <td>{{ $route->remarks }}</td>

                    <td></td>
                    <td><a href="{{ route("routeEdit", ["id" => $route->id ]) }}"><span class="style-detail">詳細</span></td>
                    {{-- <td>
                        <form method="POST" action="{{ route("clientHide", $client->id) }}">
                            @method("PATCH")
                            @csrf
                            <button class="button-submit" type="submit"><img class="hidden" src="{{ asset('/img/icon_hidden.png') }}" width="15" height="15"></button>
                        </form>
                    </td> --}}
                </tr>
                @endforeach



            </tbody>
        </table>
    </div>



</div>

@endsection
