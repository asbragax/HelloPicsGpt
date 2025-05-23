<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>@yield('title', 'Painel Admin - HelloPics')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- CSS principal do Color Admin via Githack -->
    <link href="https://rawcdn.githack.com/asbragax/assets_gk/main/coloradmin5.5/assets/css/default/app.min.css" rel="stylesheet" />
</head>
<body class="pace-top">

    <!-- HEADER -->
    @include('components.admin.header')

    <!-- SIDEBAR -->
    @include('components.admin.sidebar')

    <!-- CONTEÚDO PRINCIPAL -->
    <div id="content" class="app-content">
        @yield('content')
    </div>

    <!-- JS do Color Admin via Githack -->
    <script src="https://rawcdn.githack.com/asbragax/assets_gk/main/coloradmin5.5/assets/js/app.min.js"></script>
</body>
</html>
