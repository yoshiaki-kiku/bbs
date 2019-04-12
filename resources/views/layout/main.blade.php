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

    @include("layout.navbar")



    <div class="container mt-4 p-0">
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
