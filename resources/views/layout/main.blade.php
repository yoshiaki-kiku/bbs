<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>交流サイト@hasSection('title') - @yield('title') @endif</title>
    @include("layout.styles")
    <style type="text/css">
    </style>
</head>

<body>
    <div id="app">
        @include("layout.navbar")

        <div class="container my-2 px-0 py-2">
            @yield('content')
        </div>

        <footer>
            <div class="container-fluid py-4 bg-secondary">
                <div class="row">

                </div>
            </div>
        </footer>
    </div>
    @include("layout.footer_scripts")
</body>

</html>
