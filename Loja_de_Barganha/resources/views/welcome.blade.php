@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 bg-black min-vh-100 pb-5">
    <div class="row mb-5 align-items-center pt-5">
        <div class="col-lg-7 mb-4 mb-lg-0">
            <div class="badge bg-danger mb-2 px-3 py-2 text-uppercase fw-bold ls-2">Estoque de Chapecó</div>
            <h1 class="display-1 fw-black text-white shadow-sm mb-0 tracking-tighter" style="font-family: 'Arial Black', sans-serif; line-height: 0.9;">
                BARGANHA <span class="text-warning">&</span> <br>
                CULTURA <span class="text-danger">ROCK</span>
            </h1>
            <p class="lead text-dim fs-4 border-start border-warning border-4 ps-3 mt-4 opacity-75">
                Onde colecionadores encontram relíquias. <br>
                De <span class="text-white fw-bold">Matanza</span> a <span class="text-white fw-bold">Pokémon</span>, garanta sua raridade.
            </p>
        </div>
        
        <div class="col-lg-5">
            <div class="card bg-dark border-secondary p-4 shadow-2xl glass-effect" style="border-radius: 0px 30px 0px 30px; border-left: 5px solid #ffcc00;">
                <form action="{{ route('home') }}" method="GET">
                    <div class="mb-4">
                        <div class="input-group input-group-lg shadow-sm">
                            <span class="input-group-text bg-black border-secondary text-warning"><i class="bi bi-search"></i></span>
                            <input type="text" name="search" class="form-control bg-black text-white border-secondary fw-bold" 
                                   placeholder="O que você busca?" value="{{ $search ?? '' }}">
                        </div>
                    </div>

                    <div class="row g-2">
                        <div class="col-6">
                            <select name="category_id" class="form-select bg-black text-white border-secondary py-2 small text-uppercase">
                                <option value="">Categorias</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ ($categoryId ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-6">
                            <select name="tipo_midia" class="form-select bg-black text-white border-secondary py-2 small text-uppercase">
                                <option value="">Mídias</option>
                                <option value="Música" {{ ($tipoMidia ?? '') == 'Música' ? 'selected' : '' }}>Música</option>
                                <option value="Jogo" {{ ($tipoMidia ?? '') == 'Jogo' ? 'selected' : '' }}>Jogo</option>
                                <option value="Filme" {{ ($tipoMidia ?? '') == 'Filme' ? 'selected' : '' }}>Filme</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-punk w-100 mt-4 fw-black py-3 text-uppercase fs-5">
                        <i class="bi bi-lightning-charge-fill me-2"></i>GARIMPAR ITENS
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="d-flex align-items-center my-5">
        <div class="flex-grow-1 border-bottom border-secondary opacity-25"></div>
        <i class="bi bi-vinyl mx-3 text-secondary opacity-50 fs-3"></i>
        <div class="flex-grow-1 border-bottom border-secondary opacity-25"></div>
    </div>

    @if($grouped)
        @forelse($items as $categoriaNome => $colecaoItens)
            <div class="section-header d-flex align-items-end mb-4 mt-5">
                <h2 class="text-white fw-black text-uppercase mb-0 me-3 ls-1">
                    <span class="text-warning">#</span> {{ $categoriaNome }}
                </h2>
                <span class="text-dim small pb-1">{{ count($colecaoItens) }} itens disponíveis</span>
            </div>

            <div class="row g-4 mb-5">
                @foreach($colecaoItens as $item)
                    <div class="col-sm-6 col-md-4 col-xl-3 mb-4">
                        <div class="card card-rock h-100 shadow border-0 position-relative">
                            <div class="position-absolute top-0 end-0 bg-warning text-dark px-3 py-1 fw-black shadow price-badge" 
                                 style="z-index: 10; margin-top: -10px; margin-right: -10px;">
                                R$ {{ number_format($item->preco, 2, ',', '.') }}
                            </div>

                            <div class="card-img-container" style="height: 280px; overflow: hidden; background: #000;">
                                @if($item->capa)
                                    <img src="{{ asset('storage/' . $item->capa) }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $item->titulo }}">
                                @else
                                    <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-dim bg-dark">
                                        <i class="bi bi-disc" style="font-size: 3.5rem;"></i>
                                        <span class="small mt-2 text-uppercase fw-bold opacity-50">Sem Imagem</span>
                                    </div>
                                @endif
                            </div>

                            <div class="card-body d-flex flex-column p-4 bg-dark">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <small class="text-danger fw-black text-uppercase ls-1" style="font-size: 0.75rem;">{{ $item->tipo_midia }}</small>
                                    <span class="badge border border-secondary text-dim fw-light small">{{ $item->formato_midia->nome ?? 'Padrão' }}</span>
                                </div>
                                
                                <h5 class="card-title text-white text-uppercase mb-1 fw-black h6 text-truncate" title="{{ $item->titulo }}">
                                    {{ $item->titulo }}
                                </h5>
                                
                                <p class="text-dim mb-4 small text-truncate">{{ $item->artista_diretor }}</p>
                                
                                <div class="mt-auto pt-3 border-top border-secondary border-opacity-25">
                                    <a href="{{ route('items.show', $item->id) }}" class="btn btn-outline-warning w-100 text-uppercase fw-black ls-1">
                                        Detalhes <i class="bi bi-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @empty
            <div class="text-center py-5">
                <i class="bi bi-box-seam text-secondary display-1"></i>
                <h2 class="text-white mt-3 fw-bold">ESTOQUE EM BREVE...</h2>
            </div>
        @endforelse
    @else
        <div class="row g-4">
            @forelse($items as $item)
                <div class="col-sm-6 col-md-4 col-xl-3 mb-4">
                    <div class="card card-rock h-100 shadow border-0 position-relative">
                        <div class="position-absolute top-0 end-0 bg-warning text-dark px-3 py-1 fw-black shadow price-badge" 
                             style="z-index: 10; margin-top: -10px; margin-right: -10px;">
                            R$ {{ number_format($item->preco, 2, ',', '.') }}
                        </div>
                        <div class="card-img-container" style="height: 280px; overflow: hidden; background: #000;">
                            @if($item->capa)
                                <img src="{{ asset('storage/' . $item->capa) }}" class="w-100 h-100" style="object-fit: cover;" alt="{{ $item->titulo }}">
                            @else
                                <div class="w-100 h-100 d-flex flex-column align-items-center justify-content-center text-dim bg-dark">
                                    <i class="bi bi-disc" style="font-size: 3.5rem;"></i>
                                    <span class="small mt-2 text-uppercase fw-bold">Sem Imagem</span>
                                </div>
                            @endif
                        </div>
                        <div class="card-body d-flex flex-column p-4 bg-dark text-start">
                            <div class="d-flex justify-content-between mb-2">
                                <small class="text-danger fw-black text-uppercase ls-1" style="font-size: 0.75rem;">{{ $item->tipo_midia }}</small>
                                <span class="badge border border-secondary text-dim fw-light small">{{ $item->formato_midia->nome ?? 'Padrão' }}</span>
                            </div>
                            <h5 class="card-title text-white text-uppercase mb-1 fw-black h6 text-truncate">{{ $item->titulo }}</h5>
                            <p class="text-dim mb-4 small text-truncate">{{ $item->artista_diretor }}</p>
                            <div class="mt-auto pt-3 border-top border-secondary border-opacity-25">
                                <a href="{{ route('items.show', $item->id) }}" class="btn btn-outline-warning w-100 text-uppercase fw-black ls-1">Detalhes</a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="p-5 border border-secondary border-dashed rounded-5">
                        <i class="bi bi-search-heart text-warning display-1"></i>
                        <h2 class="mt-4 text-white fw-black">NADA ENCONTRADO!</h2>
                        <p class="text-dim">Tente outros termos ou limpe os filtros.</p>
                        <a href="{{ route('home') }}" class="btn btn-outline-warning btn-lg mt-3 px-5">VER TUDO</a>
                    </div>
                </div>
            @endforelse
        </div>
        
        <div class="d-flex justify-content-center mt-5">
            {{ $items->links() }}
        </div>
    @endif
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');
    
    body { font-family: 'Inter', sans-serif; }
    .fw-black { font-weight: 900; }
    .ls-1 { letter-spacing: 1px; }
    .ls-2 { letter-spacing: 2px; }
    .text-dim { color: #a0a0a0; }
    .tracking-tighter { letter-spacing: -3px; }

    .glass-effect {
        background: rgba(30, 30, 30, 0.8) !important;
        backdrop-filter: blur(10px);
    }

    .btn-punk {
        background-color: #ffcc00;
        color: #000;
        border: none;
        transition: all 0.2s cubic-bezier(0.175, 0.885, 0.32, 1.275);
        box-shadow: 6px 6px 0px #000;
    }

    .btn-punk:hover {
        background-color: #fff;
        transform: translate(-3px, -3px);
        box-shadow: 9px 9px 0px #ff3e3e;
    }

    .card-rock { 
        background: #151515; 
        transition: all 0.4s ease;
        border: 1px solid #252525 !important;
        border-radius: 12px;
        overflow: hidden;
    }

    .card-rock:hover { 
        transform: translateY(-10px) rotate(1deg);
        border-color: #ffcc00 !important;
        box-shadow: 0 20px 40px rgba(0,0,0,0.8);
    }

    .price-badge {
        z-index: 10;
        transform: rotate(3deg);
        border: 2px solid #000;
    }

    .card-img-container img {
        transition: transform 0.5s ease;
    }

    .card-rock:hover .card-img-container img {
        transform: scale(1.1);
    }

    .pagination { 
        --bs-pagination-bg: #111; 
        --bs-pagination-color: #ffcc00; 
        --bs-pagination-active-bg: #ffcc00; 
        --bs-pagination-active-border-color: #ffcc00;
    }
</style>
@endsection