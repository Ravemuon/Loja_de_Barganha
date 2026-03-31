@extends('layouts.app')

@section('content')
<div class="container pb-5">
    <div class="row mb-5 align-items-center">
        <div class="col-lg-8">
            <h1 class="display-3 fw-bold text-white shadow-sm" style="font-family: 'Permanent Marker', cursive;">
                EXPLORE O <span class="text-warning">ESTOQUE</span>
            </h1>
            <p class="text-dim fs-5">Navegue pelas coleções underground de Chapecó.</p>
        </div>
        
        <div class="col-lg-4 text-lg-end">
            <div class="btn-group shadow">
                <a href="{{ route('home', ['tipo_midia' => 'Música']) }}" class="btn btn-outline-danger fw-bold">MÚSICA</a>
                <a href="{{ route('home', ['tipo_midia' => 'Jogo']) }}" class="btn btn-outline-info fw-bold">JOGOS</a>
                <a href="{{ route('home', ['tipo_midia' => 'Filme']) }}" class="btn btn-outline-warning fw-bold">FILMES</a>
            </div>
        </div>
    </div>

    @auth
    <div class="row mb-4">
        <div class="col-12">
            <div class="card bg-dark border-warning p-3 d-flex flex-row justify-content-between align-items-center">
                <span class="text-warning fw-bold text-uppercase"><i class="bi bi-shield-lock me-2"></i>Painel de Controle</span>
                <button class="btn btn-punk px-4" data-bs-toggle="modal" data-bs-target="#modalCreateCategory">
                    <i class="bi bi-plus-lg me-1"></i> NOVA CATEGORIA
                </button>
            </div>
        </div>
    </div>
    @endauth

    <div class="row g-4">
        @foreach($categories as $category)
            <div class="col-md-4 col-lg-3">
                <div class="card card-rock h-100 p-4 position-relative">
                    @auth
                        <div class="position-absolute top-0 end-0 p-2 d-flex gap-1" style="z-index: 20;">
                            <button class="btn btn-sm btn-dark border-secondary text-white" 
                                    data-bs-toggle="modal" data-bs-target="#modalEdit{{ $category->id }}">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Excluir esta categoria?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-dark border-danger text-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                        
                        {{-- INCLUI O MODAL DE EDIÇÃO PARA CADA CATEGORIA --}}
                        @include('categories.partials.modal_edit')
                    @endauth

                    <a href="{{ route('home', ['category_id' => $category->id]) }}" class="text-decoration-none text-center d-flex flex-column h-100">
                        <div class="category-icon mb-3">
                            @php
                                $slug = Str::lower($category->nome);
                                $icon = 'bi-bookmark-star';
                                $color = 'text-white';
                                if(Str::contains($slug, ['rock', 'metal', 'musica'])) { $icon = 'bi-vinyl-fill'; $color = 'text-danger'; }
                                elseif(Str::contains($slug, ['filme', 'cinema', 'vhs'])) { $icon = 'bi-film'; $color = 'text-warning'; }
                                elseif(Str::contains($slug, ['jogo', 'game', 'nintendo', 'playstation'])) { $icon = 'bi-controller'; $color = 'text-info'; }
                            @endphp
                            <i class="bi {{ $icon }} {{ $color }} display-4"></i>
                        </div>
                        <h3 class="text-white fw-bold text-uppercase mb-1">{{ $category->nome }}</h3>
                        <span class="badge bg-warning text-dark fw-bold align-self-center">
                            {{ $category->items_count ?? $category->items->count() }} ITENS
                        </span>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

@auth
    @include('categories.partials.modal_create')
@endauth

<style>
    /* ... seus estilos permanecem os mesmos ... */
    .category-icon { transition: transform 0.3s ease; }
    .card-rock:hover .category-icon { transform: scale(1.1) rotate(5deg); }
    .card-rock { background: #111; border: 1px solid #333 !important; min-height: 220px; transition: all 0.3s; }
    .card-rock:hover { border-color: var(--punk-yellow) !important; box-shadow: 0 0 20px rgba(255, 204, 0, 0.15); }
    .btn-punk { background-color: #ffcc00; color: #000; font-weight: 900; border-radius: 0; }
</style>
@endsection