<!-- resources/views/jogadores/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Adicionar Jogador</h2>

    <form action="{{ route('players.store') }}" method="post">
        @csrf
        <label for="name">Nome:</label>
        <input type="text" name="name" required>

        <label for="level">Nível (1-5):</label>
        <input type="number" name="level" min="1" max="5" required>

        <label for="goalkeeper">Goleiro:</label>
        <input type="checkbox" name="goalkeeper">

        <button type="submit">Adicionar</button>
    </form>

    <a href="{{ route('players.index') }}">Voltar para a Lista</a>
@endsection
