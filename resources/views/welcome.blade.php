<!-- resources/views/players/index.blade.php -->

@extends('layouts.app') <!-- Substitua pelo nome do seu layout se aplicável -->

@section('content')
    <div class="container">
        <h1>Jogadores Confirmados</h1>

        <form action="{{ route('players.drawTeams') }}" method="POST">
            @csrf
            <label for="teamSize">Número de jogadores por time:</label>
            <input type="number" name="teamSize" id="teamSize" min="2" max="25" required>

            <button type="submit" class="btn btn-primary">Sortear Times</button>
        </form>

        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Nível</th>
                    <th>Goleiro</th>
                    <th>Confirmado</th>
                </tr>
            </thead>
            <tbody>
                @foreach($players as $player)
                    <tr>
                        <td>{{ $player->name }}</td>
                        <td>{{ $player->level }}</td>
                        <td>{{ $player->goalkeeper ? 'Sim' : 'Não' }}</td>
                        <td>
                            <input type="checkbox" name="confirmed_players[]" value="{{ $player->id }}">
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <button type="submit" class="btn btn-primary">Sortear Times</button>
    </div>
@endsection
