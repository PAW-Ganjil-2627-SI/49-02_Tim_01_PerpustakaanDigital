@extends('layouts.app')

@section('title', 'Tambah Data Penerbit')

@section('content')
  <h2>Tambah Data Penerbit</h2>

  <div class="form-box">
    <form method="POST" action="{{ route('penerbit.store') }}">
      @csrf

      @include('penerbit._form')

      <br><br>
      <input type="submit" value="Simpan" id="btn-simpan">
      <a href="{{ route('penerbit.index') }}" class="btn-batal">Batal</a>
    </form>
  </div>

  <p style="margin-top: 20px;">
    <a href="{{ route('penerbit.index') }}" class="button-link">&larr; Kembali ke Daftar Penerbit</a>
  </p>
@endsection
