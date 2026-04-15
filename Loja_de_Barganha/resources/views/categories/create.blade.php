@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            {{-- Card com borda grossa amarela: Estilo Pôster Underground --}}
            <div class="card bg-dark shadow-lg border-5" style="border-color: var(--punk-yellow); border-style: solid; border-radius: 0;">
                
                <div class="card-header border-secondary p-4 bg-black">
                    <h2 class="fw-bold text-uppercase mb-0" style="font-family: 'Permanent Marker', cursive; color: var(--punk-yellow); letter-spacing: 2px;">
                        <i class="bi bi-plus-circle-fill me-2"></i>Nova Coleção
                    </h2>
                    <p class="text-dim small mb-0 mt-2 text-uppercase fw-bold">Expandindo o arsenal da Barganha</p>
                </div>

                <div class="card-body p-4 p-lg-5">
                    <form action="{{ route('categories.store') }}" method="POST">
                        @csrf

                        {{-- Nome da Categoria --}}
                        <div class="mb-4">
                            <label class="form-label text-white fw-bold text-uppercase" style="letter-spacing: 1px;">
                                Nome da Categoria
                            </label>
                            <input type="text" name="nome" 
                                   class="form-control form-control-lg bg-black border-secondary text-white rounded-0 @error('nome') border-danger @enderror" 
                                   placeholder="Ex: Vinil Hardcore, VHS Horror..." 
                                   value="{{ old('nome') }}" 
                                   required>
                            @error('nome')
                                <div class="text-danger fw-bold mt-2 small text-uppercase">
                                    <i class="bi bi-exclamation-octagon-fill me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Tipo de Mídia --}}
                        <div class="mb-4">
                            <label class="form-label text-white fw-bold text-uppercase" style="letter-spacing: 1px;">
                                Tipo de Mídia Principal
                            </label>
                            <select name="tipo_midia" class="form-select form-select-lg bg-black border-secondary text-white rounded-0 @error('tipo_midia') border-danger @enderror" required>
                                <option value="" selected disabled>Selecione o tipo...</option>
                                <option value="Música" {{ old('tipo_midia') == 'Música' ? 'selected' : '' }}>Música (Vinil, CD, K7)</option>
                                <option value="Jogo" {{ old('tipo_midia') == 'Jogo' ? 'selected' : '' }}>Jogos (Retro, Consoles)</option>
                                <option value="Filme" {{ old('tipo_midia') == 'Filme' ? 'selected' : '' }}>Cinema (VHS, DVD, Blu-ray)</option>
                                <option value="Outro" {{ old('tipo_midia') == 'Outro' ? 'selected' : '' }}>Outros Artefatos</option>
                            </select>
                        </div>

                        {{-- Ícone do Bootstrap --}}
                        <div class="mb-4">
                            <label class="form-label text-white fw-bold text-uppercase" style="letter-spacing: 1px;">
                                Ícone (Bootstrap Icons)
                            </label>
                            <div class="input-group">
                                <span class="input-group-text bg-black border-secondary text-warning rounded-0"><i class="bi bi-search"></i></span>
                                <input type="text" name="icone" 
                                       class="form-control form-control-lg bg-black border-secondary text-white rounded-0 @error('icone') border-danger @enderror" 
                                       placeholder="Ex: bi-vinyl-fill" 
                                       value="{{ old('icone', 'bi-tag') }}" 
                                       required>
                            </div>
                            <div class="form-text text-dim mt-2">
                                Escolha um nome em <a href="https://icons.getbootstrap.com/" target="_blank" class="text-warning text-decoration-none fw-bold">icons.getbootstrap.com <i class="bi bi-box-arrow-up-right small"></i></a>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <a href="{{ route('categories.index') }}" class="text-white opacity-50 text-decoration-none fw-bold text-uppercase small hover-warning">
                                <i class="bi bi-chevron-left me-1"></i> Voltar
                            </a>
                            
                            <button type="submit" class="btn btn-punk px-5 py-2 shadow border-0">
                                CRIAR AGORA
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Elemento decorativo inferior --}}
            <div class="mt-4 text-center">
                <p class="text-dim small opacity-25 text-uppercase fw-bold" style="letter-spacing: 3px;">
                    Chapecó · SC · MMXV <i class="bi bi-lightning-fill ms-1"></i>
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    /* Consistência de foco nos inputs e selects */
    .form-control:focus, .form-select:focus {
        background-color: #000 !important;
        border-color: var(--punk-yellow) !important;
        color: #fff !important;
        box-shadow: 8px 8px 0px rgba(255, 204, 0, 0.2) !important;
    }

    .hover-warning:hover {
        color: var(--punk-yellow) !important;
        opacity: 1 !important;
        transition: 0.3s;
    }
    
    /* Estilizando o select para combinar com o fundo preto */
    select option {
        background: #000;
        color: #fff;
    }
</style>
@endsection