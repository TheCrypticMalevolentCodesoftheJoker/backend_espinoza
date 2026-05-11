@extends('layouts.app-layout')

@section('title', 'Productos')
@section('header_title', 'Gestión de Productos')

@section('content')

{{-- SECCION DE INDICADORES (KPIs) --}}
<div class="kpis">
    <div class="kpi-card kpi-card--total">
        <div class="kpi-card__icon">
            <i data-lucide="package"></i>
        </div>
        <div class="kpi-card__content">
            <span class="kpi-card__title">Total Productos</span>
            <h3 class="kpi-card__value">{{ $stats['total'] }}</h3>
        </div>
    </div>

    <div class="kpi-card kpi-card--active">
        <div class="kpi-card__icon">
            <i data-lucide="check-circle"></i>
        </div>
        <div class="kpi-card__content">
            <span class="kpi-card__title">Productos Activos</span>
            <h3 class="kpi-card__value">{{ $stats['activos'] }}</h3>
        </div>
    </div>

    <div class="kpi-card kpi-card--inactive">
        <div class="kpi-card__icon">
            <i data-lucide="alert-circle"></i>
        </div>
        <div class="kpi-card__content">
            <span class="kpi-card__title">Productos Inactivos</span>
            <h3 class="kpi-card__value">{{ $stats['inactivos'] }}</h3>
        </div>
    </div>
</div>

{{-- TABLA DE DATOS --}}
<div class="data_table-horizontal">
    <div class="data-table-horizontal__header">
        <span class="data-table-horizontal__title">
            Listado de Productos
        </span>

        <a class="stroke-button info" href="{{ route('product.create') }}">
            <i data-lucide="plus"></i>
            Nuevo Producto
        </a>
    </div>

    <div class="data-table-horizontal__body">
        @if(empty($products))
        <p class="no-data">No hay registros disponibles</p>
        @else
        <table class="data-table-horizontal__table">
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Nombre</th>
                    <th>Categoría</th>
                    <th>Marca</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th width="120">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td><strong>{{ $product->code }}</strong></td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->categoryName }}</td>
                    <td>{{ $product->brandName }}</td>
                    <td>
                        @if($product->currentPrice !== null)
                        S/ {{ number_format($product->currentPrice, 2) }}
                        @else
                        <span class="muted">—</span>
                        @endif
                    </td>
                    <td>
                        <x-status :value="$product->status" />
                    </td>
                    <td>
                        <a class="stroke-button info" href="{{ route('product.show', $product->id) }}">
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