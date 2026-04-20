@extends('layouts.app-layout')

@section('title', 'Categorias')
@section('header_title', 'Editar categoría')

@section('content')

<a href="{{ route('category.index') }}">
    Volver
</a>

<form action="{{ route('category.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <input
            type="text"
            name="name"
            value="{{ old('name', $category->name) }}"
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