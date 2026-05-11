@extends('layouts.app-layout')

@section('title', 'Roles')
@section('header_title', 'Gestión de roles')

@section('content')
<div class="kpis">
    <article class="kpi-card kpi-card--total">
        <div class="kpi-card__icon">
            <i data-lucide="shield-check"></i>
        </div>
        <div class="kpi-card__content">
            <h3 class="kpi-card__title">Total Roles</h3>
            <p class="kpi-card__value">{{ $stats['total'] ?? 0 }}</p>
        </div>
    </article>
    <article class="kpi-card kpi-card--active">
        <div class="kpi-card__icon">
            <i data-lucide="check-circle"></i>
        </div>
        <div class="kpi-card__content">
            <h3 class="kpi-card__title">Roles Activos</h3>
            <p class="kpi-card__value">{{ $stats['activos'] ?? 0 }}</p>
        </div>
    </article>
    <article class="kpi-card kpi-card--inactive">
        <div class="kpi-card__icon">
            <i data-lucide="x-circle"></i>
        </div>
        <div class="kpi-card__content">
            <h3 class="kpi-card__title">Roles Inactivos</h3>
            <p class="kpi-card__value">{{ $stats['inactivos'] ?? 0 }}</p>
        </div>
    </article>
</div>



@if(empty($roles))
<p>No hay registros disponibles</p>
@else


<div class="data_table-horizontal">
    <div class="data-table-horizontal__header">
        <span class="data-table-horizontal__title">
            Lista de registros
        </span>
        <a class="stroke-button success" href="{{ route('role.create') }}">
            <i data-lucide="plus"></i>
            Nuevo Rol
        </a>
    </div>
    <div class="data-table-horizontal__body">
        <table class="data-table-horizontal__table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($roles as $role)
                <tr>
                    <td>{{ $role->id }}</td>
                    <td>{{ $role->name }}</td>
                    <td>
                        <x-status :value="$role->status" />
                    </td>
                    <td>
                        <a class="stroke-button info" href="{{ route('role.show', $role->id) }}">
                            Detalles
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif

@endsection