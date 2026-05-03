<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar formularios
    public function showLogin() { return view('livewire.pages.login'); }
    public function showRegister() { return view('livewire.pages.register'); }

    // Lógica de Registro
    public function register(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // SIEMPRE encriptar
        ]);

        Auth::login($user);
        return redirect('/');
    }

    // Lógica de Login
    public function login(Request $request)
    {
        dd($request->all());
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // attempt hace la magia: busca el usuario, compara el Hash y crea la sesión
        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate(); // Seguridad contra fijación de sesión
            return redirect()->intended('/'); // Devuelve a donde iba el usuario
        }

        return back()->withErrors(['email' => 'Las credenciales no coinciden.']);
    }

    // Cerrar Sesión
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
