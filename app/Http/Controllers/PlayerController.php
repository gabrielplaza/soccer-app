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
        $this->playerRepository->createPlayer($data);

        // Redirecionar de volta à página de listagem de jogadores
        return redirect()->route('players.index')->with('success', 'Jogador adicionado com sucesso!');
    }

    public function update(Request $request, $id)
    {
        // Validar os dados do formulário
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

        // Chamar o método updatePlayer do repositório para atualizar o jogador
        $updatedPlayer = $this->playerRepository->updatePlayer($id, $data);

        return redirect()->route('players.index')->with('success', "Jogador $updatedPlayer->name atualizado com sucesso!");
    }
    public function destroy($id)
    {
        return $this->playerRepository->destroyPlayer($id);
    }

    public function confirm($id)
    {
        $player = Player::findOrFail($id);
        $player->update(['confirmed' => !$player->confirmed]);

        return redirect()->back()->with('success', 'Presença confirmada/desconfirmada com sucesso!');
    }

   
    public function drawTeams(Request $request)
    {
        $playersPerTeam = $request->input('playersPerTeam', 5);
    
        $confirmedPlayers = Player::where('confirmed', true)->get();
    
        // Verifique se há jogadores suficientes para formar times
        if (count($confirmedPlayers) < $playersPerTeam * 2) {
            return redirect()->route('players.index')->with('error', 'Número insuficiente de jogadores confirmados para o sorteio.');
        }
    
        // Obtenha os goleiros entre os jogadores confirmados
        $goalkeepers = $confirmedPlayers->where('goalkeeper', true)->shuffle();
        
        // Obtenha os jogadores confirmados que não são goleiros
        $nonGoalkeepers = $confirmedPlayers->where('goalkeeper', false)->shuffle();
    
        // Calcule o número de times que podem ser formados (com pelo menos um goleiro em cada time)
        $maxTeams = ceil(count($goalkeepers) / 1) + ceil($nonGoalkeepers->count() / ($playersPerTeam - 1));
    
        // Divida os jogadores em times
        $teams = [];
    
        for ($i = 0; $i < $maxTeams; $i++) {
            $currentTeam = [];
    
            // Adicione um goleiro ao time (se houver goleiros disponíveis)
            $goalkeeper = $goalkeepers->pop();
    
            if ($goalkeeper !== null) {
                $currentTeam[] = $goalkeeper;
            }
    
            // Adicione jogadores não goleiros ao time
            for ($j = 0; $j < ($playersPerTeam - 1); $j++) {
                // Verifique se há jogadores não goleiros suficientes
                if ($nonGoalkeepers->count() > 0) {
                    $currentTeam[] = $nonGoalkeepers->pop();
                }
            }
    
            $teams[] = $currentTeam;
        }
    
        return view('players.result', ['drawnTeams' => $teams]);
    }
    


    



    
    

 
    

    public function showDrawResult()
    {
        // Obtenha os times sorteados da variável de sessão
        $teams = session('drawnTeams');

        // Limpe a variável de sessão após usá-la (opcional)
        session()->forget('drawnTeams');

        // Carregue a view com os times sorteados
        return view('players.result', compact('teams'));
    }
}
