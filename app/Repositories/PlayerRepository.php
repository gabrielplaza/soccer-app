<?php


namespace App\Repositories;

use App\Models\Player;

class PlayerRepository
{
    public function createPlayer($data)
    {
        return Player::create($data);
    }

    public function updatePlayer($id, array $data)
    {
        $player = Player::findOrFail($id);

     

        $player->update([
            'name' => $data['name'],
            'level' => $data['level'],
            'goalkeeper' => $data['goalkeeper'],
        ]);

        return $player;
    }

    public function destroyPlayer($id)
    {
        $player = Player::findOrFail($id);
        $player->delete();

        return redirect()->route('players.index')->with('success', 'Jogador excluído com sucesso!');
    }
}
