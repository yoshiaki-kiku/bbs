<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>交流サイト@hasSection('title') - @yield('title') @endif</title>
    @include("layout.styles")
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
        <a class="navbar-brand" href="{{ route('home') }}">交流サイト</a>

        <ul class="navbar-nav ml-auto">
            @if(Auth::check())
            <li class="nav-item navbar-text mr-4">
                ようこそ、{{ Auth::user()->name }} さん
            </li>
            <li class="nav-item">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <button type="button" class="btn btn-light">ログアウト</button>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
            @else
            <li class="nav-item mr-2">
                <a href="{{ route('login') }}">
                    <button class="btn btn-light" type="button">
                        ログイン
                    </button>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('register') }}">
                    <button class="btn btn-success" type="button">
                        会員登録
                    </button>
                </a>
            </li>
            @endif
        </ul>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    @include("layout.footer_scripts")

    <footer class="mt-4">
        <div class="container-fluid py-4 bg-secondary">
            <div class="row">

            </div>
        </div>
    </footer>
</body>

</html>
