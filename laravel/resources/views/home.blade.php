<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <!-- Tailwind -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="shortcut icon" href="../img/iconoProyecto.png" type="image/x-icon">
    <title>Golpass</title>
</head>

<body class="bg-gray-100">
    <nav class="p-6 bg-white shadow-md flex justify-between items-center">
        <h1 class="text-2xl font-bold text-green-600">GOLPASS</h1>
        <img class="w-14" src="{{ asset('img/iconoProyecto.png')}}" alt="icono golpass">
        <div>
            <a href="/admin" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">Login</a>
        </div>
    </nav>

    <header class="py-20 text-center">
        <h2 class="text-5xl font-extrabold text-gray-800 mb-4">Vive la pasión del fútbol</h2>
        <p class="text-xl text-gray-600 mb-8">Gestiona y compra tus entradas para los mejores derbis de la liga.</p>
        <a href="#proximos-partidos" class="bg-green-500 text-white px-8 py-3 rounded-full font-bold text-lg hover:bg-green-600 transition">Ver Partidos</a>
    </header>

    <section id="proximos-partidos" class="container mx-auto px-6 py-10">
        <h3 class="text-3xl font-bold mb-6">Próximos Encuentros</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            @foreach(\App\Models\Partido::all() as $partido)
            <div class="p-6 bg-white rounded-xl shadow-md border-t-4 border-green-600">
                <div class="text-sm text-gray-500 mb-2">{{ $partido->fecha }}</div>
                <div class="flex justify-between items-center font-bold text-lg text-gray-800">
                    <span>{{ $partido->equipoLocal->nombre }}</span>
                    <span class="text-blue-500">VS</span>
                    <span>{{ $partido->equipoVisitante->nombre }}</span>
                </div>
                <p class="mt-4 text-gray-600 text-sm">🏟️ {{ $partido->estadio->nombre }}</p>
                <a href="#" class="mt-6 block text-center bg-green-600 text-white py-2 rounded-lg font-semibold hover:bg-green-700">
                    Comprar Entradas
                </a>

            </div>
            @endforeach

        </div>
    </section>

</body>

</html>