@extends('layouts.app')

@section('title', '403 - Akses Ditolak')

@section('content')
  <div class="alert-error">
    <h2 style="margin-top: 0;">403 | Akses Ditolak</h2>
    <p>{{ $exception->getMessage() ?: 'Anda tidak memiliki hak akses untuk fitur ini.' }}</p>
    <p>Fitur tambah, edit, dan hapus data penerbit hanya dapat diakses oleh pengguna dengan role <strong>Admin</strong>.</p>
  </div>

  <p style="margin-top: 15px;">
    <a href="{{ route('penerbit.index') }}" class="button-link">&larr; Kembali ke Daftar Penerbit</a>
  </p>
@endsection

