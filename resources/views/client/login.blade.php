<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Entrar - HelloPics</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

    <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md">
        <h1 class="text-2xl font-bold text-center mb-6">Entrar no HelloPics</h1>

        <!-- Login com e-mail/senha -->
        <form method="POST" action="{{ route('login') }}" class="mb-4">
            @csrf

            <div class="mb-4">
                <label class="block text-gray-700">E-mail</label>
                <input type="email" name="email" required
                       class="w-full border px-3 py-2 rounded mt-1" autofocus />
            </div>

            <div class="mb-4">
                <label class="block text-gray-700">Senha</label>
                <input type="password" name="password" required
                       class="w-full border px-3 py-2 rounded mt-1" />
            </div>

            <button type="submit"
                    class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700 transition">
                Entrar com E-mail
            </button>
        </form>

        <div class="text-center text-sm text-gray-500 mb-2">ou</div>

        <!-- Login com Google -->
        <a href="{{ route('google.login') }}"
           class="block w-full text-center bg-red-600 text-white py-2 rounded hover:bg-red-700 transition">
            Entrar com Google
        </a>

        <p class="text-sm text-gray-600 text-center mt-4">
            Ao continuar, você concorda com os <a href="#" class="underline">termos de uso</a>.
        </p>
    </div>

</body>
</html>
