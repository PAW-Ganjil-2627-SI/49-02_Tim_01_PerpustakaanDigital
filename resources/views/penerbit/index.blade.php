@extends('layouts.app')

@section('title', 'Data Penerbit dan Supplier')

@section('content')
  <h2>Daftar Penerbit dan Supplier</h2>
  <p class="subtitle">Modul Individu C: Pengelolaan data distributor buku, kontak sales, dan wilayah asal.</p>

  <div class="stats-grid">
    <div class="stat-card">
      <div class="stat-label">Total Penerbit</div>
      <div class="stat-value">{{ $statistik['total'] }}</div>
    </div>
    <div class="stat-card">
      <div class="stat-label">Wilayah Nasional</div>
      <div class="stat-value">{{ $statistik['nasional'] }}</div>
    </div>
    <div class="stat-card stat-amber">
      <div class="stat-label">Wilayah Internasional</div>
      <div class="stat-value">{{ $statistik['internasional'] }}</div>
    </div>
  </div>

  @if (! auth()->user()?->isAdmin())
    <div class="alert-info">
      Anda masuk sebagai <strong>User</strong>. Anda dapat mencari, memfilter, dan melihat detail data penerbit. Hanya <strong>Admin</strong> yang dapat menambah, mengubah, atau menghapus data.
    </div>
  @endif

  <div class="toolbar">
    <form method="GET" action="{{ route('penerbit.index') }}" class="filter-form">
      <input type="text" name="q" value="{{ $search }}" placeholder="Cari penerbit, sales, alamat..." aria-label="Cari penerbit">
      <select name="wilayah" aria-label="Filter wilayah">
        <option value="">Semua Wilayah</option>
        <option value="Nasional" @selected($wilayah === 'Nasional')>Nasional</option>
        <option value="Internasional" @selected($wilayah === 'Internasional')>Internasional</option>
      </select>
      <input type="submit" value="Cari">
      @if ($search !== '' || $wilayah !== '')
        <a href="{{ route('penerbit.index') }}" class="btn-batal" style="margin-left: 0;">Reset</a>
      @endif
    </form>

    @if (auth()->user()?->isAdmin())
      <a href="{{ route('penerbit.create') }}" class="button-link" id="btn-tambah">+ Tambah Penerbit Baru</a>
    @endif
  </div>

  <div class="table-wrap">
    <table>
      <tr>
        <th style="width: 50px;">No</th>
        <th>Nama Penerbit</th>
        <th>Nama Sales</th>
        <th>Kontak Sales</th>
        <th>Alamat</th>
        <th>Wilayah Asal</th>
        <th style="width: {{ auth()->user()?->isAdmin() ? '210px' : '100px' }}; text-align: center;">Aksi</th>
      </tr>
      @forelse ($penerbit as $d)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td><strong>{{ $d->nama_penerbit }}</strong></td>
          <td>{{ $d->nama_sales }}</td>
          <td>{{ $d->kontak_sales }}</td>
          <td>{{ $d->alamat }}</td>
          <td>
            <span class="badge-wilayah {{ $d->wilayah_asal === 'Internasional' ? 'badge-internasional' : 'badge-nasional' }}">
              {{ $d->wilayah_asal }}
            </span>
          </td>
          <td style="text-align: center;">
            <div class="action-group">
              <a href="{{ route('penerbit.show', $d) }}" class="btn-detail" id="btn-detail-{{ $d->id }}">Detail</a>
              @if (auth()->user()?->isAdmin())
                <a href="{{ route('penerbit.edit', $d) }}" class="btn-edit" id="btn-edit-{{ $d->id }}">Edit</a>
                <form action="{{ route('penerbit.destroy', $d) }}" method="POST" class="inline"
                      onsubmit="return confirm('Yakin ingin menghapus {{ addslashes($d->nama_penerbit) }}?')">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn-hapus" id="btn-hapus-{{ $d->id }}">Hapus</button>
                </form>
              @endif
            </div>
          </td>
        </tr>
      @empty
        <tr>
          <td colspan="7" style="text-align: center; color: #64748b;">
            {{ $search !== '' || $wilayah !== '' ? 'Data penerbit tidak ditemukan untuk pencarian tersebut.' : 'Belum ada data penerbit.' }}
          </td>
        </tr>
      @endforelse
    </table>
  </div>
@endsection
