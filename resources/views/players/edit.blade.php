@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Editar Jogador</h2>

        <form action="{{ route('players.update', $player->id) }}" method="post">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" name="name" value="{{ $player->name }}" required>
            </div>

            <div class="form-group">
                <label for="level">Nível:</label>
                <input type="number" class="form-control" name="level" value="{{ $player->level }}" required>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="goalkeeper" {{ $player->goalkeeper ? 'checked' : '' }}>
                    <label class="form-check-label" for="goalkeeper">Goleiro</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        </form>

        <a href="{{ route('players.index') }}" class="btn btn-secondary mt-3">Voltar para a Lista</a>
    </div>
@endsection
