@extends('layouts.app')

@section('title', 'Detail Penerbit - ' . $penerbit->nama_penerbit)

@section('content')
  <h2>Detail Penerbit dan Supplier</h2>
  <p class="subtitle">Informasi lengkap distributor buku dan kontak sales.</p>

  <div class="detail-card">
    <div class="detail-row">
      <div class="detail-label">Nama Penerbit</div>
      <div><strong>{{ $penerbit->nama_penerbit }}</strong></div>
    </div>
    <div class="detail-row">
      <div class="detail-label">Nama Sales</div>
      <div>{{ $penerbit->nama_sales }}</div>
    </div>
    <div class="detail-row">
      <div class="detail-label">Kontak Sales</div>
      <div>{{ $penerbit->kontak_sales }}</div>
    </div>
    <div class="detail-row">
      <div class="detail-label">Alamat</div>
      <div>{{ $penerbit->alamat }}</div>
    </div>
    <div class="detail-row">
      <div class="detail-label">Wilayah Asal</div>
      <div>
        <span class="badge-wilayah {{ $penerbit->wilayah_asal === 'Internasional' ? 'badge-internasional' : 'badge-nasional' }}">
          {{ $penerbit->wilayah_asal }}
        </span>
      </div>
    </div>
    <div class="detail-row">
      <div class="detail-label">Terdaftar Sejak</div>
      <div>{{ $penerbit->created_at ? $penerbit->created_at->format('d M Y, H:i') : '-' }}</div>
    </div>

    <div class="detail-actions">
      <a href="{{ route('penerbit.index') }}" class="button-link">&larr; Kembali ke Daftar</a>
      @if (auth()->user()?->isAdmin())
        <a href="{{ route('penerbit.edit', $penerbit) }}" class="btn-edit" id="btn-edit-detail-{{ $penerbit->id }}">Edit</a>
        <form action="{{ route('penerbit.destroy', $penerbit) }}" method="POST" class="inline"
              onsubmit="return confirm('Yakin ingin menghapus {{ addslashes($penerbit->nama_penerbit) }}?')">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn-hapus" id="btn-hapus-detail-{{ $penerbit->id }}">Hapus</button>
        </form>
      @endif
    </div>
  </div>
@endsection

