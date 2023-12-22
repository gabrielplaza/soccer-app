@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Lista de Jogadores</h2>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Nível</th>
                    <th>Goleiro</th>
                    <th>Confirmado</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($players as $player)
                    <tr>
                        <td>{{ $player->name }}</td>
                        <td>{{ $player->level }}</td>
                        <td>{{ $player->goalkeeper ? 'Sim' : 'Não' }}</td>
                        <td>
                            <form action="{{ route('players.confirm', $player->id) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-{{ $player->confirmed ? 'danger' : 'success' }}">
                                    {{ $player->confirmed ? 'Desconfirmar' : 'Confirmar' }}
                                </button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('players.edit', $player->id) }}" class="btn btn-warning">Editar</a>
                            <form action="{{ route('players.destroy', $player->id) }}" method="post" style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este jogador?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">Nenhum jogador encontrado</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <a href="{{ route('players.create') }}" class="btn btn-primary">Adicionar Jogador</a>
    </div>
@endsection
