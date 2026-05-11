@extends('layouts.app-layout')

@section('title', 'Categorías')
@section('header_title', 'Registrar Categoría')

@section('content')
<div class="form-standard-wrapper">
    <div class="form-standard__header">
        <span class="form-standard__title">
            Registrar nueva categoría
        </span>
        <a class="stroke-button info" href="{{ route('category.index') }}">
            Volver
        </a>
    </div>

    <form class="form-standard" action="{{ route('category.store') }}" method="POST">
        @csrf

        <!-- NAME -->
        <div class="form-standard__group">
            <label class="form-standard__label">Nombre de la Categoría</label>
            <input
                class="form-standard__input"
                type="text"
                name="name"
                value="{{ old('name') }}"
                autocomplete="off"
                placeholder="Ej: Electrónica, Ropa, etc.">
            @error('name')
                <span class="form-standard__error">{{ $message }}</span>
            @enderror
        </div>

        <!-- ACTIONS -->
        <div class="form-standard__actions">
            <button class="stroke-button success" type="submit">
                Registrar Categoría
            </button>
        </div>
    </form>
</div>
@endsection