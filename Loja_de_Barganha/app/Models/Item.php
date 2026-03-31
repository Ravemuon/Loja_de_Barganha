<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 
        'artista_diretor', 
        'empresa_produtora',
        'elenco_detalhes',
        'descricao',
        'preco', 
        'tipo_midia', 
        'capa', 
        'category_id', 
        'media_format_id', 
        'user_id'
    ];

    // --- ACCESSORS (Lógica Automática) ---

    /**
     * Se não houver autor, retorna um padrão.
     */
    public function getArtistaDiretorAttribute($value)
    {
        return $value ?: 'Não Informado';
    }

    /**
     * Se não houver empresa, assume Independente.
     */
    public function getEmpresaProdutoraAttribute($value)
    {
        return $value ?: 'Independente';
    }

    /**
     * Retorna uma versão curta da descrição para os cards da home.
     */
    public function getResumoAttribute()
    {
        return Str::limit($this->descricao, 50, '...');
    }

    // --- RELACIONAMENTOS ---

    // O item pertence a uma categoria
    public function categoria()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // O item tem um formato de mídia (CD, Vinil, etc)
    public function formato_midia()
    {
        return $this->belongsTo(MediaFormat::class, 'media_format_id');
    }

    // Um item pode ter vários registros de interesse
    public function interests()
    {
        return $this->hasMany(Interest::class);
    }
    
    // Relacionamento com o usuário que cadastrou
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}