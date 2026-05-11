@extends('layouts.app-layout')

@section('title', 'Marcas')
@section('header_title', 'Registrar Marca')

@section('content')
<div class="form-standard-wrapper">
    <div class="form-standard__header">
        <span class="form-standard__title">
            Registrar nueva marca
        </span>
        <a class="stroke-button info" href="{{ route('brand.index') }}">
            Volver
        </a>
    </div>

    <form class="form-standard" action="{{ route('brand.store') }}" method="POST">
        @csrf

        <!-- NAME -->
        <div class="form-standard__group">
            <label class="form-standard__label">Nombre de la Marca</label>
            <input
                class="form-standard__input"
                type="text"
                name="name"
                value="{{ old('name') }}"
                autocomplete="off"
                placeholder="Ej: Samsung, Nike, etc.">
            @error('name')
                <span class="form-standard__error">{{ $message }}</span>
            @enderror
        </div>

        <!-- ACTIONS -->
        <div class="form-standard__actions">
            <button class="stroke-button success" type="submit">
                Registrar Marca
            </button>
        </div>
    </form>
</div>
@endsection