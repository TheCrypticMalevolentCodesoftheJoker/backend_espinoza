@extends('layouts.app-layout')

@section('title', 'Roles')
@section('header_title', 'Registrar Rol')

@section('content')
<div class="form-standard-wrapper">
    <div class="form-standard__header">
        <span class="form-standard__title">
            Registrar nuevo rol
        </span>
        <a class="stroke-button info" href="{{ route('role.index') }}">
            Volver
        </a>
    </div>

    <form class="form-standard" action="{{ route('role.store') }}" method="POST">
        @csrf

        <!-- NAME -->
        <div class="form-standard__group">
            <label class="form-standard__label">Nombre</label>

            <input
                class="form-standard__input"
                type="text"
                name="name"
                value="{{ old('name') }}"
                autocomplete="off"
                placeholder="Ej: Administrador">

            @error('name')
            <span class="form-standard__error">{{ $message }}</span>
            @enderror
        </div>

        <!-- DESCRIPTION -->
        <div class="form-standard__group">
            <label class="form-standard__label">Descripción</label>

            <textarea
                class="form-standard__input form-standard__textarea"
                name="description"
                placeholder="Ej: Acceso total al sistema">{{ old('description') }}</textarea>

            @error('description')
            <span class="form-standard__error">{{ $message }}</span>
            @enderror
        </div>

        <!-- BUTTON -->
        <div class="form-standard__actions">
            <button class="stroke-button success" type="submit">
                Registrar
            </button>
        </div>

    </form>
</div>

@endsection