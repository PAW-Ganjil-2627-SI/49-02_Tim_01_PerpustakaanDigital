@extends('layouts.app')

@section('title', 'Register - Modul Penerbit & Supplier')

@section('content')
  <div class="form-box auth-box">
    <h2 class="auth-title">Daftar Akun Baru</h2>

    <form method="POST" action="{{ route('register.store') }}">
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

      <label for="name">Nama Lengkap:</label>
      <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap" value="{{ old('name') }}" required autofocus>
      @error('name') <span class="field-error">{{ $message }}</span> @enderror

      <label for="email">Email:</label>
      <input type="email" id="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}" required>
      @error('email') <span class="field-error">{{ $message }}</span> @enderror

      <label for="password">Password:</label>
      <input type="password" id="password" name="password" placeholder="Minimal 6 karakter" required>
      @error('password') <span class="field-error">{{ $message }}</span> @enderror

      <label for="password_confirmation">Konfirmasi Password:</label>
      <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>

      <br><br>
      <input type="submit" value="Daftar" id="btn-register">
      <a href="{{ route('login') }}" class="btn-batal">Sudah punya akun? Login</a>
    </form>
  </div>
@endsection
