<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'user_id', 'status'];

    // Relacionamento: O interesse pertence a um item específico
    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    // Relacionamento: O interesse pode pertencer a um usuário logado
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}