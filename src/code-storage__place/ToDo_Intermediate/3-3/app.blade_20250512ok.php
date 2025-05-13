<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Todo</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
        <div class="header__inner">
            <!-- header__inner内に新たにクラスを作成し、nav付きヘッダーにする -->
            <div class="header-utilities">
                <!-- Todoのロゴをクリックすると"/"ホーム画面にリンクが飛ぶ -->
                <a class="header__logo" href="/">
                Todo
                </a>
                <!-- navでヘッダーにナビの要素を持たせる -->
                <nav>
                    <ul class="header-nav">
                        <li class="header-nav__item">
                            <!-- カテゴリー一覧に飛ぶようにリンク設定 -->
                            <a class="header-nav__link" href="/categories">カテゴリ一覧</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>