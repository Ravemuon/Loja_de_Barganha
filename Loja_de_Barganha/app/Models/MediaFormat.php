<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaFormat extends Model
{
    protected $fillable = ['nome'];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}