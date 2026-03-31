<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BARGANHA | Rock, MPB & Cinema</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Permanent+Marker&family=Roboto+Condensed:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --bg-dark: #0a0a0a;
            --card-gray: #1e1e1e;
            --punk-yellow: #ffcc00;
            --rock-red: #ff3e3e;
            --text-light: #f4f4f4;
            --text-dim: #b0b0b0;
        }

        body {
            background-color: var(--bg-dark);
            color: var(--text-light);
            font-family: 'Roboto Condensed', sans-serif;
            background-image: url('https://www.transparenttextures.com/patterns/stardust.png');
        }

        /* Navbar com Imagem de Fundo Estilizada */
        .navbar {
            background-image: linear-gradient(rgba(0,0,0,0.7), rgba(0,0,0,0.7)), 
                              url('https://images.unsplash.com/photo-1514525253361-bee8718a34e1?auto=format&fit=crop&q=60&w=1200');
            background-size: cover;
            background-position: center;
            border-bottom: 5px solid var(--punk-yellow);
            padding: 1.5rem 0;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }

        .navbar-brand {
            font-family: 'Permanent Marker', cursive;
            font-size: 2.2rem;
            color: var(--punk-yellow) !important;
            text-shadow: 3px 3px 0px #000;
        }

        .nav-link {
            color: #fff !important;
            text-transform: uppercase;
            font-weight: 700;
            letter-spacing: 1px;
            margin: 0 10px;
        }

        .nav-link:hover {
            color: var(--punk-yellow) !important;
            transform: scale(1.1);
        }

        /* Estilo dos Cards (Vitrine) */
        .card-rock {
            background-color: var(--card-gray);
            border: 2px solid #333;
            transition: all 0.3s ease;
            border-radius: 0;
        }

        .card-rock:hover {
            border-color: var(--punk-yellow);
            transform: rotate(-1deg) scale(1.02);
            box-shadow: 10px 10px 0px var(--punk-yellow);
        }

        .card-rock img {
            border-bottom: 4px solid var(--punk-yellow);
            filter: sepia(30%) contrast(1.1);
        }

        .price-tag {
            font-family: 'Permanent Marker', cursive;
            color: var(--punk-yellow);
            font-size: 1.5rem;
        }

        /* Admin UI */
        .admin-table {
            background: #111;
            border: 1px solid #333;
            color: #fff;
        }

        .btn-punk {
            background-color: var(--punk-yellow);
            color: #000;
            font-weight: 900;
            border-radius: 0;
            border: none;
            text-transform: uppercase;
        }

        .btn-punk:hover { background-color: #fff; color: #000; }

        .text-dim { color: var(--text-dim) !important; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark mb-5 border-bottom border-secondary shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}">
            <i class="bi bi-vinyl-fill me-2 text-warning"></i>BARGANHA
        </a>
        
        <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <div class="navbar-nav ms-auto align-items-center">
                <a class="nav-link px-3" href="{{ route('home') }}">
                    <i class="bi bi-house-door me-1"></i> Vitrine
                </a>
                <a class="nav-link px-3" href="{{ route('categories.index') }}">
                    <i class="bi bi-tags me-1"></i> Categorias
                </a>
                
                @auth
                    <a class="nav-link px-3 text-warning fw-bold" href="{{ route('items.index') }}">
                        <i class="bi bi-database-fill-gear me-1"></i> Estoque
                    </a>

                    <a class="nav-link px-3 text-danger fw-bold" href="{{ route('interests.index') }}">
                        <i class="bi bi-heart-fill me-1"></i> Interesses
                    </a>

                    <form action="{{ route('logout') }}" method="POST" class="d-inline ms-3">
                        @csrf
                        <button class="btn btn-outline-light btn-sm fw-bold px-3 text-uppercase" style="letter-spacing: 1px;">
                            Sair <i class="bi bi-box-arrow-right ms-1"></i>
                        </button>
                    </form>
                @else
                    <a class="nav-link px-3 border border-secondary rounded-pill ms-lg-3" href="{{ route('login') }}">
                        <i class="bi bi-person-fill me-1"></i> Entrar
                    </a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-warning border-0 rounded-0 shadow fw-bold">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    @yield('content')
</div>

<footer class="text-center py-5 mt-5 border-top border-dark">
    <p class="text-dim">© 2026 LOJA DE BARGANHA | <i class="bi bi-lightning-charge-fill text-warning"></i> Underground Life</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>