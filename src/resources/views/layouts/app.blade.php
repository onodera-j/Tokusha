<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Tokusha_App</title>
  <link rel="stylesheet" href="{{ asset('css/common.css') }}" />
  <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Almarai&family=DotGothic16&family=Inika&family=Noto+Serif+JP&display=swap" rel="stylesheet">

  @yield('css')

</head>
<body>
    <header class="header">
        <div class="header-inner">
            <div class="header-title dotgothic16-regular">
                <a class="link" href="/">特殊車両通行許可申請 回答書作成アプリ</a>
            </div>

            <div class="member-nav">
                <ul class="member-menu">
                    @if (Auth::check())
                    <form class="form" action="/logout" method="post">
                    @csrf
                    <li class="member-content">
                        <button class="button-logout">ログアウト</button>
                    </li>
                    </form>

                    @else
                    <li class="member-content">
                        <a class="link" href="/login">ログイン</a>
                    </li>
                    @endif
                    <li class="member-content">
                        <a class="link" href="/mypage/mypage">マイページ</a>
                    </li>

                </ul>
            </div>

        </div>

    </header>
    <main>

        @yield("content")


    </main>
</body>
</html>
