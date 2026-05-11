@extends('layouts.guest-layout')

@section('title', 'Espinoza S.A.C.')

@section('content')
<div class="auth">
    <div class="auth__container">
        <div class="auth-grid">
            <div class="auth-card">
                <div class="auth-card__header">
                    <h1 class="auth-card__title">Bienvenido</h1>
                    <p class="auth-card__subtitle">Ingresa tus credenciales para continuar</p>
                </div>
                <form action="{{ route('auth.login.store') }}" method="POST" class="auth-form">
                    @csrf
                    <div class="auth-form__group">
                        <label class="auth-form__label">Correo Electrónico</label>
                        <input type="email" name="email" class="auth-form__input" required>
                    </div>
                    <div class="auth-form__group">
                        <label class="auth-form__label">Contraseña</label>
                        <input type="password" name="password" class="auth-form__input" required>
                    </div>
                    <button type="submit" class="auth-form__button">
                        Iniciar Sesión
                    </button>
                </form>
            </div>
            <div class="auth-3d">
                <div id="scene-container"></div>
            </div>
        </div>
    </div>
</div>
@endsection