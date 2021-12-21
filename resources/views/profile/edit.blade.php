@extends('templates.base')
@section('title', 'Editar perfil')
@section('h1', 'Editar Perfil')

@section('content')
<div class="row">
    <div class="col-4">

        <form method="post" action="{{ route('profile.update', $user) }}">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name" value="{{$user->name}}">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
            </div>
            <div class="mb-3">
                <label for="username" class="form-label">Usuario</label>
                <input type="username" class="form-control" id="username" name="username" value="{{$user->username}}">
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Gravar</button>
            </div>
        </form>

    </div>
</div>
@endsection