@extends('layouts.app-layout')

@section('title', 'Roles')
@section('header_title', 'Detalle de Rol')

@section('content')

<div class="data_table-vertical">
    <div class="data-table-vertical__header">
        <span class="data-table-vertical__title">
            {{ $role->name }}
        </span>
        <a class="stroke-button info" href="{{ route('role.index') }}">
            Volver
        </a>
    </div>
    <table class="data-table-vertical__table">
        <tr>
            <th>ID</th>
            <td>{{ $role->id }}</td>
        </tr>
        <tr>
            <th>Nombre</th>
            <td>{{ $role->name }}</td>
        </tr>
        <tr>
            <th>Descripción</th>
            <td>{{ $role->description ?? '—' }}</td>
        </tr>
        <tr>
            <th>Estado</th>
            <td>
                <x-status :value="$role->status" />
            </td>
        </tr>
        <tr>
            <th>Creado</th>
            <td>
                {{ $role->createdAt?->format('Y-m-d H:i') ?? '—' }}
            </td>
        </tr>

        <tr>
            <th>Actualizado</th>
            <td>
                {{ $role->updatedAt?->format('Y-m-d H:i') ?? '—' }}
            </td>
        </tr>
        <tr>
            <th>Acciones</th>
            <td class="table-actions">
                <a class="stroke-button info" href="{{ route('role.edit', $role->id) }}">
                    Editar
                </a>
                @if ($role->status)
                <form action="{{ route('role.deactivate', $role->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="stroke-button danger" type="submit">
                        Desactivar
                    </button>
                </form>
                @else
                <form action="{{ route('role.activate', $role->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="stroke-button success" type="submit">
                        Activar
                    </button>
                </form>
                @endif
                <form action="{{ route('role.destroy', $role->id) }}" method="POST">
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