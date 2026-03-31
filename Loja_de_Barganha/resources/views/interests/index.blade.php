@extends('layouts.app')

@section('content')
<div class="container-fluid px-md-4">
    <div class="d-flex justify-content-between align-items-center mb-4 border-bottom border-danger pb-3">
        <div>
            <h2 class="fw-bold text-uppercase m-0 text-white">
                <i class="bi bi-lightning-charge-fill text-danger me-2"></i> 
                @if(auth()->user()->is_admin)
                    CENTRAL DE <span class="text-danger">LEADS</span>
                @else
                    MEUS <span class="text-danger">INTERESSES</span>
                @endif
            </h2>
            <p class="text-dim mb-0 small border-start border-danger border-3 ps-3">
                {{ auth()->user()->is_admin ? 'Gerencie as intenções de compra e barganhas do estoque.' : 'Acompanhe seus pedidos e negociações em aberto.' }}
            </p>
        </div>
        
        <div class="d-flex gap-3">
            <div class="bg-dark border border-secondary px-3 py-1 rounded shadow-sm text-center">
                <small class="text-dim d-block text-uppercase extra-small">Total</small>
                <span class="fw-bold text-white">{{ $interests->total() }}</span>
            </div>
            @if(auth()->user()->is_admin)
            <div class="bg-dark border border-danger px-3 py-1 rounded shadow-sm text-center">
                <small class="text-danger d-block text-uppercase extra-small">Pendentes</small>
                <span class="fw-bold text-danger">
                    {{ $interests->where('status', 'pendente')->count() }}
                </span>
            </div>
            @endif
        </div>
    </div>

    <div class="card bg-dark border-secondary mb-4 shadow-sm">
        <div class="card-body p-3">
            <form action="{{ route('interests.index') }}" method="GET" class="row g-2 align-items-center">
                <div class="col-md-10">
                    <div class="input-group">
                        <span class="input-group-text bg-black border-secondary text-danger">
                            <i class="bi bi-funnel-fill"></i>
                        </span>
                        <input type="text" name="search" class="form-control bg-black text-white border-secondary" 
                               placeholder="Filtrar por título, artista ou diretor..." value="{{ $search ?? '' }}">
                    </div>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-outline-danger w-100 fw-bold border-2">
                        BUSCAR
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card bg-dark border-secondary shadow-lg overflow-hidden">
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0">
                <thead class="bg-black text-danger">
                    <tr class="text-uppercase small border-bottom border-danger">
                        <th class="ps-4 py-3">Momento</th>
                        <th class="py-3">Item Desejado</th>
                        @if(auth()->user()->is_admin)
                            <th class="py-3">Interessado</th>
                        @endif
                        <th class="py-3 text-center">Status</th>
                        <th class="py-3 text-end">Valor</th>
                        <th class="py-3 text-center">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($interests as $interest)
                        <tr class="border-bottom border-secondary-subtle">
                            <td class="ps-4">
                                <span class="text-white d-block fw-bold small">{{ $interest->created_at->format('d/m/Y') }}</span>
                                <small class="text-muted extra-small">{{ $interest->created_at->format('H:i') }}h</small>
                            </td>
                            <td>
                                <div class="d-flex align-items-center">
                                    @if($interest->item->capa)
                                        <img src="{{ asset('storage/' . $interest->item->capa) }}" class="rounded me-3 border border-secondary" style="width: 40px; height: 40px; object-fit: cover;">
                                    @else
                                        <div class="bg-black rounded border border-secondary me-3 d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                            <i class="bi bi-vinyl text-dim small"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <span class="text-white d-block mb-0 fw-bold small">{{ $interest->item->titulo }}</span>
                                        <span class="text-danger extra-small text-uppercase">{{ $interest->item->artista_diretor }}</span>
                                    </div>
                                </div>
                            </td>
                            @if(auth()->user()->is_admin)
                            <td>
                                <span class="text-white small d-block">{{ $interest->user->name ?? 'Visitante' }}</span>
                                <small class="text-dim extra-small">{{ $interest->ip_address }}</small>
                            </td>
                            @endif
                            <td class="text-center">
                                @if($interest->status == 'pendente')
                                    <span class="badge bg-danger-soft text-danger border border-danger extra-small px-2">AGUARDANDO</span>
                                @else
                                    <span class="badge bg-success-soft text-success border border-success extra-small px-2">FINALIZADO</span>
                                @endif
                            </td>
                            <td class="text-end">
                                <span class="price-tag small text-white fw-bold">R$ {{ number_format($interest->item->preco, 2, ',', '.') }}</span>
                            </td>
                            <td class="text-center">
                                <div class="btn-group btn-group-sm border border-secondary rounded">
                                    <a href="{{ route('items.show', $interest->item->id) }}" class="btn btn-dark text-info" title="Ver Item">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    @php
                                        $whatsMsg = "Salve! Tenho interesse no item: " . $interest->item->titulo;
                                        $whatsPhone = auth()->user()->is_admin ? ($interest->user->phone ?? '554999999999') : '554999999999';
                                    @endphp
                                    <a href="https://wa.me/{{ $whatsPhone }}?text={{ urlencode($whatsMsg) }}" 
                                       target="_blank" class="btn btn-dark text-success" title="Chamar no WhatsApp">
                                        <i class="bi bi-whatsapp"></i>
                                    </a>

                                    <form action="{{ route('interests.destroy', $interest->id) }}" method="POST" onsubmit="return confirm('Deseja cancelar este pedido?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-dark text-danger" title="Cancelar">
                                            <i class="bi bi-x-circle"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ auth()->user()->is_admin ? '6' : '5' }}" class="text-center py-5 text-muted border-0">
                                <i class="bi bi-radar fs-1 d-block mb-3 opacity-25"></i>
                                <h5 class="fw-bold">Nenhum rastro detectado</h5>
                                <p class="small">Os interesses aparecerão aqui conforme as interações na vitrine.</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if(auth()->user()->is_admin)
    <div class="mt-5 border-top border-secondary pt-4">
        <h5 class="text-white fw-bold text-uppercase mb-3">
            <i class="bi bi-lightbulb-fill text-warning me-2"></i> 
            Insights para <span class="text-warning">Informatics & Zoo</span>
        </h5>
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card bg-black border-secondary h-100">
                    <div class="card-body">
                        <small class="text-warning text-uppercase fw-bold d-block mb-2">Tendência Rural-Sim</small>
                        <p class="extra-small text-dim mb-0">Com base nos seus estudos de <strong>Zootecnia</strong>, mídias de simulação e manejo sustentável convertem rápido em Chapecó.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-black border-secondary h-100">
                    <div class="card-body">
                        <small class="text-warning text-uppercase fw-bold d-block mb-2">Dev & Sound</small>
                        <p class="extra-small text-dim mb-0">Como <strong>Técnica em Informática</strong>, você pode focar em trilhas sonoras de games retrô para atrair o público tech local.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card bg-black border-secondary h-100">
                    <div class="card-body">
                        <small class="text-warning text-uppercase fw-bold d-block mb-2">Foco Regional</small>
                        <p class="extra-small text-dim mb-0">Leads de <strong>Chapecó-SC</strong> fecham negócio 40% mais rápido. Priorize contatos locais para entrega em mãos.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

    <div class="d-flex justify-content-center mt-4 pb-5">
        {{ $interests->appends(['search' => $search])->links() }}
    </div>
</div>

<style>
    .extra-small { font-size: 0.7rem; }
    .price-tag { font-family: 'JetBrains Mono', monospace; letter-spacing: -0.5px; }
    .bg-danger-soft { background-color: rgba(220, 53, 69, 0.1); }
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
    .table-hover tbody tr:hover {
        background-color: rgba(220, 53, 69, 0.02) !important;
    }
    .text-dim { color: #777; }
</style>
@endsection