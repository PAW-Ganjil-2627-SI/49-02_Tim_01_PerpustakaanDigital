@extends('layouts.app')

@section('title', 'Login - Modul Penerbit & Supplier')

@section('content')
  <div class="form-box auth-box">
    <h2 class="auth-title">Login Sistem Perpustakaan</h2>

    <form method="POST" action="{{ route('login.attempt') }}">
      @csrf

      @if ($errors->any())
        <div class="alert-error">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}" required autofocus>
      @error('email') <span class="field-error">{{ $message }}</span> @enderror

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Masukkan password" required>
      @error('password') <span class="field-error">{{ $message }}</span> @enderror

      <label style="display: flex; align-items: center; gap: 8px; margin: 6px 0 16px; font-weight: 500; cursor: pointer;">
        <input type="checkbox" name="remember" value="1"> Ingat saya
      </label>

      <input type="submit" value="Login" id="btn-login">
      <a href="{{ route('register') }}" class="btn-batal">Daftar Akun</a>
    </form>
  </div>

  <div class="alert-info auth-info">
    <strong>Akun Pengujian (Seeder):</strong><br>
    Admin: <code>admin@perpustakaan.com</code> / Password: <code>102022500050</code><br>
    User: <code>user@perpustakaan.com</code> / Password: <code>102022500050</code>
  </div>
@endsection
