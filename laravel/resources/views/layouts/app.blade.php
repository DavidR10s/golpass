<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        <!-- Tailwind -->
        <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <link rel="shortcut icon" href="../img/iconoProyecto.png" type="image/x-icon">

        <title>{{ $title ?? config('app.name') }}</title>

    </head>
    <body class="bg-gray-100">
        <nav class="p-6 bg-white shadow-md flex justify-between items-center">
            <h1 class="text-2xl font-bold text-green-600"><a href="/">GOLPASS</a></h1>
            <img class="w-14" src="{{ asset('img/iconoProyecto.png') }}" alt="icono golpass">
            <div>
                <a href="/admin" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Login</a>
            </div>
        </nav>
        {{ $slot }}

        
    </body>
</html>
