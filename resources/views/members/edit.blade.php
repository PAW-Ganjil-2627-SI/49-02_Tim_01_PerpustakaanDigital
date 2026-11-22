@extends('layouts.app')

@section('title', 'Edit Anggota')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/members.css') }}">
@endpush

@section('content')
  <div class="form-box">
    <h2>Edit Data Anggota</h2>

    @if ($errors->any())
      <div class="alert-error">
        <ul>
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('members.update', $member->id) }}" method="POST">
      @csrf
      @method('PUT')

      <label for="nomor_kartu">Nomor Kartu</label>
      <input type="text" id="nomor_kartu" name="nomor_kartu" value="{{ old('nomor_kartu', $member->nomor_kartu) }}" required>

      <label for="nama">Nama Lengkap</label>
      <input type="text" id="nama" name="nama" value="{{ old('nama', $member->nama) }}" required>

      <label for="tipe_keanggotaan">Tipe Keanggotaan</label>
      <select id="tipe_keanggotaan" name="tipe_keanggotaan" required>
        @foreach (['Mahasiswa', 'Dosen', 'Umum'] as $tipe)
          <option value="{{ $tipe }}" @selected(old('tipe_keanggotaan', $member->tipe_keanggotaan) === $tipe)>{{ $tipe }}</option>
        @endforeach
      </select>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" value="{{ old('email', $member->email) }}" required>

      <label for="no_hp">No. HP</label>
      <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp', $member->no_hp) }}" required>

      <label for="alamat">Alamat</label>
      <input type="text" id="alamat" name="alamat" value="{{ old('alamat', $member->alamat) }}" required>

      <div style="margin-top: 8px;">
        <input type="submit" value="Update">
        <a href="{{ route('members.index') }}" class="btn-batal">Batal</a>
      </div>
    </form>
  </div>
@endsection
