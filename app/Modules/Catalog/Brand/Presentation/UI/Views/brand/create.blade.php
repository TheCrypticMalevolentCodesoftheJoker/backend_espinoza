@extends('layouts.app-layout')

@section('title', 'Marcas')
@section('header_title', 'Registrar nueva marca')

@section('content')

<a href="{{ route('brand.index') }}">
    Volver
</a>

<form class="brand-form" action="{{ route('brand.store') }}" method="POST">
    @csrf

    <div class="brand-form__group">
        <input
            class="brand-form__input"
            type="text"
            name="name"
            value="{{ old('name') }}"
            autocomplete="off"
            placeholder="Nombre">
    </div>

    @error('name')
    <div>{{ $message }}</div>
    @enderror

    <x-buttons.strokeButton class="brand-form__button" type="submit" variant="success">
        Registrar
    </x-buttons.strokeButton>
</form>

@endsection