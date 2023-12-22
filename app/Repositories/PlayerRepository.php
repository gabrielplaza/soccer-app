<?php


namespace App\Repositories;

use App\Models\Player;

class PlayerRepository
{
    public function create($data)
    {
        return Player::create($data);
    }
}
