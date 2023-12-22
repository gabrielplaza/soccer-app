<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'level', 'goalkeeper', 'confirmed'];

    public function scopeConfirmed($query)
    {
        return $query->where('confirmed', true);
    }
}
