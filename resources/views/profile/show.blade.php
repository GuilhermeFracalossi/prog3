@extends('templates.base')
@section('title', 'Dados cadastrados')

@section('content')

<a href="{{ route('profile.edit') }}" class="btn btn-primary">Alterar dados</a>
<a href="{{ route('profile.editPass')}}" class="btn btn-warning">Alterar senha</a>

<h1>Nome: {{ $user->name }}</h1>

<p>Email: {{$user->email}}</p>
<p>Usuário: {{$user->username}}</p>

@endsection