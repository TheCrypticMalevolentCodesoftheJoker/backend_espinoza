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

<section class="category-form-section">

    <a class="category-form__link" href="{{ route('category.index') }}">
        Volver
    </a>

    <form class="category-form" action="{{ route('category.store') }}" method="POST">
        @csrf

        <div class="category-form__group">
            <input
                class="category-form__input"
                type="text"
                name="name"
                value="{{ old('name') }}"
                autocomplete="off"
                placeholder="Nombre">
        </div>

        @error('name')
        <div class="category-form__error">
            {{ $message }}
        </div>
        @enderror

        @error('domain')
        <div class="category-form__error">
            <strong>Errores de dominio</strong>
            {{ $message }}
        </div>
        @enderror

        <div class="category-form__actions">
            <x-buttons.strokeButton class="category-form__button" type="submit" variant="success">
                Registrar
            </x-buttons.strokeButton>
        </div>

    </form>

</section>

@endsection