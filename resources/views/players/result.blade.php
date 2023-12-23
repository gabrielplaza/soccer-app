@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <h2 class="mb-4">Resultado do Sorteio</h2>

            @if($drawnTeams)
                <table class="table table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Time</th>
                            <th scope="col">Jogador</th>
                            <th scope="col">Nível de Habilidade</th>
                            <th scope="col">Goleiro</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($drawnTeams as $index => $team)
                            @foreach($team as $player)
                                <tr>
                                    @if ($loop->first)
                                        <td rowspan="{{ count($team) }}" class="align-middle">Time {{ $index + 1 }}</td>
                                    @endif
                                    <td>{{ $player->name }}</td>
                                    <td>{{ $player->level }}</td>
                                    <td>{{ $player->goalkeeper ? 'Sim' : 'Não' }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="mt-4">Nenhum time sorteado ainda.</p>
            @endif

            <a href="{{ route('players.index') }}" class="btn btn-primary mt-4">Voltar para a Lista de Jogadores</a>
        </div>
    </div>
</div>
@endsection
