@extends('layouts.app')

@section('title', 'Anggota & Kartu Perpustakaan')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/members.css') }}">
@endpush

@section('content')
  <h2>Modul Anggota &amp; Kartu Perpustakaan</h2>
  <p class="subtitle">
    Kelola data anggota perpustakaan dan cetak kartu anggota digital.
  </p>

  @if ($errors->any())
    <div class="alert-error">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @if (auth()->user()->isAdmin())
    <div class="member-form-card">
      <div class="member-form-header">Tambah Anggota Baru</div>
      <div class="member-form-body">
        <form action="{{ route('members.store') }}" method="POST">
          @csrf
          <div class="member-form-grid">
            <div>
              <label for="nomor_kartu">Nomor Kartu</label>
              <input type="text" id="nomor_kartu" name="nomor_kartu" value="{{ old('nomor_kartu') }}" placeholder="Contoh: LIB-2026001" required>
            </div>
            <div>
              <label for="nama">Nama Lengkap</label>
              <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required>
            </div>
            <div>
              <label for="tipe_keanggotaan">Tipe Keanggotaan</label>
              <select id="tipe_keanggotaan" name="tipe_keanggotaan" required>
                @foreach (['Mahasiswa', 'Dosen', 'Umum'] as $tipe)
                  <option value="{{ $tipe }}" @selected(old('tipe_keanggotaan') === $tipe)>{{ $tipe }}</option>
                @endforeach
              </select>
            </div>
            <div>
              <label for="email">Email</label>
              <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>
            <div>
              <label for="no_hp">No. HP</label>
              <input type="text" id="no_hp" name="no_hp" value="{{ old('no_hp') }}" required>
            </div>
            <div>
              <label for="alamat">Alamat</label>
              <input type="text" id="alamat" name="alamat" value="{{ old('alamat') }}" required>
            </div>
          </div>
          <button type="submit" class="member-submit">Simpan Anggota</button>
        </form>
      </div>
    </div>
  @endif

  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>No. Kartu</th>
          <th>Nama</th>
          <th>Tipe</th>
          <th>Email / No. HP</th>
          <th>Alamat</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($members as $member)
          <tr>
            <td><strong>{{ $member->nomor_kartu }}</strong></td>
            <td>{{ $member->nama }}</td>
            <td><span class="badge-tipe">{{ $member->tipe_keanggotaan }}</span></td>
            <td>
              {{ $member->email }}<br>
              <span class="text-muted-sm">{{ $member->no_hp }}</span>
            </td>
            <td>{{ $member->alamat }}</td>
            <td>
              <div class="action-group">
                <a href="{{ route('members.card', $member->id) }}" target="_blank" class="btn-detail">Cetak ID Card</a>
                @if (auth()->user()->isAdmin())
                  <a href="{{ route('members.edit', $member->id) }}" class="btn-edit">Edit</a>
                  <form action="{{ route('members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Hapus anggota ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-hapus">Hapus</button>
                  </form>
                @endif
              </div>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="6" style="text-align: center;">Belum ada data anggota.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection
