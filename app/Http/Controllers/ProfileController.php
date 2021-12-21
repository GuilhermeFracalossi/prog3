<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller {

    public function index() {
        $user = Auth::user();

        return view('profile.show', ['user' => $user]);
    }

    public function edit(Usuario $user) {
        return view('profile.edit', ['user' => $user]);
    }

    public function update(Request $request, Usuario $user) {
        $user->name = $request->name;
        $user->email = $request->email;
        $user->username = $request->username;
        $user->save();
        return redirect()->route('profile.show');
    }
}
