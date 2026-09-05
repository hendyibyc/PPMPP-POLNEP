<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login PPMPP</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inclusive+Sans&family=Jost:wght@500;600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/login.css'])
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <div class="logo">
                    <img src="{{ asset('logo.png') }}" alt="Logo PPMPP">
                    <div>
                        <h1>PPMPP</h1>
                        <p>Pusat Penjaminan Mutu dan Pengembangan Pembelajaran</p>
                    </div>
                </div>
            </div>

            <div class="login-content">
                <h2>Login PPMPP</h2>
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input
                            id="email"
                            type="email"
                            class="@error('email') is-invalid @enderror"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autocomplete="email"
                            autofocus
                            placeholder="Masukkan email"
                        >
                        @error('email')
                            <span class="error-message">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input
                            id="password"
                            type="password"
                            class="@error('password') is-invalid @enderror"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="Masukkan password"
                        >
                        @error('password')
                            <span class="error-message">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                    <div class="login-bottom">
                        <div class="login-actions">
                            <button type="submit">Login</button>
                                <a href="{{ url('/') }}" class="back-button">   Kembali</a>
                        </div>
                        @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
