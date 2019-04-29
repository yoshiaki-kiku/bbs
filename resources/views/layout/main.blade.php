<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="noindex,nofollow">
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
    <script>

    </script>
    <script>
        // 各blade内でvueMixinsに
        // 追加処理をpushして利用することが可能
        window.Laravel = {
            vueMixins: []
        }
    </script>
    {{-- 特定ページのみで必要なVueの処理をmixinで定義する --}}
    @yield('vue_mixin')
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/holder/2.9.6/holder.js"></script>
</body>

</html>
