@extends('layouts.app-layout')

@section('title', 'Categorías')
@section('header_title', 'Gestión de Categorías')

@section('content')

{{-- SECCION DE INDICADORES (KPIs) --}}
<div class="kpis">
    <div class="kpi-card kpi-card--total">
        <div class="kpi-card__icon">
            <i data-lucide="layers"></i>
        </div>
        <div class="kpi-card__content">
            <span class="kpi-card__title">Total Categorías</span>
            <h3 class="kpi-card__value">{{ $stats['total'] }}</h3>
        </div>
    </div>

    <div class="kpi-card kpi-card--active">
        <div class="kpi-card__icon">
            <i data-lucide="check-square"></i>
        </div>
        <div class="kpi-card__content">
            <span class="kpi-card__title">Categorías Activas</span>
            <h3 class="kpi-card__value">{{ $stats['activos'] }}</h3>
        </div>
    </div>

    <div class="kpi-card kpi-card--inactive">
        <div class="kpi-card__icon">
            <i data-lucide="x-square"></i>
        </div>
        <div class="kpi-card__content">
            <span class="kpi-card__title">Categorías Inactivas</span>
            <h3 class="kpi-card__value">{{ $stats['inactivos'] }}</h3>
        </div>
    </div>
</div>

{{-- TABLA DE DATOS --}}
<div class="data_table-horizontal">
    <div class="data-table-horizontal__header">
        <span class="data-table-horizontal__title">
            Listado de Categorías
        </span>

        <a class="stroke-button info" href="{{ route('category.create') }}">
            <i data-lucide="plus"></i>
            Nueva Categoría
        </a>
    </div>

    <div class="data-table-horizontal__body">
        @if(empty($categories))
        <p class="no-data">No hay registros disponibles</p>
        @else
        <table class="data-table-horizontal__table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th width="120">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <x-status :value="$category->status" />
                    </td>
                    <td>
                        <a class="stroke-button info" href="{{ route('category.show', $category->id) }}">
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