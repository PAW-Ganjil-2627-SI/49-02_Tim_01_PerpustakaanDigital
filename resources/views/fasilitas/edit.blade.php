@extends('layouts.app')

@section('title', 'Edit Fasilitas')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/fasilitas-area.css') }}">
@endpush

@section('content')
    <h2>Edit Fasilitas</h2>

    @include('fasilitas._form', [
        'action'    => route('fasilitas.update', $fasilitas),
        'method'    => 'PUT',
        'tombol'    => 'Perbarui',
        'fasilitas' => $fasilitas,
    ])
@endsection
