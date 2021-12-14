<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UsuariosController extends Controller {
    public function index() {
        $usuarios = Usuario::orderBy('id', 'asc')->get();

        return view('usuarios.index', ['usuarios' => $usuarios, 'pagina' => 'usuarios']);
    }

    public function create() {
        return view('usuarios.create', ['pagina' => 'usuarios']);
    }

    public function insert(Request $form) {
        $usuario = new Usuario();

        $usuario->name = $form->name;
        $usuario->email = $form->email;
        $usuario->username = $form->username;
        $usuario->password = Hash::make($form->password);

        $usuario->save();

        event(new Registered($usuario));
        Auth::login($usuario);
        return redirect()->route('verification.notice');
       // return redirect()->route('usuarios.index');
    }

    // Ações de login
    public function login(Request $form) {
        // Está enviando o formulário
        if ($form->isMethod('POST')) {
                $credenciais = $form->validate([
                    'username' => ['required'],
                    'password' => ['required'],
                ]);
                $rememberLogin = $form->rememberLogin == '1';
                // Tenta o login
                if (Auth::attempt($credenciais, $rememberLogin)) {
                    session()->regenerate();
                    return redirect()->route('home');                   

                } else {
                    // Login deu errado (usuário ou senha inválidos)
                    return redirect()->route('login')->with(
                        'erro',
                        'Usuário ou senha inválidos.'
                    );
                }

            // Login deu errado (usuário ou senha inválidos)
            return redirect()->route('login')->with('erro', 'Usuário ou senha inválidos.');
        }

        return view('usuarios.login');
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }
}
