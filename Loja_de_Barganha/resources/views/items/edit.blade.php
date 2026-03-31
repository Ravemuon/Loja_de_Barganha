@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-11">
        <div class="d-flex align-items-center mb-4 border-bottom border-warning pb-3">
            <h2 class="fw-bold text-uppercase m-0 text-white">
                <i class="bi bi-pencil-square text-warning me-2"></i> 
                EDITAR <span class="text-warning">REGISTRO</span>
            </h2>
        </div>

        <div class="card bg-dark border-secondary shadow-lg">
            <div class="card-body p-4 p-md-5">
                <form action="{{ route('items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-7">
                            <div class="mb-4">
                                <label class="form-label text-warning fw-bold small">TÍTULO DA RELÍQUIA</label>
                                <input type="text" name="titulo" class="form-control form-control-lg bg-black text-white border-secondary @error('titulo') is-invalid @enderror" 
                                       value="{{ old('titulo', $item->titulo) }}" required>
                                @error('titulo') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-warning fw-bold small">ARTISTA / DIRETOR</label>
                                    <input type="text" name="artista_diretor" class="form-control bg-black text-white border-secondary" 
                                           value="{{ old('artista_diretor', $item->artista_diretor) }}" required>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label text-warning fw-bold small">GRAVADORA / ESTÚDIO / DEV</label>
                                    <input type="text" name="empresa_produtora" class="form-control bg-black text-white border-secondary" 
                                           value="{{ old('empresa_produtora', $item->empresa_produtora) }}">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-4">
                                    <label class="form-label text-warning fw-bold small">PREÇO (R$)</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-black border-secondary text-warning fw-bold">R$</span>
                                        <input type="number" step="0.01" name="preco" class="form-control bg-black text-white border-secondary" 
                                               value="{{ old('preco', $item->preco) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label text-warning fw-bold small">TIPO DE CONTEÚDO</label>
                                    <select name="tipo_midia" class="form-select bg-black text-white border-secondary">
                                        <option value="Música" {{ $item->tipo_midia == 'Música' ? 'selected' : '' }}>🎵 Música</option>
                                        <option value="Filme" {{ $item->tipo_midia == 'Filme' ? 'selected' : '' }}>🎬 Filme</option>
                                        <option value="Jogo" {{ $item->tipo_midia == 'Jogo' ? 'selected' : '' }}>🎮 Jogo</option>
                                    </select>
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label text-warning fw-bold small">FORMATO BASE</label>
                                    <select name="media_format_id" class="form-select bg-black text-white border-secondary">
                                        @foreach($formats as $format)
                                            <option value="{{ $format->id }}" {{ $item->media_format_id == $format->id ? 'selected' : '' }}>
                                                {{ $format->nome }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="mb-4">
                                <label class="form-label text-warning fw-bold small">GÊNERO / CATEGORIA</label>
                                <select name="category_id" class="form-select bg-black text-white border-secondary">
                                    @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $item->category_id == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->nome }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-5 ps-md-5 text-center">
                            <label class="form-label text-warning fw-bold d-block text-start small">CAPA ATUAL / NOVA</label>
                            
                            <div class="border border-secondary mb-3 bg-black rounded shadow-inner" style="height: 280px; overflow: hidden; border-style: dashed !important;">
                                @if($item->capa)
                                    <img id="image-preview" src="{{ asset('storage/' . $item->capa) }}" class="img-fluid w-100 h-100" style="object-fit: contain;">
                                @else
                                    <div id="no-img-placeholder" class="h-100 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-vinyl text-secondary display-1"></i>
                                    </div>
                                    <img id="image-preview" src="#" class="img-fluid d-none w-100 h-100" style="object-fit: contain;">
                                @endif
                            </div>

                            <input type="file" name="capa" id="capa-input" class="form-control bg-black text-white border-secondary @error('capa') is-invalid @enderror" accept="image/*">
                            <p class="text-dim small mt-2 text-start">
                                <i class="bi bi-info-circle me-1"></i> Selecione um arquivo apenas se desejar substituir a capa.
                            </p>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4 mb-4">
                            <label class="form-label text-warning fw-bold small">VERSÃO / EDIÇÃO</label>
                            <input type="text" name="formato" class="form-control bg-black text-white border-secondary" 
                                   value="{{ old('formato', $item->formato) }}" placeholder="Ex: Japonês, 180g, Deluxe...">
                        </div>
                        <div class="col-md-4 mb-4">
                            <label class="form-label text-warning fw-bold small">ELENCO / DETALHES TÉCNICOS</label>
                            <textarea name="elenco_detalhes" class="form-control bg-black text-white border-secondary" rows="3">{{ old('elenco_detalhes', $item->elenco_detalhes) }}</textarea>
                        </div>
                        <div class="col-md-4 mb-4">
                            <label class="form-label text-warning fw-bold small">NOTA DO GARIMPEIRO (DESCRIÇÃO)</label>
                            <textarea name="descricao" class="form-control bg-black text-white border-secondary" rows="3">{{ old('descricao', $item->descricao) }}</textarea>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center border-top border-secondary pt-4 mt-3">
                        <a href="{{ route('items.index') }}" class="text-white text-decoration-none fw-bold opacity-75 hover-opacity-100">
                            <i class="bi bi-arrow-left me-1"></i> CANCELAR
                        </a>
                        <button type="submit" class="btn btn-punk btn-lg px-5 shadow">
                            <i class="bi bi-save2-fill me-1"></i> SALVAR ALTERAÇÕES
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
            const placeholder = document.getElementById('no-img-placeholder');
            
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
            if(placeholder) placeholder.classList.add('d-none');
        }
    }
</script>

<style>
    .bg-black { background-color: #000 !important; }
    .text-dim { color: #888; }
    .form-control:focus, .form-select:focus {
        background-color: #000 !important;
        border-color: #ffcc00 !important;
        color: #fff !important;
        box-shadow: 0 0 0 0.25rem rgba(255, 204, 0, 0.15);
    }
    .hover-opacity-100:hover { opacity: 1 !important; }
</style>
@endsection