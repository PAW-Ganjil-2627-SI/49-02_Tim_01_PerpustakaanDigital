@extends('layouts.app')

@section('title', 'Tambah Fasilitas')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/fasilitas-area.css') }}">
@endpush

@section('content')
    <h2>Tambah Fasilitas</h2>

    @include('fasilitas._form', [
        'action'    => route('fasilitas.store'),
        'method'    => 'POST',
        'tombol'    => 'Simpan',
        'fasilitas' => null,
    ])
@endsection
