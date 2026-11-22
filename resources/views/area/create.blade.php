@extends('layouts.app')

@section('title', 'Tambah Meja')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/fasilitas-area.css') }}">
@endpush

@section('content')
    <h2>Tambah Meja</h2>

    @include('area._form', [
        'action' => route('area.store'),
        'method' => 'POST',
        'tombol' => 'Simpan',
        'meja'   => null,
    ])
@endsection
