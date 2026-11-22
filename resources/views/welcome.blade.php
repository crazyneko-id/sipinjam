<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SIPINJAM v1.1 — Sistem Peminjaman Alat</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body style="margin: 0; font-family: 'Instrument Sans', system-ui, sans-serif; background-color: #f8fafc; color: #0f172a; min-height: 100vh; display: flex; flex-direction: column; align-items: center; justify-content: center; padding: 1.5rem;">
        <div style="max-width: 480px; width: 100%; background: #ffffff; border: 1px solid #e2e8f0; border-radius: 12px; padding: 2.5rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05); text-align: center;">
            <span style="display: inline-block; background: #eff6ff; color: #1d4ed8; font-size: 0.75rem; font-weight: 600; padding: 0.25rem 0.75rem; border-radius: 9999px; margin-bottom: 1rem;">
                Production Build • v1.1
            </span>
            <h1 style="margin: 0 0 0.5rem 0; font-size: 1.875rem; font-weight: 700; letter-spacing: -0.025em;">
                SIPINJAM v1.1
            </h1>
            <p style="margin: 0 0 2rem 0; color: #475569; font-size: 0.95rem; line-height: 1.5;">
                Sistem Informasi Peminjaman Alat & Inventaris Praktikum. Silakan masuk atau daftar untuk mulai mengelola peminjaman.
            </p>

            @if (Route::has('login'))
                <div style="display: flex; gap: 0.75rem; justify-content: center; flex-wrap: wrap;">
                    @auth
                        <a href="{{ url('/dashboard') }}" style="padding: 0.625rem 1.25rem; background: #0f172a; color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: 500; font-size: 0.875rem;">
                            Buka Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" style="padding: 0.625rem 1.5rem; background: #0f172a; color: #ffffff; text-decoration: none; border-radius: 8px; font-weight: 500; font-size: 0.875rem;">
                            Log in
                        </a>    

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" style="padding: 0.625rem 1.5rem; background: #ffffff; color: #0f172a; border: 1px solid #cbd5e1; text-decoration: none; border-radius: 8px; font-weight: 500; font-size: 0.875rem;">
                                Register
                            </a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>
    </body>
</html>