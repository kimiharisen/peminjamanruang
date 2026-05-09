<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Sistem Peminjaman Ruang</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container min-vh-100 d-flex justify-content-center align-items-center">
        <div class="card shadow-sm" style="width: 420px;">
            <div class="card-body">
                <h4 class="mb-3 text-center">Login Sistem</h4>
                <p class="text-muted text-center mb-4">
                    Sistem Peminjaman Ruang dan Peralatan
                </p>

                @if($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login.process') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            class="form-control" 
                            value="{{ old('email') }}"
                            required
                        >
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input 
                            type="password" 
                            name="password" 
                            class="form-control" 
                            required
                        >
                    </div>

                    <button type="submit" class="btn btn-primary w-100">
                        Login
                    </button>
                </form>

                <hr>

                <div class="small text-muted">
                    <strong>Akun Dummy:</strong><br>
                    Admin: admin@example.com / password<br>
                    User: user@example.com / password
                </div>
            </div>
        </div>
    </div>
</body>
</html>