<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register PPMPP</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inclusive+Sans&family=Jost:wght@500;600;700&family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/register.css'])
</head>
<body>
    <div class="register-container">
        <div class="register-card">
            <div class="register-header">
                <div class="logo">
                    <img
                        src="{{ asset('logo.png') }}"
                        alt="Logo PPMPP">
                    <div>
                        <h1>PPMPP</h1>
                        <p>Pusat Penjaminan Mutu dan Pengembangan Pembelajaran</p>
                    </div>
                </div>
            </div>

            <div class="register-content">
                <h2>Register PPMPP</h2>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input
                            id="name"
                            type="text"
                            class="@error('name') is-invalid @enderror"
                            name="name"
                            value="{{ old('name') }}"
                            required
                            autocomplete="name"
                            autofocus
                            placeholder="Masukkan username"
                        >
                        @error('name')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

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
                            placeholder="Masukkan email"
                        >
                        @error('email')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
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
                            autocomplete="new-password"
                            placeholder="Masukkan password"
                        >
                        @error('password')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm">Konfirmasi Password</label>
                        <input
                            id="password-confirm"
                            type="password"
                            class="@error('password') is-invalid @enderror"
                            name="password_confirmation"
                            required
                            autocomplete="new-password"
                            placeholder="Ulangi password"
                        >
                    </div>

                    <div class="register-bottom">
                        <div class="register-actions">
                            <button type="submit">Register</button>
                                <a href="{{ url('/') }}" class="back-button">Kembali</a>
                        </div>
                                <a href="{{ route('login') }}">Login</a>
                        </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
