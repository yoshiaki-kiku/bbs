<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>交流サイト</title>
    @include("layout.styles")
</head>

<body>

    <nav class="navbar navbar-dark bg-secondary">
        <a class="navbar-brand" href="{{ route('home') }}">交流サイト</a>
    </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    @include("layout.footer_scripts")

    <footer>
        <div class="container-fluid py-4 bg-secondary">
            <div class="row">

            </div>
        </div>
    </footer>
</body>

</html>
