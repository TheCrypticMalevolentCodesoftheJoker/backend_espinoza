@extends('layouts.app-layout')

@section('title', 'Categorías')
@section('header_title', 'Detalle de Categoría')

@section('content')
<div class="data_table-vertical">
    <div class="data-table-vertical__header">
        <span class="data-table-vertical__title">
            {{ $category->name }}
        </span>
        <a class="stroke-button info" href="{{ route('category.index') }}">
            Volver
        </a>
    </div>

    <table class="data-table-vertical__table">
        <tr>
            <th>ID</th>
            <td>{{ $category->id }}</td>
        </tr>
        <tr>
            <th>Nombre de la Categoría</th>
            <td>{{ $category->name }}</td>
        </tr>
        <tr>
            <th>Estado</th>
            <td>
                <x-status :value="$category->status" />
            </td>
        </tr>
        <tr>
            <th>Creado</th>
            <td>{{ $category->createdAt?->format('Y-m-d H:i') ?? '—' }}</td>
        </tr>
        <tr>
            <th>Actualizado</th>
            <td>{{ $category->updatedAt?->format('Y-m-d H:i') ?? '—' }}</td>
        </tr>
        <tr>
            <th>Acciones</th>
            <td class="table-actions">
                <a class="stroke-button info" href="{{ route('category.edit', $category->id) }}">
                    Editar
                </a>

                @if ($category->status)
                    <form action="{{ route('category.deactivate', $category->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="stroke-button danger" type="submit">
                            Desactivar
                        </button>
                    </form>
                @else
                    <form action="{{ route('category.activate', $category->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button class="stroke-button success" type="submit">
                            Activar
                        </button>
                    </form>
                @endif

                <form action="{{ route('category.destroy', $category->id) }}" method="POST">
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