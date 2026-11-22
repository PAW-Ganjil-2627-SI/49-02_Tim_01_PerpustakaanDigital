@extends('layouts.app')

@section('title', 'Edit Data Penerbit')

@section('content')
  <h2>Edit Data Penerbit</h2>

  <div class="form-box">
    <form method="POST" action="{{ route('penerbit.update', $penerbit) }}">
      @csrf
      @method('PUT')

      @include('penerbit._form', ['penerbit' => $penerbit])

      <br><br>
      <input type="submit" value="Update" id="btn-update">
      <a href="{{ route('penerbit.index') }}" class="btn-batal">Batal</a>
    </form>
  </div>

  <p style="margin-top: 20px;">
    <a href="{{ route('penerbit.index') }}" class="button-link">&larr; Kembali ke Daftar Penerbit</a>
  </p>
@endsection
