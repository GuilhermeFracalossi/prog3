@extends('templates.base')
@section('title', 'Editar senha')
@section('h1', 'Editar senha')

@section('content')
<div class="row">
    <div class="col-4">

        <form method="post" action="{{ route('profile.updatePass') }}">
            @csrf
            @method('put')
            <div class="mb-3">
                <label for="oldPass" class="form-label">Senha antiga</label>
                <input type="password" class="form-control" id="oldPass" name="oldPass" >
            </div>
            <div class="mb-3">
                <label for="newPass" class="form-label">Nova senha</label>
                <input type="password" class="form-control" id="newPass" name="newPass">
            </div>
            <div class="mb-3">
                <label for="confirmationPass" class="form-label">Confirme a senha</label>
                <input type="password" class="form-control" id="confirmationPass" name="confirmationPass" >
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>

    </div>
</div>
@endsection