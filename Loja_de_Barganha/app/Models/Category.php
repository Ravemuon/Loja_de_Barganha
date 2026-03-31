<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['nome'];

    // Relacionamento: Uma categoria tem muitos itens
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}