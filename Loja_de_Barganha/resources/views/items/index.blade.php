@extends('layouts.app')

@section('content')
<div class="container-fluid px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom border-warning pb-3">
        <div>
            <h2 class="fw-bold text-uppercase m-0">
                <i class="bi bi-box-seam-fill text-warning me-2"></i> 
                CONTROLE DE <span class="text-warning">ESTOQUE</span>
            </h2>
            <p class="text-dim mb-0 small">Gerencie discos, filmes, jogos e raridades do catálogo.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('home') }}" class="btn btn-outline-light btn-lg border-2">
                <i class="bi bi-shop me-1"></i> VER VITRINE
            </a>
            <a href="{{ route('items.create') }}" class="btn btn-punk btn-lg">
                <i class="bi bi-plus-lg me-1"></i> NOVO ITEM
            </a>
        </div>
    </div>

    <div class="card bg-dark border-secondary mb-4 shadow-sm">
        <div class="card-body p-3">
            <form action="{{ route('items.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-text bg-black border-secondary text-warning">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control bg-black text-white border-secondary" 
                               placeholder="Filtrar por título, artista, estúdio ou gênero..." value="{{ $search ?? '' }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-warning w-100 fw-bold border-2">
                        FILTRAR
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card bg-dark border-secondary shadow-lg overflow-hidden">
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0">
                <thead class="bg-black text-warning">
                    <tr class="text-uppercase small border-bottom border-warning">
                        <th class="ps-4 py-3" style="width: 80px;">Capa</th>
                        <th class="py-3">Item / Produtor</th>
                        <th class="py-3">Gênero</th>
                        <th class="py-3">Mídia</th>
                        <th class="py-3 text-end">Preço</th>
                        <th class="py-3 text-center" style="width: 150px;">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        <tr class="border-bottom border-secondary-subtle">
                            <td class="ps-4">
                                @if($item->capa)
                                    <img src="{{ asset('storage/' . $item->capa) }}" class="rounded shadow-sm" style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <div class="bg-black border border-secondary rounded text-center d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                                        <i class="bi bi-image text-dim small"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <span class="fw-bold text-white d-block mb-0">{{ $item->titulo }}</span>
                                <span class="text-warning small text-uppercase" style="font-size: 0.7rem;">
                                    {{ $item->artista_diretor ?? $item->empresa_produtora }}
                                </span>
                            </td>
                            <td>
                                <span class="badge border border-danger text-danger bg-transparent px-2 py-1 small">
                                    {{ $item->categoria->nome }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @php
                                        $icon = 'bi-disc-fill';
                                        if($item->tipo_midia == 'Filme') $icon = 'bi-film';
                                        if($item->tipo_midia == 'Jogo') $icon = 'bi-controller';
                                    @endphp
                                    <i class="bi {{ $icon }} text-dim me-2"></i>
                                    <div>
                                        <span class="d-block small fw-bold text-light">{{ $item->tipo_midia }}</span>
                                        <span class="text-muted extra-small d-block">({{ $item->formato_midia->nome }})</span>
                                    </div>
                                </div>
                            </td>
                            <td class="text-end">
                                <span class="price-tag fs-6">R$ {{ number_format($item->preco, 2, ',', '.') }}</span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm shadow-sm border border-secondary rounded">
                                    <a href="{{ route('items.show', $item->id) }}" class="btn btn-dark text-info" title="Visualizar Detalhes">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-dark text-warning" title="Editar">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Deseja deletar permanentemente este item?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-dark text-danger" title="Excluir">
                                            <i class="bi bi-trash3"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted border-0">
                                <i class="bi bi-archive fs-1 d-block mb-3 opacity-25"></i>
                                <h5 class="fw-bold">Nenhum tesouro encontrado</h5>
                                <p class="small">Tente mudar o filtro ou cadastre uma nova relíquia.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $items->appends(['search' => $search])->links() }}
    </div>
</div>

<style>
    .extra-small { font-size: 0.65rem; letter-spacing: 0.5px; }
    .table-hover tbody tr:hover {
        background-color: rgba(255, 204, 0, 0.03) !important;
    }
    .price-tag {
        color: #ffcc00;
        font-family: 'JetBrains Mono', monospace; /* Ou a fonte que você estiver usando para preços */
        font-weight: bold;
    }
    .btn-group .btn:hover {
        background-color: #1a1a1a;
    }
    .text-dim { color: #666; }
    
    /* Custom pagination styling (opcional) */
    .pagination .page-link {
        background-color: #111;
        border-color: #333;
        color: #ffcc00;
    }
    .pagination .page-item.active .page-link {
        background-color: #ffcc00;
        border-color: #ffcc00;
        color: #000;
    }
</style>
@endsection