<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Player;
use App\Repositories\PlayerRepository;



class PlayerController extends Controller
{

    protected $playerRepository;

    public function __construct(PlayerRepository $playerRepository)
    {
        $this->playerRepository = $playerRepository;
    }
    public function index()
    {
        // Obter todos os jogadores do banco de dados
        $players = Player::all();
      
        // Carregar a view 'players.index' com os jogadores
        return view('players.index', compact('players'));
    }
    public function create()
    {
        return view('players.create');
    }

    public function edit($id)
    {
        $player = Player::findOrFail($id);

        return view('players.edit', compact('player'));
    }

    public function store(Request $request)
    {
        // Validação dos dados do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|integer|min:1|max:5',
        ]);

        // Criar um array com os dados do formulário
        $data = [
            'name' => $request->input('name'),
            'level' => $request->input('level'),
            'goalkeeper' => $request->has('goalkeeper') ? true : false,
        ];

        // Chamar o método create do repositório para salvar o jogador
        $this->playerRepository->create($data);

        // Redirecionar de volta à página de listagem de jogadores
        return redirect()->route('players.index')->with('success', 'Jogador adicionado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        $player = Player::findOrFail($id);
      
        // Validar os dados do formulário
        $request->validate([
            'name' => 'required|string|max:255',
            'level' => 'required|integer|min:1|max:5', 
        ]);
       
        $goalkeeper = $request->has('goalkeeper') ? true : false;

        // Atualizar os dados do jogador com base nos dados do formulário
        $player->update([
            'name' => $request->input('name'),
            'level' => $request->input('level'),
            'goalkeeper' => $goalkeeper,
        ]);

        return redirect()->route('players.index')->with('success', 'Jogador atualizado com sucesso!');
    }

    public function destroy($id)
{
    $player = Player::findOrFail($id);
    $player->delete();

    return redirect()->route('players.index')->with('success', 'Jogador excluído com sucesso!');
}

    public function confirm($id)
    {
        $player = Player::findOrFail($id);
        $player->update(['confirmed' => !$player->confirmed]);

        return redirect()->back()->with('success', 'Presença confirmada/desconfirmada com sucesso!');
    }

    public function drawTeams(Request $request)
    {
        // Validação - verifique se há jogadores marcados como confirmados
        $request->validate([
            'confirmed_players' => 'required|array|min:1',
        ]);

        // Obtenha os jogadores confirmados pelo usuário
        $confirmedPlayers = $request->input('confirmed_players');

        // Lógica para sortear times - implemente conforme necessário
        // ...

        // Redirecionar de volta à página de jogadores com uma mensagem de sucesso
        return redirect('/players')->with('success', 'Times sorteados com sucesso!');
    }
}
