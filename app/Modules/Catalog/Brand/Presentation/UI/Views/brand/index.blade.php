@extends('layouts.app-layout')

@section('title', 'Marcas')
@section('header_title', 'Gestión de Marcas')

@section('content')

{{-- SECCION DE INDICADORES (KPIs) --}}
<div class="kpis">
    <div class="kpi-card kpi-card--total">
        <div class="kpi-card__icon">
            <i data-lucide="tag"></i>
        </div>
        <div class="kpi-card__content">
            <span class="kpi-card__title">Total Marcas</span>
            <h3 class="kpi-card__value">{{ $stats['total'] }}</h3>
        </div>
    </div>

    <div class="kpi-card kpi-card--active">
        <div class="kpi-card__icon">
            <i data-lucide="check-circle"></i>
        </div>
        <div class="kpi-card__content">
            <span class="kpi-card__title">Marcas Activas</span>
            <h3 class="kpi-card__value">{{ $stats['activos'] }}</h3>
        </div>
    </div>

    <div class="kpi-card kpi-card--inactive">
        <div class="kpi-card__icon">
            <i data-lucide="x-circle"></i>
        </div>
        <div class="kpi-card__content">
            <span class="kpi-card__title">Marcas Inactivas</span>
            <h3 class="kpi-card__value">{{ $stats['inactivos'] }}</h3>
        </div>
    </div>
</div>

{{-- TABLA DE DATOS --}}
<div class="data_table-horizontal">
    <div class="data-table-horizontal__header">
        <span class="data-table-horizontal__title">
            Listado de Marcas
        </span>

        <a class="stroke-button info" href="{{ route('brand.create') }}">
            <i data-lucide="plus"></i>
            Nueva Marca
        </a>
    </div>

    <div class="data-table-horizontal__body">
        @if(empty($brands))
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
                    @foreach($brands as $brand)
                        <tr>
                            <td>{{ $brand->id }}</td>
                            <td>{{ $brand->name }}</td>
                            <td>
                                <x-status :value="$brand->status" />
                            </td>
                            <td>
                                <a class="stroke-button info" href="{{ route('brand.show', $brand->id) }}">
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