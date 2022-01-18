@extends('templates.base')
@section('title', 'Inserir Filme')
@section('h1', 'Inserir Filme')

@section('content')
<div class="row">
    <div class="col-4">

        <form method="post" action="{{ route('movie.insert') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Descrição</label>
                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="genre" class="form-label">Gênero</label>
                <input type="text" class="form-control" id="genre" name="genre">
            </div>

            <div class="mb-3">
                <label for="trailer" class="form-label">Link do trailer</label>
                <input type="text" class="form-control" id="trailer" name="trailer">
            </div>

            <p>Foto: <input type="file" name="imagem"></p>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Gravar</button>
            </div>
        </form>

    </div>
</div>
@endsection