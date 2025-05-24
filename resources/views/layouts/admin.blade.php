<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <title>@yield('title', 'Painel Admin') - HelloPics</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- CSS do Color Admin via GitHub -->
    <link href="https://rawcdn.githack.com/asbragax/assets_gk/main/coloradmin5.5/css/vendor.min.css" rel="stylesheet" />
    <link href="https://rawcdn.githack.com/asbragax/assets_gk/main/coloradmin5.5/css/transparent/app.min.css" rel="stylesheet" />
</head>
<body class="pace-top">

    <!-- Estrutura principal -->
    <div id="app" class="app app-header-fixed app-sidebar-fixed app-content-full-height">

        <!-- Header -->
        @include('layouts.admin-header')

        <!-- Sidebar -->
        @include('layouts.admin-sidebar')

        <!-- Conteúdo -->
        <div id="content" class="app-content">
            @yield('content')
        </div>
    </div>

    <!-- JS do Color Admin via GitHub -->
    <script src="https://rawcdn.githack.com/asbragax/assets_gk/main/coloradmin5.5/js/vendor.min.js"></script>
    <script src="https://rawcdn.githack.com/asbragax/assets_gk/main/coloradmin5.5/js/app.min.js"></script>
</body>
</html>
