<div class="modal fade" id="modalCreateCategory" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark border-warning text-white">
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="modal-header border-secondary">
                    <h5 class="modal-title fw-bold text-warning">ADICIONAR NOVA CATEGORIA</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="mb-2 text-dim small fw-bold text-uppercase">Nome da Categoria</label>
                    <input type="text" name="nome" class="form-control bg-black text-white border-secondary" placeholder="Ex: Death Metal, Retrogames..." required>
                    <p class="mt-2 text-dim x-small italic text-muted">* O ícone será definido automaticamente pelo nome.</p>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="submit" class="btn btn-punk w-100">CRIAR AGORA</button>
                </div>
            </form>
        </div>
    </div>
</div>