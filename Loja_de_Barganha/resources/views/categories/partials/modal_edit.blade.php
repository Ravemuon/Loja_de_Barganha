<div class="modal fade" id="modalEdit{{ $category->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-dark border-warning text-white">
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf @method('PUT')
                <div class="modal-header border-secondary">
                    <h5 class="modal-title fw-bold text-warning">EDITAR: {{ strtoupper($category->nome) }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label class="mb-2 text-dim small fw-bold">NOME DA CATEGORIA</label>
                    <input type="text" name="nome" class="form-control bg-black text-white border-secondary" value="{{ $category->nome }}" required>
                </div>
                <div class="modal-footer border-secondary">
                    <button type="submit" class="btn btn-punk">SALVAR ALTERAÇÕES</button>
                </div>
            </form>
        </div>
    </div>
</div>