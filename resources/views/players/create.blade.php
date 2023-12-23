@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h2>Adicionar Jogador</h2>

        <form action="{{ route('players.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <div class="form-group">
                <label for="level">Nível (1-5):</label>
                <input type="number" class="form-control" name="level" min="1" max="5" required>
            </div>

            <div class="form-group">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" name="goalkeeper" id="goalkeeper">
                    <label class="form-check-label" for="goalkeeper">Goleiro</label>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Adicionar</button>
        </form>

        <a href="{{ route('players.index') }}" class="btn btn-secondary mt-3">Voltar para a Lista</a>
    </div>
@endsection
