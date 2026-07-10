@extends('layouts.app')

@section("css")
<link rel="stylesheet" href="{{ asset('css/preview.css') }}" />
@endsection

@section("content")

<div class="content">

    <div class="no-print">
        <div>
            <button onclick="changeFontSize(1)">文字大きく ＋</button>
            <button onclick="changeFontSize(-1)">文字小さく ─</button>
            <button onclick="window.print()" style="font-weight: bold; background: #007bff; color: white; border: none; padding: 5px 15px; border-radius: 4px; cursor: pointer;">🖨️ 印刷 / PDF保存</button>
        </div>
        <div class="content-back"><a href="{{ url()->previous() }}">詳細に戻る</a></div>
    </div>


    @switch($answerData->sheet_type)

    @case(1)

    <div class="sheet-preview">
    別記様式５
        <div class="outside-border">
            <div class="sheet-title">
                特殊車両通行許可協議回答書
            </div>
            <div class="content-date-container">
                <div class="content-date">
                    <div>
                        {{$answerData->numbering_name}}{{$answerData->approval_number}}号
                    </div>
                    <div>
                        {{ $answerData->approval_date_wareki }}

                    </div>
                </div>
            </div>
            <div class="content-address-container">
                <div class="content-address">
                    <div>道路管理者</div>
                    <div>
                        @if($answerData->client_id != 0)
                            　{{$answerData->client->answer_address1}}　殿
                        @endif
                    </div>
                    <div>
                        @if($answerData->client->answer_address2 != null)
                            　({{$answerData->client->answer_address2}})
                        @endif

                    </div>
                </div>
            </div>

            <div class="content-sender-container">
                <div class="content-sender">
                    <div>道路管理者</div>
                    <div>　{{$answerSetting->position}} 　{{$answerSetting->administrator_name}}</div>
                    <div>　（公印省略）</div>
                </div>
            </div>

            <div class="content-allow">
                <div class="content-text">
                    <div>
                        　{{ $answerData->application_date_wareki }}付、{{$answerData->client->numbering_name}}第{{$answerData->consultation_number}}号で協議のあった下記道路については、申請に係る車両の通行を許可してよいと認められるので回答します。
                    </div>
                    <div>
                        　ただし、通行条件欄記載の条件に従わせること。
                    </div>
                </div>

                <div class="content-grid">
                    <div class="grid-item th-label">道路名</div>
                    <div class="grid-item th-label">区間</div>
                    <div class="grid-item th-label">通行条件</div>

                    <div class="grid-item td-data">
                        <ul class="data-list">
                            @foreach($answerData->allowRoutes as $route)
                                <li>{{$route->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="grid-item td-data">
                        <div>申請経路のとおり</div>
                        <div>目的地</div>
                        <div>{{$answerData->destination}}</div>
                        @if($answerData->otherDestination)
                            <div>
                                {{$answerData->otherDestination->second_destination}}
                            </div>
                        @endif
                    </div>
                    <div class="grid-item td-data">
                        <ul class="data-list">
                            @foreach($answerData->allowConditions as $condition)
                                <li>{{$condition->content}}</li>
                            @endforeach
                                <li>{{$answerData->allowFreeCondition->condition_free ?? ''}}
                                </li>
                        </ul>
                    </div>

                    <div class="grid-item row-label">通行期間</div>
                    <div class="grid-item row-data">申請書期間のとおり（許可日から）</div>
                </div>
            </div>
            <div class="content-disallow diagonal ">

                <div class="content-text">
                    <div>
                        　令和　年　月　日付、第　号で協議のあった下記道路については、以下の理由により申請に係る車両の通行を許可することは不適当であると認められるので回答します。
                    </div>
                </div>

                <div class="content-grid">
                    <div class="grid-item th-label">道路名</div>
                    <div class="grid-item th-label">区間</div>
                    <div class="grid-item th-data"></div>
                    <div class="grid-item th-data"></div>

                    <div class="grid-item row-label">道路現況</div>
                    <div class="grid-item row3-data"></div>
                    <div class="grid-item row-label">理由</div>
                    <div class="grid-item row3-data"></div>
                </div>

            </div>

            <div class="content-text">
                <div>　備　　考</div>
                <div class="answer-remarks">{{$answerData->remark->answer_remarks ?? ''}}</div>
            </div>
            <div class="content-contact">
                <div>
                    連絡先　{{$answerSetting->department}}　　担当 {{$answerData->staffs->name}}
                </div>
                <div>
                    {{$answerSetting->tel}}
                    @if($answerSetting->extension)
                        内線 {{$answerSetting->extension}}
                    @endif
                </div>
            </div>
        </div>
    </div>
    @break

    @case(2)
    <div class="sheet-preview">
    別記様式５
        <div class="outside-border">
            <div class="sheet-title">
                特殊車両通行許可協議回答書
            </div>
            <div class="content-date-container">
                <div class="content-date">
                    <div>
                        {{$answerData->numbering_name}}{{$answerData->approval_number}}号
                    </div>
                    <div>
                        {{ $answerData->approval_date_wareki }}

                    </div>
                </div>
            </div>
            <div class="content-address-container">
                <div class="content-address">
                    <div>道路管理者</div>
                    <div>
                        @if($answerData->client_id != 0)
                            　{{$answerData->client->answer_address1}}　殿
                        @endif
                    </div>
                    <div>
                        @if($answerData->client->answer_address2 != null)
                            　({{$answerData->client->answer_address2}})
                        @endif

                    </div>
                </div>
            </div>

            <div class="content-sender-container">
                <div class="content-sender">
                    <div>道路管理者</div>
                    <div>　{{$answerSetting->position}} 　{{$answerSetting->administrator_name}}</div>
                    <div>　（公印省略）</div>
                </div>
            </div>

            <div class="content-allow case2">
                <div class="content-text">
                    <div>
                        　{{ $answerData->application_date_wareki }}付、{{$answerData->client->numbering_name}}第{{$answerData->consultation_number}}号で協議のあった下記道路については、申請に係る車両の通行を許可してよいと認められるので回答します。
                    </div>
                    <div>
                        　ただし、通行条件欄記載の条件に従わせること。
                    </div>
                </div>

                <div class="content-grid">
                    <div class="grid-item th-label">道路名</div>
                    <div class="grid-item th-label">区間</div>
                    <div class="grid-item th-label">通行条件</div>

                    <div class="grid-item td-data">
                        <ul class="data-list">
                            @foreach($answerData->allowRoutes as $route)
                                <li>{{$route->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="grid-item td-data">
                        <div>申請経路のとおり</div>
                        <div>目的地</div>
                        <div>{{$answerData->destination}}</div>
                        @if($answerData->otherDestination)
                            <div>
                                {{$answerData->otherDestination->second_destination}}
                            </div>
                        @endif
                    </div>
                    <div class="grid-item td-data">
                        <ul class="data-list">
                            @foreach($answerData->allowConditions as $condition)
                                <li>{{$condition->content}}</li>
                            @endforeach
                                <li>{{$answerData->allowFreeCondition->condition_free ?? ''}}
                                </li>
                        </ul>
                    </div>

                    <div class="grid-item row-label">通行期間</div>
                    <div class="grid-item row-data">申請書期間のとおり（許可日から）</div>
                </div>
            </div>
            <div class="content-disallow">
                <div class="content-text">
                    <div>
                        　{{ $answerData->application_date_wareki }}付、{{$answerData->client->numbering_name}}第{{$answerData->consultation_number}}号で協議のあった下記道路については、以下の理由により申請に係る車両の通行を許可することは不適当であると認められるので回答します。
                    </div>
                </div>

                <div class="content-grid">
                    <div class="grid-item th-label">道路名</div>
                    <div class="grid-item th-label">区間</div>
                    <div class="grid-item th-data">
                        <ul class="data-list">
                        @foreach($answerData->notAllowRoutes as $notRoute)
                        <li>{{$notRoute->name}}</li>
                        @endforeach
                    </div>
                    <div class="grid-item th-data">
                        <div>申請経路のとおり</div>
                        <div>目的地　
                        {{$answerData->destination}}</div>
                        @if($answerData->otherDestination)
                            <div>
                                　　　　{{$answerData->otherDestination->second_destination}}
                            </div>
                        @endif
                    </div>

                    <div class="grid-item row-label">道路現況</div>
                    <div class="grid-item row3-data">
                        <ul class="data-list">
                            @foreach($answerData->notAllowConditions->where('conditioncategory_id', 10) as $condition)
                                <li>{{$condition->content}}</li>
                            @endforeach
                                <li>
                                    {{$answerData->notFreeConditions->where('not_condition_id', -10)->first()->condition_free}}
                                </li>
                        </ul>

                    </div>
                    <div class="grid-item row-label">理由</div>

                    <div class="grid-item row3-data">
                        <ul class="data-list">
                            @foreach($answerData->notAllowConditions->where('conditioncategory_id', 11) as $condition)
                                <li>{{$condition->content}}</li>
                            @endforeach
                                <li>
                                    {{$answerData->notFreeConditions->where('not_condition_id', -11)->first()->condition_free}}
                                </li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="content-text">
                <div>　備　　考</div>
                <div class="answer-remarks">{{$answerData->remark->answer_remarks ?? ''}}</div>
            </div>
            <div class="content-contact">
                <div>
                    連絡先　{{$answerSetting->department}}　　担当 {{$answerData->staffs->name}}
                </div>
                <div>
                    {{$answerSetting->tel}}
                    @if($answerSetting->extension)
                        内線 {{$answerSetting->extension}}
                    @endif
                </div>
            </div>
        </div>
    </div>
    @break

    @case(3)
    <div class="sheet-preview">
    別記様式５
        <div class="outside-border">
            <div class="sheet-title">
                特殊車両通行許可協議回答書
            </div>
            <div class="content-date-container">
                <div class="content-date">
                    <div>
                        {{$answerData->numbering_name}}{{$answerData->approval_number}}号
                    </div>
                    <div>
                        {{ $answerData->approval_date_wareki }}

                    </div>
                </div>
            </div>
            <div class="content-address-container">
                <div class="content-address">
                    <div>道路管理者</div>
                    <div>
                        @if($answerData->client_id != 0)
                            　{{$answerData->client->answer_address1}}　殿
                        @endif
                    </div>
                    <div>
                        @if($answerData->client->answer_address2 != null)
                            　({{$answerData->client->answer_address2}})
                        @endif

                    </div>
                </div>
            </div>

            <div class="content-sender-container">
                <div class="content-sender">
                    <div>道路管理者</div>
                    <div>　{{$answerSetting->position}} 　{{$answerSetting->administrator_name}}</div>
                    <div>　（公印省略）</div>
                </div>
            </div>

            <div class="content-allow diagonal case3">
                <div class="content-text">
                    <div>
                        　年　月　日付、第　号で協議のあった下記道路については、申請に係る車両の通行を許可してよいと認められるので回答します。
                    </div>
                    <div>
                        　ただし、通行条件欄記載の条件に従わせること。
                    </div>
                </div>

                <div class="content-grid">
                    <div class="grid-item th-label">道路名</div>
                    <div class="grid-item th-label">区間</div>
                    <div class="grid-item th-label">通行条件</div>

                    <div class="grid-item td-data"></div>
                    <div class="grid-item td-data"></div>
                    <div class="grid-item td-data"></div>
                    <div class="grid-item row-label">通行期間</div>
                    <div class="grid-item row-data">申請書期間のとおり（許可日から）</div>
                </div>
            </div>
            <div class="content-disallow case3">
                <div class="content-text">
                    <div>
                        　{{ $answerData->application_date_wareki }}付、{{$answerData->client->numbering_name}}第{{$answerData->consultation_number}}号で協議のあった下記道路については、以下の理由により申請に係る車両の通行を許可することは不適当であると認められるので回答します。
                    </div>
                </div>

                <div class="content-grid">
                    <div class="grid-item th-label">道路名</div>
                    <div class="grid-item th-label">区間</div>
                    <div class="grid-item th-data">
                        <ul class="data-list">
                        @foreach($answerData->notAllowRoutes as $notRoute)
                        <li>{{$notRoute->name}}</li>
                        @endforeach
                    </div>
                    <div class="grid-item th-data">
                        <div>申請経路のとおり</div>
                        <div>目的地　
                        {{$answerData->destination}}</div>
                        @if($answerData->otherDestination)
                            <div>
                                　　　　{{$answerData->otherDestination->second_destination}}
                            </div>
                        @endif
                    </div>

                    <div class="grid-item row-label">道路現況</div>
                    <div class="grid-item row3-data">
                        <ul class="data-list">
                            @foreach($answerData->notAllowConditions->where('conditioncategory_id', 10) as $condition)
                                <li>{{$condition->content}}</li>
                            @endforeach
                                <li>
                                    {{$answerData->notFreeConditions->where('not_condition_id', -10)->first()->condition_free ?? ''}}
                                </li>
                        </ul>

                    </div>
                    <div class="grid-item row-label">理由</div>

                    <div class="grid-item row3-data">
                        <ul class="data-list">
                            @foreach($answerData->notAllowConditions->where('conditioncategory_id', 11) as $condition)
                                <li>{{$condition->content}}</li>
                            @endforeach
                                <li>
                                    {{$answerData->notFreeConditions->where('not_condition_id', -11)->first()->condition_free ?? ''}}
                                </li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="content-text">
                <div>　備　　考</div>
                <div class="answer-remarks">{{$answerData->remark->answer_remarks ?? ''}}</div>
            </div>
            <div class="content-contact">
                <div>
                    連絡先　{{$answerSetting->department}}　　担当 {{$answerData->staffs->name}}
                </div>
                <div>
                    {{$answerSetting->tel}}
                    @if($answerSetting->extension)
                        内線 {{$answerSetting->extension}}
                    @endif
                </div>
            </div>
        </div>
    </div>

    @break

    @case(4)
    <div class="sheet-preview">


        <div class="sheet-title">
            車両通行条件書
        </div>

        <div class="content-date case4">
            <div>
                {{$answerData->numbering_name}}{{$answerData->approval_number}}号
            </div>
            <div>
                {{ $answerData->approval_date_wareki }}
            </div>
        </div>

        <div class="outside-border case4">

            <div class="content-allow case4">
                <div class="content-grid">
                    <div class="grid-item th-label">1 道路名</div>
                    <div class="grid-item td-data">
                        <ul class="data-list">
                            @foreach($answerData->allowRoutes as $route)
                                <li>{{$route->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="grid-item th-label">2 区間</div>
                    <div class="grid-item td-data">
                        <div>目的地及び出発地</div>
                        <div>（{{$answerData->destination}}）</div>
                        @if($answerData->otherDestination)
                            <div>
                                （{{$answerData->otherDestination->second_destination}}）
                            </div>
                        @endif
                    </div>
                    <div class="grid-item th-label">3 通行期間　　許可の日から{{$answerData->counter->permissionperiod->name}}</div>
                    <div class="grid-item th-label">4 通行条件</div>
                    <div class="grid-item td-data">
                        <ul class="data-list">
                            @foreach($answerData->allowConditions as $condition)
                                <li>{{$condition->content}}</li>
                            @endforeach
                                <li>{{$answerData->allowFreeCondition->condition_free}}
                                </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="content-text">
                　備　　考
            </div>
            <div class="content-contact">
                <div>
                    連絡先　{{$answerSetting->department}}　　担当 {{$answerData->staffs->name}}
                </div>
                <div>
                    {{$answerSetting->tel}}
                    @if($answerSetting->extension)
                        内線 {{$answerSetting->extension}}
                    @endif
                </div>
            </div>
        </div>
    </div>


    @break

    @endswitch

    @if($answerData->sheet_type != 4)

    <div class="sheet-preview fax">


        <div class="sheet-title">
            FAX送信書
        </div>

        <div class="content-date fax">
            <div>
                {{ $answerData->approval_date_wareki }}
            </div>
        </div>

        <div class="content-fax">
            <table class="table-fax">
                <tbody>
                    <tr>
                        <th>件名</th>
                        <td>特車協議回答</td>
                    </tr>
                    <tr>
                        <th>宛先</th>
                        <td>{{$answerData->client->fax_address1}}<br>
                            {{$answerData->client->fax_address2}}<br>
                            {{$answerData->client->fax_address3}} 御中</td>
                    </tr>
                    <tr>
                        <th>FAX</th>
                        <td class="center">{{$answerData->client->fax}}</td>
                    </tr>
                    <tr>
                        <th>TEL</th>
                        <td class="center">{{$answerData->client->tel}}</td>
                    </tr>
                        <th>送信者</th>
                        <td>{{$answerSetting->department}}<br>
                            TEL：{{$answerSetting->tel}}<br>
                            FAX：{{$answerSetting->fax}}<br>
                            〒 {{$answerSetting->postcode}}<br>
                            {{$answerSetting->address}}
                        </td>
                    </tr>
                    <tr>
                        <th>送付枚数</th>
                        <td class="center">A4　　　枚（送信書含む）</td>
                    </tr>
                    <tr>
                        <th>通信欄</th>
                        <td class="fax-remarks">{{$answerData->remark->fax_remarks ?? ''}}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
    <div class="page-break"></div>
    @endif

</div>
@endsection
