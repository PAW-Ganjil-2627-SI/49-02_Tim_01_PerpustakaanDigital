@extends('layouts.app')

@section('title', 'Katalog Buku')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/buku.css') }}">
@endpush

@section('content')
  <h2>Katalog Buku</h2>
  <p class="subtitle">
    Daftar master data buku perpustakaan yang mencakup judul, nomor ISBN, tahun terbit, pengarang, dan kategori.
  </p>

  @if (session('sukses'))
    <div class="buku-pesan sukses">{{ session('sukses') }}</div>
  @endif

  <div class="buku-stats">
    <div class="buku-stat-card buku-stat-pink">
      <div class="buku-stat-label">Total Buku</div>
      <div class="buku-stat-value">{{ $total }}</div>
    </div>
    <div class="buku-stat-card buku-stat-green">
      <div class="buku-stat-label">Pengarang</div>
      <div class="buku-stat-value">{{ $pengarang }}</div>
    </div>
    <div class="buku-stat-card buku-stat-cyan">
      <div class="buku-stat-label">Kategori</div>
      <div class="buku-stat-value">{{ $kategori }}</div>
    </div>
    <div class="buku-stat-card buku-stat-amber">
      <div class="buku-stat-label">Tahun Terbaru</div>
      <div class="buku-stat-value">{{ $tahunTerbaru ?? '-' }}</div>
    </div>
  </div>

  @if (auth()->user()->isAdmin())
    <div class="toolbar">
      <a href="{{ route('buku.create') }}" class="button-link">+ Tambah Buku</a>
    </div>
  @endif

  <div class="table-wrap">
    <table>
      <thead>
        <tr>
          <th>No</th>
          <th>Judul Buku</th>
          <th>ISBN</th>
          <th>Tahun Terbit</th>
          <th>Pengarang</th>
          <th>Kategori</th>
          @if (auth()->user()->isAdmin())
            <th>Aksi</th>
          @endif
        </tr>
      </thead>
      <tbody>
        @forelse ($buku as $b)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $b->judul }}</td>
            <td>{{ $b->isbn }}</td>
            <td>{{ $b->tahun_terbit }}</td>
            <td>{{ $b->pengarang }}</td>
            <td>{{ $b->kategori }}</td>
            @if (auth()->user()->isAdmin())
              <td>
                <div class="action-group">
                  <a href="{{ route('buku.edit', $b->id_buku) }}" class="btn-edit">Edit</a>
                  <form action="{{ route('buku.destroy', $b->id_buku) }}" method="POST"
                        onsubmit="return confirm('Yakin hapus buku ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-hapus">Hapus</button>
                  </form>
                </div>
              </td>
            @endif
          </tr>
        @empty
          <tr>
            <td colspan="{{ auth()->user()->isAdmin() ? 7 : 6 }}" style="text-align: center;">Belum ada data buku.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>
@endsection

