<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Perpustakaan Digital')</title>
  <link rel="stylesheet" href="{{ asset('css/gaya.css') }}">
  <style>
    .topbar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 14px 20px;
      background: #ffffff;
      border: 1px solid #dce5f0;
      border-top: 4px solid #0284c7;
      border-radius: 10px;
      box-shadow: 0 4px 12px rgba(15, 23, 42, 0.04);
      margin-bottom: 24px;
      flex-wrap: wrap;
      gap: 12px;
    }
    .topbar-left {
      display: flex;
      align-items: center;
      gap: 18px;
      flex-wrap: wrap;
    }
    .topbar-brand {
      font-weight: 700;
      color: #0369a1;
      text-decoration: none;
      font-size: 16px;
    }
    .topbar-nav {
      display: flex;
      align-items: center;
      gap: 6px;
      flex-wrap: wrap;
    }
    .nav-link {
      text-decoration: none;
      color: #334155;
      font-size: 14px;
      font-weight: 600;
      padding: 6px 12px;
      border-radius: 6px;
      transition: background-color 0.2s ease, color 0.2s ease;
    }
    .nav-link:hover {
      background-color: #e0f2fe;
      color: #0369a1;
    }
    .nav-link.active {
      background-color: #0284c7;
      color: #ffffff;
    }
    .topbar-user {
      display: flex;
      align-items: center;
      gap: 10px;
      font-size: 14px;
      flex-wrap: wrap;
    }
    .badge-role {
      padding: 4px 10px;
      border-radius: 999px;
      font-size: 11px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      color: #ffffff;
    }
    .badge-admin { background-color: #0284c7; }
    .badge-user { background-color: #64748b; }
    .btn-logout {
      background-color: #dc2626;
      color: #ffffff;
      border: none;
      padding: 7px 14px;
      border-radius: 6px;
      cursor: pointer;
      font-size: 13px;
      font-weight: 600;
      font-family: inherit;
      transition: background-color 0.2s ease;
    }
    .btn-logout:hover { background-color: #b91c1c; }
    .alert-success {
      background: #e0f2fe;
      color: #075985;
      border: 1px solid #bae6fd;
      border-left: 4px solid #0284c7;
      padding: 11px 16px;
      border-radius: 6px;
      margin: 12px 0 18px;
      font-size: 14px;
    }
    .alert-error {
      background: #fee2e2;
      color: #991b1b;
      border: 1px solid #fecaca;
      border-left: 4px solid #dc2626;
      padding: 11px 16px;
      border-radius: 6px;
      margin: 12px 0 18px;
      font-size: 14px;
    }
    .alert-info {
      background: #ffffff;
      color: #334155;
      border: 1px solid #cbd5e1;
      border-left: 4px solid #0284c7;
      padding: 12px 16px;
      border-radius: 6px;
      margin: 12px 0 18px;
      font-size: 14px;
    }
    .alert-error ul { margin: 0; padding-left: 20px; }
    .field-error { color: #dc2626; font-size: 13px; margin: -6px 0 10px; display: block; }
    form.inline { display: inline; }
  </style>
  @stack('styles')
</head>
<body>
  <div class="page-container">

    <div class="topbar">
      <div class="topbar-left">
        <a href="{{ route('penerbit.index') }}" class="topbar-brand">Perpustakaan Digital</a>
        @auth
          <nav class="topbar-nav">
            <a href="{{ route('penerbit.index') }}" class="nav-link {{ request()->routeIs('penerbit.*') ? 'active' : '' }}">Penerbit</a>
            <a href="{{ route('fasilitas.index') }}" class="nav-link {{ request()->routeIs('fasilitas.*') ? 'active' : '' }}">Fasilitas</a>
            <a href="{{ route('area.index') }}" class="nav-link {{ request()->routeIs('area.*') ? 'active' : '' }}">Area &amp; Meja</a>
            <a href="{{ route('buku.index') }}" class="nav-link {{ request()->routeIs('buku.*') ? 'active' : '' }}">Buku</a>
            <a href="{{ route('members.index') }}" class="nav-link {{ request()->routeIs('members.*') ? 'active' : '' }}">Anggota</a>
          </nav>
        @endauth
      </div>
      <div class="topbar-user">
        @auth
          <span>Halo, <strong>{{ auth()->user()->name }}</strong></span>
          <span class="badge-role {{ auth()->user()->isAdmin() ? 'badge-admin' : 'badge-user' }}">
            {{ auth()->user()->role }}
          </span>
          <form action="{{ route('logout') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="btn-logout" id="btn-logout">Logout</button>
          </form>
        @else
          <a href="{{ route('login') }}" class="button-link">Login</a>
          <a href="{{ route('register') }}" class="btn-batal" style="margin-left: 0; padding: 9px 16px;">Register</a>
        @endauth
      </div>
    </div>

    @if (session('success'))
      <div class="alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
      <div class="alert-error">{{ session('error') }}</div>
    @endif

    @yield('content')

  </div>
</body>
</html>
