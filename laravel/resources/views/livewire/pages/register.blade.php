<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
<div class="max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow-md">
    <div class="grid justify-center text-center">
        <img class="max-w-14" src="{{ asset('img/iconoProyecto.png') }}" alt="icono golpass">
    </div>
    <div class="grid justify-center text-center p-2">
        <h1 class="text-3xl font-bold mb-6">Registro</h1>
    </div>
    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{route('register')}}" method="post" wire:submit.prevent="register" class="space-y-4">
        @csrf
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">Nombre</label>
            <input type="name" name="name" id="name" wire:model="name" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
        </div>
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" id="email" wire:model="email" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Contraseña</label>
            <input type="password" name="password" id="password" wire:model="password" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
        </div>
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmar Contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation" wire:model="password_confirmation" required
                class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-green-500 focus:border-green-500">
        </div>
        <button type="submit"
            class="w-full bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">Registrarse
        </button>
        <div class="text-center">
            <p>¿Ya tienes una cuenta? <a href="{{ route('login') }}" class="text-green-600 hover:underline">Inicia sesión</a></p>
        </div>
    </form>
</div>