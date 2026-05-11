@extends('layouts.app-layout')

@section('title', 'Usuarios')
@section('header_title', 'Gestión de Usuarios')

@section('content')

{{-- SECCION DE INDICADORES (KPIs) --}}
<div class="kpis">
    <div class="kpi-card kpi-card--total">
        <div class="kpi-card__icon">
            <i data-lucide="users"></i>
        </div>
        <div class="kpi-card__content">
            <span class="kpi-card__title">Total Usuarios</span>
            <h3 class="kpi-card__value">{{ $stats['total'] }}</h3>
        </div>
    </div>

    <div class="kpi-card kpi-card--active">
        <div class="kpi-card__icon">
            <i data-lucide="user-check"></i>
        </div>
        <div class="kpi-card__content">
            <span class="kpi-card__title">Usuarios Activos</span>
            <h3 class="kpi-card__value">{{ $stats['activos'] }}</h3>
        </div>
    </div>

    <div class="kpi-card kpi-card--inactive">
        <div class="kpi-card__icon">
            <i data-lucide="user-minus"></i>
        </div>
        <div class="kpi-card__content">
            <span class="kpi-card__title">Usuarios Inactivos</span>
            <h3 class="kpi-card__value">{{ $stats['inactivos'] }}</h3>
        </div>
    </div>
</div>

{{-- TABLA DE DATOS --}}
<div class="data_table-horizontal">
    <div class="data-table-horizontal__header">
        <span class="data-table-horizontal__title">
            Listado de Usuarios
        </span>

        <a class="stroke-button info" href="{{ route('user.create') }}">
            <i data-lucide="plus"></i>
            Nuevo Usuario
        </a>
    </div>

    <div class="data-table-horizontal__body">
        @if(empty($users))
            <p class="no-data">No hay registros disponibles</p>
        @else
            <table class="data-table-horizontal__table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Rol</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Estado</th>
                        <th width="120">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->roleName }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <x-status :value="$user->status" />
                            </td>
                            <td>
                                <a class="stroke-button info" href="{{ route('user.show', $user->id) }}">
                                    Detalles
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

@endsection