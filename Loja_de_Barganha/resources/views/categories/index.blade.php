@extends('layouts.app')

@section('content')
<div class="container pb-5">
    {{-- Cabeçalho Estilizado --}}
    <div class="row mb-5 align-items-center">
        <div class="col-lg-8">
            <h1 class="display-3 fw-bold text-white shadow-sm" style="font-family: 'Permanent Marker', cursive;">
                EXPLORE O <span class="text-warning">ESTOQUE</span>
            </h1>
            <p class="text-dim fs-5">Navegue pelas coleções underground de Chapecó.</p>
        </div>
        
        <div class="col-lg-4 text-lg-end">
            <div class="btn-group shadow">
                {{-- Usando as cores do seu :root --}}
                <a href="{{ route('home', ['tipo_midia' => 'Música']) }}" class="btn btn-outline-danger fw-bold text-uppercase" style="border-width: 2px;">Música</a>
                <a href="{{ route('home', ['tipo_midia' => 'Jogo']) }}" class="btn btn-outline-info fw-bold text-uppercase" style="border-width: 2px;">Jogos</a>
                <a href="{{ route('home', ['tipo_midia' => 'Filme']) }}" class="btn btn-outline-warning fw-bold text-uppercase" style="border-width: 2px;">Filmes</a>
            </div>
        </div>
    </div>

    {{-- Painel Administrativo (Apenas para autenticados) --}}
    @auth
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-dark border-warning p-3 d-flex flex-row justify-content-between align-items-center shadow">
                <span class="text-warning fw-bold text-uppercase" style="letter-spacing: 1px;">
                    <i class="bi bi-shield-lock me-2"></i>Gerenciamento de Coleções
                </span>
                <a href="{{ route('categories.create') }}" class="btn btn-punk px-4 shadow-sm">
                    <i class="bi bi-plus-lg me-1"></i> NOVA CATEGORIA
                </a>
            </div>
        </div>
    </div>
    @endauth

    {{-- Grid de Categorias com o Estilo card-rock --}}
    <div class="row g-4">
        @foreach($categories as $category)
            <div class="col-md-4 col-lg-3">
                <div class="card card-rock h-100 p-4 position-relative border-secondary">
                    
                    @auth
                        <div class="position-absolute top-0 end-0 p-2 d-flex gap-1" style="z-index: 20;">
                            <a href="{{ route('categories.edit', $category->id) }}" 
                               class="btn btn-sm btn-dark border-secondary text-white" 
                               title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Deseja mesmo banir esta categoria?')">
                                @csrf 
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-dark border-danger text-danger" title="Excluir">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    @endauth

                    <a href="{{ route('categories.show', $category->id) }}" class="text-decoration-none text-center d-flex flex-column h-100">
                        <div class="category-icon mb-3">
                            @php
                                $slug = Str::lower($category->nome);
                                $icon = 'bi-bookmark-star';
                                $color = 'text-white';
                                
                                // Lógica de ícones baseada no nome
                                if(Str::contains($slug, ['rock', 'metal', 'musica', 'disco', 'vinil'])) { $icon = 'bi-vinyl-fill'; $color = 'text-danger'; }
                                elseif(Str::contains($slug, ['filme', 'cinema', 'vhs', 'terror'])) { $icon = 'bi-film'; $color = 'text-warning'; }
                                elseif(Str::contains($slug, ['jogo', 'game', 'nintendo', 'retro'])) { $icon = 'bi-controller'; $color = 'text-info'; }
                            @endphp
                            <i class="bi {{ $icon }} {{ $color }} display-4" style="filter: drop-shadow(2px 2px 0px #000);"></i>
                        </div>
                        
                        <h3 class="text-white fw-bold text-uppercase mb-1" style="font-family: 'Roboto Condensed', sans-serif;">
                            {{ $category->nome }}
                        </h3>
                        
                        <div class="mt-auto">
                            <span class="badge bg-warning text-dark fw-bold text-uppercase px-3">
                                {{ $category->items_count ?? $category->items->count() }} Itens
                            </span>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- Estilos específicos que não estão no Global --}}
<style>
    .category-icon { 
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275); 
    }
    .card-rock:hover .category-icon { 
        transform: scale(1.2) rotate(-5deg); 
    }
    /* O card-rock já herda as bordas e cores do seu app.blade.php */
</style>
@endsection