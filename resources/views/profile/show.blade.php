@extends('templates.base')
@section('title', 'Dados cadastrados')

@section('content')

<a href="{{ route('profile.edit') }}">Alterar dados</a>
<a href="{{ route('profile.changePass')}}">Alterar senha</a>

<h1>Nome: {{ $user->name }}</h1>

<p>Email: {{$user->email}}</p>
<p>Usuário: {{$user->username}}</p>

@endsection