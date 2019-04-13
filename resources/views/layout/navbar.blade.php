<nav class="navbar navbar-expand-lg navbar-dark bg-secondary">
    <a class="navbar-brand" href="{{ route('home') }}">交流サイト</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">


        <form action="{{ route('search.result') }}" class="form-inline my-2 my-lg-0 mr-auto" method="get">
            <select class="form-control mr-0 mr-sm-2 mb-2 mb-sm-0" name="column">
                <option value="topic">トピック名</option>
                <option value="comment">コメント</option>
            </select>
            <div class="input-group">
                <input name="keywords" type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
                <div class="input-group-append">
                    <button class="btn btn-success" type="submit">検索</button>
                </div>
            </div>
        </form>


        <ul class="navbar-nav">
            @if(Auth::check())
            <li class="nav-item navbar-text text-light mr-4">
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
            <li class="nav-item mr-2 mb-2 mb-lg-0">
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
    </div>
</nav>
