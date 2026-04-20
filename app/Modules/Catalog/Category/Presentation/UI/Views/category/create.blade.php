@extends('layouts.app-layout')

@section('title', 'Categorias')
@section('header_title', 'Registrar nueva categoria')

@section('content')

<a class="" href="{{ route('category.index') }}">
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
    <div>
        {{ $message }}
    </div>
    @enderror
    <x-buttons.strokeButton class="category-form__button" type="submit" variant="success">
        Registrar
    </x-buttons.strokeButton>
</form>


@endsection