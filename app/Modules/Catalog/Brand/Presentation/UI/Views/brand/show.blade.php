@extends('layouts.app-layout')

@section('title', 'Marcas')
@section('header_title', 'Detalle de Marca')

@section('content')
<div class="data_table-vertical">
    <div class="data-table-vertical__header">
        <span class="data-table-vertical__title">
            {{ $brand->name }}
        </span>
        <a class="stroke-button info" href="{{ route('brand.index') }}">
            Volver
        </a>
    </div>

    <table class="data-table-vertical__table">
        <tr>
            <th>ID</th>
            <td>{{ $brand->id }}</td>
        </tr>
        <tr>
            <th>Nombre de la Marca</th>
            <td>{{ $brand->name }}</td>
        </tr>
        <tr>
            <th>Estado</th>
            <td>
                <x-status :value="$brand->status" />
            </td>
        </tr>
        <tr>
            <th>Creado</th>
            <td>{{ $brand->createdAt?->format('Y-m-d H:i') ?? '—' }}</td>
        </tr>
        <tr>
            <th>Actualizado</th>
            <td>{{ $brand->updatedAt?->format('Y-m-d H:i') ?? '—' }}</td>
        </tr>
        <tr>
            <th>Acciones</th>
            <td class="table-actions">
                <a class="stroke-button info" href="{{ route('brand.edit', $brand->id) }}">
                    Editar
                </a>

                @if ($brand->status)
                    <form action="{{ route('brand.deactivate', $brand->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="stroke-button danger" type="submit">
                            Desactivar
                        </button>
                    </form>
                @else
                    <form action="{{ route('brand.activate', $brand->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="stroke-button success" type="submit">
                            Activar
                        </button>
                    </form>
                @endif

                <form action="{{ route('brand.destroy', $brand->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button class="stroke-button danger" type="submit">
                        Eliminar
                    </button>
                </form>
            </td>
        </tr>
    </table>
</div>
@endsection