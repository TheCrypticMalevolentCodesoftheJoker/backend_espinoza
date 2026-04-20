@extends('layouts.app-layout')

@section('title', 'Marcas')
@section('header_title', 'Editar marca')

@section('content')

<a href="{{ route('brand.index') }}">
    Volver
</a>

<form action="{{ route('brand.update', $brand->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <input
            type="text"
            name="name"
            value="{{ old('name', $brand->name) }}"
            autocomplete="off"
            placeholder="Nombre">
    </div>

    @error('name')
    <div>{{ $message }}</div>
    @enderror

    <button type="submit">
        Actualizar
    </button>
</form>

@endsection