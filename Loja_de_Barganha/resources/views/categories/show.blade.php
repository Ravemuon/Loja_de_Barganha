@extends('layouts.app')

@section('content')
<div class="container pb-5">
    {{-- Header da Categoria --}}
    <div class="row mb-5">
        <div class="col-12">
            <div class="card bg-dark border-5 p-4 shadow-lg position-relative overflow-hidden" 
                 style="border-color: var(--punk-yellow); border-style: solid; border-radius: 0;">
                
                {{-- Elemento Decorativo de Fundo --}}
                <i class="bi {{ $category->icone }} position-absolute opacity-10" 
                   style="font-size: 15rem; right: -20px; top: -50px; transform: rotate(15deg); color: var(--punk-yellow);"></i>

                <div class="row align-items-center position-relative" style="z-index: 2;">
                    <div class="col-md-auto text-center mb-3 mb-md-0">
                        <div class="bg-black border border-secondary p-3 d-inline-block shadow-sm">
                            <i class="bi {{ $category->icone }} display-1" 
                               style="color: {{ $category->tipo_midia == 'Música' ? 'var(--rock-red)' : ($category->tipo_midia == 'Jogo' ? '#0dcaf0' : 'var(--punk-yellow)') }}; filter: drop-shadow(3px 3px 0px #000);"></i>
                        </div>
                    </div>
                    <div class="col-md">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-2 text-uppercase fw-bold small">
                                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}" class="text-warning text-decoration-none">Coleções</a></li>
                                <li class="breadcrumb-item active text-white opacity-50" aria-current="page">{{ $category->tipo_midia }}</li>
                            </ol>
                        </nav>
                        <h1 class="display-4 fw-bold text-white text-uppercase mb-0" style="font-family: 'Permanent Marker', cursive;">
                            {{ $category->nome }}
                        </h1>
                        <p class="text-dim fs-5 mb-0">Total de <span class="text-white fw-bold">{{ $category->items->count() }}</span> artefatos catalogados nesta seção.</p>
                    </div>
                    @auth
                    <div class="col-md-auto mt-3 mt-md-0">
                        <div class="btn-group border border-secondary">
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-dark text-white fw-bold">EDITAR</a>
                            <a href="{{ route('items.create', ['category_id' => $category->id]) }}" class="btn btn-punk">ADICIONAR ITEM</a>
                        </div>
                    </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    {{-- Listagem de Itens --}}
    <div class="row g-4">
        @forelse($category->items as $item)
            <div class="col-md-6 col-lg-4">
                <div class="card card-rock h-100 shadow border-secondary">
                    {{-- Imagem do Item (Placeholder se não houver) --}}
                    <div class="position-relative">
                        <img src="{{ $item->imagem_url ?? 'https://images.unsplash.com/photo-1603048588665-791ca8aea617?q=80&w=500' }}" 
                             class="card-img-top rounded-0" alt="{{ $item->titulo }}" style="height: 250px; object-fit: cover;">
                        <div class="position-absolute bottom-0 start-0 m-3">
                            <span class="price-tag px-3 py-1 bg-black border border-warning">
                                R$ {{ number_format($item->preco, 2, ',', '.') }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body bg-dark text-white">
                        <h4 class="fw-bold text-uppercase" style="font-family: 'Roboto Condensed', sans-serif;">{{ $item->titulo }}</h4>
                        <p class="text-dim small mb-3 text-truncate-2">{{ $item->descricao }}</p>
                        
                        <div class="d-flex justify-content-between align-items-center mt-auto">
                            <span class="badge rounded-0 border border-secondary text-uppercase py-2 px-3">
                                {{ $item->estado_conservacao ?? 'Excelente' }}
                            </span>
                            <a href="{{ route('items.show', $item->id) }}" class="btn btn-outline-warning btn-sm fw-bold rounded-0">
                                VER DETALHES
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <div class="opacity-25 mb-4">
                    <i class="bi bi-box-seam display-1"></i>
                </div>
                <h3 class="text-dim text-uppercase fw-bold">Nenhum item encontrado nesta coleção.</h3>
                @auth
                    <a href="{{ route('items.create', ['category_id' => $category->id]) }}" class="btn btn-punk mt-3">SEJA O PRIMEIRO A ADICIONAR</a>
                @endauth
            </div>
        @endforelse
    </div>
</div>

<style>
    .text-truncate-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;  
        overflow: hidden;
    }

    .breadcrumb-item + .breadcrumb-item::before {
        color: var(--text-dim);
        content: "/";
    }

    .card-rock img {
        filter: grayscale(40%) contrast(1.1);
        transition: 0.5s;
    }

    .card-rock:hover img {
        filter: grayscale(0%) contrast(1.2);
    }
</style>
@endsection