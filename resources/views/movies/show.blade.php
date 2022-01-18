@extends('templates.base')
@section('title', 'Visualizar Filme')

@section('content')
<h1>Título: {{ $mov->name }}</h1>
<p>Gênero: {{$mov->genre}}</p>
<p>Descrição: {{$mov->description}}</p>
<a href="{{ $mov->trailer }}">Trailer</a>

<p class="text-center"><img src="{{asset('img/' . $mov->image)}}"  width="800"></p>
@endsection