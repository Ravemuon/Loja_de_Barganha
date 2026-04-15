@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            {{-- Card com estilo Rock/Punk: Borda grossa e sem arredondamento --}}
            <div class="card bg-dark shadow-lg border-5" style="border-color: var(--punk-yellow); border-style: solid; border-radius: 0;">
                
                <div class="card-header border-secondary p-4 bg-black">
                    <h2 class="fw-bold text-uppercase mb-0" style="font-family: 'Permanent Marker', cursive; color: var(--punk-yellow); letter-spacing: 2px;">
                        <i class="bi bi-pencil-square me-2"></i>Editar Coleção
                    </h2>
                    <p class="text-dim small mb-0 mt-2 text-uppercase fw-bold">Alterando os registros do submundo</p>
                </div>

                <div class="card-body p-4 p-lg-5">
                    <form action="{{ route('categories.update', $category->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="form-label text-white fw-bold text-uppercase" style="letter-spacing: 1px;">
                                Nome da Categoria
                            </label>
                            {{-- Input preto com foco amarelo --}}
                            <input type="text" name="nome" 
                                   class="form-control form-control-lg bg-black border-secondary text-white rounded-0 @error('nome') border-danger @enderror" 
                                   value="{{ old('nome', $category->nome) }}" 
                                   style="box-shadow: none;"
                                   required>
                            
                            @error('nome')
                                <div class="text-danger fw-bold mt-2 small text-uppercase">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center mt-5">
                            <a href="{{ route('categories.index') }}" class="text-white opacity-50 text-decoration-none fw-bold text-uppercase small hover-warning">
                                <i class="bi bi-arrow-left me-1"></i> Desistir
                            </a>
                            
                            {{-- Botão Punk Estilizado --}}
                            <button type="submit" class="btn btn-punk px-5 py-2 shadow border-0">
                                ATUALIZAR AGORA
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Detalhe estético extra abaixo do card --}}
            <div class="mt-4 text-center">
                <p class="text-dim small opacity-25 text-uppercase fw-bold" style="letter-spacing: 3px;">
                    Chapecó Underground Scene <i class="bi bi-vinyl ms-1"></i>
                </p>
            </div>
        </div>
    </div>
</div>

<style>
    /* Efeito de foco personalizado para os inputs do tema */
    .form-control:focus {
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
</style>
@endsection