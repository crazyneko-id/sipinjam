<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('judul', 'Sistem Peminjaman Alat')</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand fw-bold" href="{{ route('alat.index') }}">SIPINJAM</a>
      <div class="collapse navbar-collapse show">
        @auth
          <ul class="navbar-nav me-auto">
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('alat.*') ? 'active' : '' }}" href="{{ route('alat.index') }}">Data Alat</a>
            </li>
            <li class="nav-item">
              <a class="nav-link {{ request()->routeIs('peminjaman.*') ? 'active' : '' }}" href="{{ route('peminjaman.index') }}">Data Peminjaman</a>
            </li>
          </ul>
          <div class="d-flex align-items-center gap-3 text-white">
            <span class="small">Halo, <strong>{{ Auth::user()->name }}</strong></span>
            <form method="POST" action="{{ route('logout') }}" class="m-0">
              @csrf
              <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
            </form>
          </div>
        @endauth
      </div>
    </div>
  </nav>

  <div class="container pb-5">
    @yield('konten')
  </div>
</body>
</html>