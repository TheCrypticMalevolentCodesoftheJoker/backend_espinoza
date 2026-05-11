@extends('layouts.app-layout')

@section('title', 'Usuarios')
@section('header_title', 'Editar Usuario')

@section('content')
<div class="form-standard-wrapper">
    <div class="form-standard__header">
        <span class="form-standard__title">
            Editar usuario: {{ $user->name }}
        </span>
        <a class="stroke-button info" href="{{ route('user.index') }}">
            Volver
        </a>
    </div>

    <form class="form-standard" action="{{ route('user.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <!-- ROLE -->
        <div class="form-standard__group">
            <label class="form-standard__label">Rol del Usuario</label>
            <select name="roleId" class="form-standard__input select">
                <option value="">Seleccione un rol</option>
                @foreach($roles as $role)
                <option value="{{ $role->id }}" {{ old('roleId', $user->roleId) == $role->id ? 'selected' : '' }}>
                    {{ $role->name }}
                </option>
                @endforeach
            </select>
            @error('roleId')
            <span class="form-standard__error">{{ $message }}</span>
            @enderror
        </div>

        <!-- NAME -->
        <div class="form-standard__group">
            <label class="form-standard__label">Nombre Completo</label>
            <input
                class="form-standard__input"
                type="text"
                name="name"
                value="{{ old('name', $user->name) }}"
                autocomplete="off"
                placeholder="Ej: Juan Pérez">
            @error('name')
            <span class="form-standard__error">{{ $message }}</span>
            @enderror
        </div>

        <!-- EMAIL -->
        <div class="form-standard__group">
            <label class="form-standard__label">Correo Electrónico</label>
            <input
                class="form-standard__input"
                type="email"
                name="email"
                value="{{ old('email', $user->email) }}"
                autocomplete="off"
                placeholder="Ej: juan.perez@empresa.com">
            @error('email')
            <span class="form-standard__error">{{ $message }}</span>
            @enderror
        </div>

        <!-- PASSWORD -->
        <div class="form-standard__group">
            <label class="form-standard__label">Nueva Contraseña</label>
            <input
                class="form-standard__input"
                type="password"
                name="password"
                autocomplete="new-password"
                placeholder="Dejar vacío para mantener la actual">
            @error('password')
            <span class="form-standard__error">{{ $message }}</span>
            @enderror
        </div>

        <!-- ACTIONS -->
        <div class="form-standard__actions">
            <button class="stroke-button success" type="submit">
                Actualizar Usuario
            </button>
        </div>
    </form>
</div>
@endsection