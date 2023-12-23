@extends('layouts.app')


@section('content')
<div class="container">
    <h2>Lista de Jogadores</h2>

    <table id="playersTable" class="table table-striped">
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

    <!-- Adicione este botão à sua view -->
    <button type="button" class="btn btn-primary" id="configButton">
        Configurar Sorteio
    </button>

    <form action="{{ route('draw-teams') }}" method="get">


        <div class="modal fade" id="configModal" tabindex="-1" role="dialog" aria-labelledby="configModalLabel" aria-hidden="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="configModalLabel">Configurações do Sorteio</h5>

                    </div>
                    <div class="modal-body">
                        <!-- Adicione os campos para configurar o sorteio aqui -->
                        <label for="playersPerTeam">Número de Jogadores por Time:</label>
                        <input type="number" id="playersPerTeam" name="playersPerTeam" class="form-control" min="1" value="5">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" id="closeModalButton" data-dismiss="modal">Fechar</button>
                        <button type="submit" class="btn btn-primary" id="startDrawButton">
                            Iniciar Sorteio
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<!-- Adicione este script para manipular a abertura da modal e iniciar o sorteio -->
<script>
    $(document).ready(function() {
        // Inicialize a tabela com a funcionalidade de pesquisa
        $('#playersTable').DataTable({
            "paging": true, // Ativar paginação
            "searching": true, // Ativar pesquisa
            "language": {
                "url": "https://cdn.datatables.net/plug-ins/1.10.24/i18n/Portuguese-Brasil.json"
            }
        });

        var myModal = new bootstrap.Modal(document.getElementById('configModal'));

        $('#configButton').click(function() {
            myModal.show();
        });

        $('#closeModalButton').click(function() {
            myModal.hide();
        });
    });
</script>

@endsection