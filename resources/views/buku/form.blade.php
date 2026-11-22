@extends('layouts.app')

@section('title', isset($buku) ? 'Edit Buku' : 'Tambah Buku')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/buku.css') }}">
@endpush

@section('content')
  <div class="form-box buku-form-box">
    <h2>{{ isset($buku) ? 'Form Edit Buku' : 'Form Tambah Buku' }}</h2>

    @if ($errors->any())
      <div class="buku-pesan gagal">
        @foreach ($errors->all() as $error)
          <div>{{ $error }}</div>
        @endforeach
      </div>
    @endif

    <form method="POST"
          action="{{ isset($buku) ? route('buku.update', $buku->id_buku) : route('buku.store') }}">
      @csrf
      @if (isset($buku))
        @method('PUT')
      @endif

      <label for="judul">Judul Buku</label>
      <input type="text" id="judul" name="judul" value="{{ old('judul', $buku->judul ?? '') }}" required>

      <label for="isbn">ISBN</label>
      <input type="text" id="isbn" name="isbn" value="{{ old('isbn', $buku->isbn ?? '') }}" required>

      <label for="tahun_terbit">Tahun Terbit</label>
      <input type="number" id="tahun_terbit" name="tahun_terbit" value="{{ old('tahun_terbit', $buku->tahun_terbit ?? '') }}" required>

      <label for="pengarang">Pengarang</label>
      <input type="text" id="pengarang" name="pengarang" value="{{ old('pengarang', $buku->pengarang ?? '') }}" required>

      <label for="kategori">Kategori</label>
      @php
        $daftar = ['Novel', 'Komik', 'Pendidikan', 'Teknologi', 'Kesehatan', 'Komedi', 'Kartun', 'Kuliner', 'Lainnya'];
        $dipilih = old('kategori', $buku->kategori ?? '');
      @endphp
      <select id="kategori" name="kategori" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach ($daftar as $k)
          <option value="{{ $k }}" {{ $dipilih == $k ? 'selected' : '' }}>{{ $k }}</option>
        @endforeach
      </select>

      <div style="margin-top: 8px;">
        <button type="submit">Simpan</button>
        <a href="{{ route('buku.index') }}" class="btn-batal">Batal / Kembali ke Katalog</a>
      </div>
    </form>
  </div>
@endsection

