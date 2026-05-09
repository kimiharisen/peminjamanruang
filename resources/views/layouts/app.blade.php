<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Sistem Peminjaman Ruang' }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    @auth
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="{{ route('dashboard') }}">
                    Peminjaman Ruang
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('peminjams.index') }}">Peminjam</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('ruangs.index') }}">Ruang</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('peralatans.index') }}">Peralatan</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('peminjamans.index') }}">Peminjaman</a>
                        </li>

                        @if(auth()->user()->isAdmin())
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('reports.peminjaman.csv') }}">Export CSV</a>
                            </li>
                        @endif
                    </ul>

                    <div class="d-flex align-items-center text-white">
                        <span class="me-3">
                            {{ auth()->user()->name }} 
                            <span class="badge bg-secondary">{{ auth()->user()->role }}</span>
                        </span>

                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="btn btn-outline-light btn-sm" type="submit">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
    @endauth

    <main class="container py-4">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <strong>Terjadi kesalahan input:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>