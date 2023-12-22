<!-- resources/views/players/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h2>Editar Jogador</h2>

    <form action="{{ route('players.update', $player->id) }}" method="post">
        @csrf
        @method('put')

        <label for="name">Nome:</label>
        <input type="text" name="name" value="{{ $player->name }}" required>

        <label for="level">Nível:</label>
        <input type="number" name="level" value="{{ $player->level }}" required>

        <label for="goalkeeper">Goleiro:</label>
        <input type="checkbox" name="goalkeeper" {{ $player->goalkeeper ? 'checked' : '' }}>


        <button type="submit">Salvar Alterações</button>
    </form>

    <a href="{{ route('players.index') }}">Voltar para a Lista</a>
@endsection
