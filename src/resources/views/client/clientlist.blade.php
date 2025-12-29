@extends('layouts.app')

@section("css")
<link rel="stylesheet" href="{{ asset('css/clientlist.css') }}" />
@endsection

@section("content")

<div class="content">

    <div class="content-sub">
        <ul class="tab-menu">
            <li class="list-item1"><a class="link-tab" href="/clientlist/create">新規作成</a></li>
            <li class="list-item2"><a class="link-tab" href="/clientlist/edit"> 非表示リスト</a></li>
        </ul>
    </div>

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
                <td><span class="style-detail">詳細</span></td>
                <td><img class="hidden" src="{{ asset('/img/icon_hidden.png') }}" width="15" height="15"></td>
            </tr>
            @endforeach
            <tr>
                <td>札幌開発建設部</td>
                <td>札建特車</td>
                <td>03-3463-2777</td>
                <td>03-5458-7522</td>
                <td>札幌開発</td>
                <td></td>
                <td><span class="style-detail">詳細</span></td>
                <td><img class="hidden" src="{{ asset('/img/icon_hidden.png') }}" width="15" height="15"></td>
            </tr>
            <tr>
                <td>仙台河川国道事務所</td>
                <td>東国交特車</td>
                <td>03-3463-2177</td>
                <td>03-5548-7522</td>
                <td>東京国道</td>
                <td></td>
                <td><span class="style-detail">詳細</span></td>
                <td><img class="hidden" src="{{ asset('/img/icon_hidden.png') }}" width="15" height="15"></td>
            </tr>
            <tr>
                <td>仙台河川国道事務所</td>
                <td>東国交特車</td>
                <td>03-3463-2177</td>
                <td>03-5548-7522</td>
                <td>東京国道</td>
                <td></td>
                <td><span class="style-detail">詳細</span></td>
                <td><img class="hidden" src="{{ asset('/img/icon_hidden.png') }}" width="15" height="15"></td>
            </tr>
            <tr>
                <td>仙台河川国道事務所</td>
                <td>東国交特車</td>
                <td>03-3463-2177</td>
                <td>03-5548-7522</td>
                <td>東京国道</td>
                <td></td>
                <td><span class="style-detail">詳細</span></td>
                <td><img class="hidden" src="{{ asset('/img/icon_hidden.png') }}" width="15" height="15"></td>
            </tr>
            <tr>
                <td>仙台河川国道事務所</td>
                <td>東国交特車</td>
                <td>03-3463-2177</td>
                <td>03-5548-7522</td>
                <td>東京国道</td>
                <td></td>
                <td><span class="style-detail">詳細</span></td>
                <td><img class="hidden" src="{{ asset('/img/icon_hidden.png') }}" width="15" height="15"></td>
            </tr>


        </tbody>
    </table>



</div>

@endsection
