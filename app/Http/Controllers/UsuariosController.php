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

    public function show() {
        $user = Auth::user();
        return view('profile.show', ['user' => $user, 'pagina' => 'perfil']);
    }
    public function edit() {
        $user = Auth::user();
        return view('profile.edit', ['user' => $user, 'pagina' => 'perfil']);
    }

    public function update(Request $request) {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = Auth::user()->password;
        $user->save();
        return redirect()->route('profile.show');
    }
    public function editPass() {
        return view('profile.editPass', ['pagina' => 'perfil']);
    }
    public function updatePass(Request $request) {

        if (Hash::check($request->oldPass, Auth::user()->password)) {
            $newPassHash = Hash::make($request->newPass);
            if (Hash::check($request->confirmationPass, $newPassHash )) {
                $user = Auth::user();
                $user->password = $newPassHash;
                $user->save();
                return redirect()->route('profile.show');
            }
        }
        dd("deu pau");
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
