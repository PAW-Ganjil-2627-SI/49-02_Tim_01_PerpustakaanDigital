@extends('layouts.app')

@section('title', 'Edit Meja')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/fasilitas-area.css') }}">
@endpush

@section('content')
    <h2>Edit Meja</h2>

    @include('area._form', [
        'action' => route('area.update', $meja),
        'method' => 'PUT',
        'tombol' => 'Perbarui',
    ])
@endsection
