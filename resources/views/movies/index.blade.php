@extends('templates.base')
@section('title', 'Filmes')
@section('h1', 'Página de Filmes')

@section('content')
<div class="row">
    <div class="col">
        <p>Sejam bem-vindos à página de filmes</p>

        <a class="btn btn-primary" href="{{route('movie.create')}}" role="button">Cadastrar filme</a>

    </div>
</div>

<div class="row">

    {{-- para cada filme cadastrado, cria um card do boostrap --}}
    @foreach($movs as $mov)
    <div class="card" style="width: 18rem;">
        <img src="{{asset('img/' . $mov->image)}}" class="card-img-top" alt="...">
        <div class="card-body">
            <a href="{{ route('movie.show', $mov) }}">
                <h5 class="card-title">{{ $mov->name}}</h5>
            </a>
            <p class="card-text">{{ $mov->genre}}</p>
        </div>
    </div>
    @endforeach
@endsection