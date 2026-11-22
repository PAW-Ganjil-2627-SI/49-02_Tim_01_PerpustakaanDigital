@extends('layouts.app')

@section('title', isset($penerbit) && $penerbit->exists ? 'Edit Data Penerbit' : 'Tambah Penerbit')

@section('content')
  <h2>{{ isset($penerbit) && $penerbit->exists ? 'Edit Data Penerbit' : 'Form Tambah Penerbit' }}</h2>

  <div class="form-box">
    <form method="POST" action="{{ isset($penerbit) && $penerbit->exists ? route('penerbit.update', $penerbit) : route('penerbit.store') }}">
      @csrf
      @if (isset($penerbit) && $penerbit->exists)
        @method('PUT')
      @endif

      @if ($errors->any())
        <div class="alert-error">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <label for="nama">Nama Penerbit:</label>
      <input type="text" id="nama" name="nama_penerbit" placeholder="Masukan Nama" maxlength="150"
             value="{{ old('nama_penerbit', $penerbit->nama_penerbit ?? '') }}" required>
      @error('nama_penerbit') <span class="field-error">{{ $message }}</span> @enderror

      <label for="namasales">Nama Sales:</label>
      <input type="text" id="namasales" name="nama_sales" placeholder="Masukan Nama Sales" maxlength="100"
             value="{{ old('nama_sales', $penerbit->nama_sales ?? '') }}" required>
      @error('nama_sales') <span class="field-error">{{ $message }}</span> @enderror

      <label for="sales">Kontak Sales:</label>
      <input class="Kontak" type="tel" id="sales" name="kontak_sales" placeholder="Masukan Kontak" maxlength="50"
             value="{{ old('kontak_sales', $penerbit->kontak_sales ?? '') }}" required>
      @error('kontak_sales') <span class="field-error">{{ $message }}</span> @enderror

      <label for="alamat">Alamat:</label>
      <textarea id="alamat" name="alamat" rows="3" placeholder="Masukan Alamat" required>{{ old('alamat', $penerbit->alamat ?? '') }}</textarea>
      @error('alamat') <span class="field-error">{{ $message }}</span> @enderror

      @php($wilayah = old('wilayah_asal', $penerbit->wilayah_asal ?? 'Nasional'))
      <label for="wilayah">Wilayah Asal:</label>
      <select id="wilayah" name="wilayah_asal">
        <option value="Nasional" @selected($wilayah === 'Nasional')>Nasional</option>
        <option value="Internasional" @selected($wilayah === 'Internasional')>Internasional</option>
      </select>
      @error('wilayah_asal') <span class="field-error">{{ $message }}</span> @enderror

      <br><br>
      <input type="submit" value="{{ isset($penerbit) && $penerbit->exists ? 'Update' : 'Simpan' }}" id="{{ isset($penerbit) && $penerbit->exists ? 'btn-update' : 'btn-simpan' }}">
      <a href="{{ route('penerbit.index') }}" class="btn-batal">Batal</a>
    </form>
  </div>

  <p style="margin-top: 20px;">
    <a href="{{ route('penerbit.index') }}" class="button-link">&larr; Kembali ke Daftar Penerbit</a>
  </p>
@endsection
