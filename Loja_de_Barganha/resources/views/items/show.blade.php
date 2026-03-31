@extends('layouts.app')

@section('content')
<div class="container py-5">
    <a href="{{ route('home') }}" class="btn btn-outline-warning mb-4 fw-bold shadow-sm border-2">
        <i class="bi bi-arrow-left"></i> VOLTAR PARA A VITRINE
    </a>

    @php
        // Verifica se já existe um interesse registrado para este item (por IP ou Usuário)
        $interesseExistente = \App\Models\Interest::where('item_id', $item->id)
            ->where(function($q) {
                $q->where('user_id', auth()->id())
                  ->orWhere('ip_address', request()->ip());
            })
            ->where('status', 'pendente')
            ->first();
    @endphp

    <div class="row g-5">
        <div class="col-md-6">
            <div class="card bg-black border-secondary p-2 shadow-lg card-rock rounded-3 overflow-hidden">
                @if($item->capa)
                    <img src="{{ asset('storage/' . $item->capa) }}" class="img-fluid w-100 rounded" alt="{{ $item->titulo }}" style="filter: contrast(1.05);">
                @else
                    <div class="bg-dark d-flex flex-column align-items-center justify-content-center" style="min-height: 500px;">
                        <i class="bi bi-vinyl text-secondary display-1 mb-3"></i>
                        <span class="text-dim text-uppercase fw-bold">Sem Capa Disponível</span>
                    </div>
                @endif
            </div>
            
            @if($item->descricao)
            <div class="mt-4 p-4 bg-dark border-start border-warning border-4 rounded-end shadow">
                <h5 class="text-warning text-uppercase small fw-black mb-2">Nota do Garimpeiro:</h5>
                <p class="text-white mb-0 italic" style="font-style: italic; opacity: 0.9;">
                    "{{ $item->descricao }}"
                </p>
            </div>
            @endif
        </div>

        <div class="col-md-6">
            <div class="ps-md-4">
                <div class="mb-3 d-flex flex-wrap gap-2">
                    <span class="badge bg-danger fs-6 text-uppercase px-3 shadow-sm">{{ $item->categoria->nome }}</span>
                    <span class="badge border border-warning text-warning fs-6 px-3 shadow-sm">
                        @php
                            $icon = 'bi-disc-fill';
                            if($item->tipo_midia == 'Filme') $icon = 'bi-film';
                            if($item->tipo_midia == 'Jogo') $icon = 'bi-controller';
                        @endphp
                        <i class="bi {{ $icon }} me-1"></i>
                        {{ $item->tipo_midia }}
                    </span>
                </div>

                <h1 class="display-3 fw-bold text-white mb-1 text-uppercase ls-tight">{{ $item->titulo }}</h1>
                
                <div class="mb-4">
                    <h3 class="text-warning opacity-75 mb-0">{{ $item->artista_diretor }}</h3>
                    @if($item->empresa_produtora)
                        <span class="text-dim text-uppercase small fw-bold">
                            <i class="bi bi-building me-1"></i>{{ $item->empresa_produtora }}
                        </span>
                    @endif
                </div>

                <div class="price-tag display-4 mb-4 text-white fw-bold" style="font-family: 'Courier New', Courier, monospace;">
                    <span class="text-warning">R$</span> {{ number_format($item->preco, 2, ',', '.') }}
                </div>

                <div class="card bg-dark border-secondary p-4 mb-4 shadow">
                    <h5 class="text-white border-bottom border-secondary pb-2 mb-3 text-uppercase small tracking-widest">
                        <i class="bi bi-info-square me-2 text-warning"></i>Especificações do Item
                    </h5>
                    <div class="row">
                        <div class="col-6 mb-3">
                            <label class="text-dim small d-block text-uppercase">Formato de Mídia</label>
                            <span class="fw-bold text-white fs-5">{{ $item->formato_midia->nome }}</span>
                        </div>
                        <div class="col-6 mb-3">
                            <label class="text-dim small d-block text-uppercase">Versão/Edição</label>
                            <span class="fw-bold text-white fs-5 text-truncate d-block">{{ $item->formato ?? 'Padrão' }}</span>
                        </div>
                        
                        @if($item->elenco_detalhes)
                        <div class="col-12 mb-3">
                            <label class="text-dim small d-block text-uppercase">
                                {{ $item->tipo_midia == 'Filme' ? 'Elenco' : ($item->tipo_midia == 'Jogo' ? 'Plataforma' : 'Faixas') }}
                            </label>
                            <span class="text-white small">{{ $item->elenco_detalhes }}</span>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="d-grid gap-3">
                    @if(!$interesseExistente)
                        {{-- CASO NÃO TENHA INTERESSE: MOSTRA BOTÃO DE REGISTRO --}}
                        <form action="{{ route('interests.store', $item->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-punk btn-lg py-3 fs-4 shadow-sm w-100 fw-bold">
                                <i class="bi bi-cart-plus-fill me-2"></i> TENHO INTERESSE
                            </button>
                        </form>
                    @else
                        {{-- CASO JÁ TENHA INTERESSE: MOSTRA STATUS E LIBERA WHATSAPP --}}
                        <div class="p-3 bg-black border border-danger rounded shadow-sm text-center">
                            <h5 class="text-danger fw-bold text-uppercase mb-1">
                                <i class="bi bi-lightning-charge-fill me-2"></i> Interesse Registrado!
                            </h5>
                            <p class="text-dim small mb-3">Status: <span class="badge bg-danger-soft text-danger border border-danger">PENDENTE</span></p>
                            
                            <a href="https://wa.me/554999999999?text={{ urlencode('Salve! Já registrei meu interesse no site pelo item: ' . $item->titulo . '. Podemos negociar?') }}" 
                               target="_blank" 
                               class="btn btn-success btn-lg py-3 fw-bold shadow-sm w-100">
                                <i class="bi bi-whatsapp me-2"></i> CHAMAR NO WHATSAPP
                            </a>
                        </div>
                    @endif
                </div>

                <div class="mt-4 p-3 border-start border-warning bg-black shadow-sm">
                    <p class="mb-0 small text-dim">
                        <i class="bi bi-shield-lock me-2 text-warning"></i>
                        @if(!$interesseExistente)
                            Ao clicar em <strong>"Tenho Interesse"</strong>, o item será reservado na sua Central de Leads.
                        @else
                            Seu lead já está na nossa <strong>Central</strong>. Clique acima para agilizar pelo WhatsApp.
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .text-dim { color: #888; }
    .ls-tight { letter-spacing: -1.5px; }
    .card-rock { transition: all 0.3s ease; border-width: 2px !important; }
    .card-rock:hover { transform: scale(1.01); border-color: #ffcc00 !important; }
    .bg-danger-soft { background-color: rgba(220, 53, 69, 0.15); }
    
    .btn-punk {
        background-color: #ffcc00;
        color: #000;
        border: none;
        box-shadow: 5px 5px 0px #000;
        transition: all 0.2s;
        text-transform: uppercase;
    }
    .btn-punk:hover {
        background-color: #fff;
        transform: translate(-3px, -3px);
        box-shadow: 8px 8px 0px #ffcc00;
    }
</style>
@endsection