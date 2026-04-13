@extends('layouts.app-layout')

@section('title', 'Categorias')
@section('header_title', 'Registrar nueva categoria')

@section('content')

@if (session('alert'))
<x-alerts.toast
    :variant="session('alert')['variant']"
    :code="session('alert')['code']"
    :message="session('alert')['message']" />
@endif

<a href="{{ route('category.index') }}">Volver</a>

<form action="{{ route('category.store') }}" method="POST">
    @csrf
    <input
        type="text"
        name="name"
        value="{{ old('name') }}"
        autocomplete="off"
        placeholder="Nombre">

    @error('name')
    <div class="text-red-500">
        {{ $message }}
    </div>
    @enderror

    @error('domain')
    <div class="text-red-500">
        <strong>Errores de dominio</strong>
        {{ $message }}
    </div>
    @enderror

    <x-buttons.strokeButton type="submit" variant="success">
        Registrar
    </x-buttons.strokeButton>

</form>

@endsection