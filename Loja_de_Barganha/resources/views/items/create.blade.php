@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-11">
        <div class="d-flex align-items-center mb-4 border-bottom border-warning pb-3">
            <h2 class="fw-bold text-uppercase m-0">
                <i class="bi bi-plus-square-fill text-warning me-2"></i> 
                CADASTRAR NOVO <span class="text-warning">TESOURO</span>
            </h2>
        </div>

        <div class="card bg-dark border-secondary shadow-lg">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('items.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-7">
                            <div class="mb-4">
                                <label class="form-label text-warning fw-bold small">TÍTULO DA RELÍQUIA</label>
                                <input type="text" name="titulo" class="form-control form-control-lg bg-black text-white border-secondary @error('titulo') is-invalid @enderror" 
                                       placeholder="Ex: Nevermind, Resident Evil 2, O Auto da Compadecida..." value="{{ old('titulo') }}" required>
                                @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-warning fw-bold small">ARTISTA / DIRETOR</label>
                                    <input type="text" name="artista_diretor" class="form-control bg-black text-white border-secondary" 
                                           placeholder="Ex: Nirvana / Guel Arraes" value="{{ old('artista_diretor') }}">
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-warning fw-bold small">GRAVADORA / ESTÚDIO / DEV</label>
                                    <input type="text" name="empresa_produtora" class="form-control bg-black text-white border-secondary" 
                                           placeholder="Ex: Geffen, Nintendo, O2 Filmes" value="{{ old('empresa_produtora') }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label class="form-label text-warning fw-bold small">PREÇO (R$)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-black border-secondary text-warning fw-bold">R$</span>
                                        <input type="number" step="0.01" name="preco" class="form-control bg-black text-white border-secondary" value="{{ old('preco') }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label text-warning fw-bold small">TIPO DE CONTEÚDO</label>
                                    <select name="tipo_midia" class="form-select bg-black text-white border-secondary" required>
                                        <option value="Música" {{ old('tipo_midia') == 'Música' ? 'selected' : '' }}>🎵 Música</option>
                                        <option value="Filme" {{ old('tipo_midia') == 'Filme' ? 'selected' : '' }}>🎬 Filme</option>
                                        <option value="Jogo" {{ old('tipo_midia') == 'Jogo' ? 'selected' : '' }}>🎮 Jogo</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label text-warning fw-bold small">FORMATO BASE</label>
                                    <select name="media_format_id" class="form-select bg-black text-white border-secondary" required>
                                        @foreach($formats as $format)
                                            <option value="{{ $format->id }}" {{ old('media_format_id') == $format->id ? 'selected' : '' }}>
                                                {{ $format->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-warning fw-bold small">GÊNERO / CATEGORIA</label>
                                <select name="category_id" class="form-select bg-black text-white border-secondary" required>
                                    <option value="">Selecione uma categoria...</option>
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-5 ps-md-5">
                            <div class="mb-4 text-center">
                                <label class="form-label text-warning fw-bold d-block text-start small">CAPA DO ITEM</label>
                                <div id="image-preview-container" class="border border-secondary mb-3 d-flex align-items-center justify-content-center bg-black rounded shadow-inner" 
                                     style="height: 280px; position: relative; overflow: hidden; border-style: dashed !important;">
                                    <i class="bi bi-clouds-fill text-secondary display-1" id="placeholder-icon"></i>
                                    <img id="image-preview" src="#" alt="Preview" class="img-fluid d-none" style="object-fit: contain; width: 100%; height: 100%;">
                                </div>
                                <input type="file" name="capa" id="capa-input" class="form-control bg-black text-white border-secondary @error('capa') is-invalid @enderror" accept="image/*">
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-warning fw-bold small">VERSÃO / EDIÇÃO</label>
                                <input type="text" name="formato" class="form-control bg-black text-white border-secondary" 
                                       placeholder="Ex: Japonês, 180g, Deluxe, Black Label..." value="{{ old('formato') }}">
                            </div>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6 mb-4">
                            <label class="form-label text-warning fw-bold small">ELENCO / DETALHES TÉCNICOS</label>
                            <textarea name="elenco_detalhes" class="form-control bg-black text-white border-secondary" rows="3" 
                                      placeholder="Atores, integrantes da banda ou specs do jogo...">{{ old('elenco_detalhes') }}</textarea>
                        </div>
                        <div class="col-md-6 mb-4">
                            <label class="form-label text-warning fw-bold small">NOTA DO GARIMPEIRO (DESCRIÇÃO)</label>
                            <textarea name="descricao" class="form-control bg-black text-white border-secondary" rows="3" 
                                      placeholder="Descreva o estado de conservação ou curiosidades sobre o item...">{{ old('descricao') }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center border-top border-secondary pt-4 mt-2">
                        <a href="{{ route('items.index') }}" class="text-white text-decoration-none fw-bold opacity-75 hover-opacity-100">
                            <i class="bi bi-arrow-left me-1"></i> CANCELAR
                        </a>
                        <button type="submit" class="btn btn-punk btn-lg px-5">
                            <i class="bi bi-lightning-fill me-1"></i> SALVAR NO ESTOQUE
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('capa-input').onchange = evt => {
        const [file] = evt.target.files
        if (file) {
            const preview = document.getElementById('image-preview');
            const icon = document.getElementById('placeholder-icon');
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
            icon.classList.add('d-none');
        }
    }
</script>

<style>
    .form-control:focus, .form-select:focus {
        background-color: #000 !important;
        border-color: #ffcc00 !important;
        color: #fff !important;
        box-shadow: 0 0 0 0.25rem rgba(255, 204, 0, 0.15);
    }
    .hover-opacity-100:hover { opacity: 1 !important; }
</style>
@endsection