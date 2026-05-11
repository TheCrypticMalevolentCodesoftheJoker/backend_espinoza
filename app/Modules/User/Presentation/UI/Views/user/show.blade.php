@extends('layouts.app-layout')

@section('title', 'Usuarios')
@section('header_title', 'Detalle de Usuario')

@section('content')
<div class="data_table-vertical">
    <div class="data-table-vertical__header">
        <span class="data-table-vertical__title">
            {{ $user->name }}
        </span>
        <a class="stroke-button info" href="{{ route('user.index') }}">
            Volver
        </a>
    </div>

    <table class="data-table-vertical__table">
        <tr>
            <th>ID</th>
            <td>{{ $user->id }}</td>
        </tr>
        <tr>
            <th>Rol</th>
            <td>{{ $user->roleName }} (ID: {{ $user->roleId }})</td>
        </tr>
        <tr>
            <th>Nombre</th>
            <td>{{ $user->name }}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{ $user->email }}</td>
        </tr>
        <tr>
            <th>Estado</th>
            <td>
                <x-status :value="$user->status" />
            </td>
        </tr>
        <tr>
            <th>Creado</th>
            <td>{{ $user->createdAt?->format('Y-m-d H:i') ?? '—' }}</td>
        </tr>
        <tr>
            <th>Actualizado</th>
            <td>{{ $user->updatedAt?->format('Y-m-d H:i') ?? '—' }}</td>
        </tr>
        <tr>
            <th>Acciones</th>
            <td class="table-actions">
                <a class="stroke-button info" href="{{ route('user.edit', $user->id) }}">
                    Editar
                </a>

                @if ($user->status)
                <form action="{{ route('user.deactivate', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="stroke-button danger" type="submit">
                        Desactivar
                    </button>
                </form>
                @else
                <form action="{{ route('user.activate', $user->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button class="stroke-button success" type="submit">
                        Activar
                    </button>
                </form>
                @endif

                <form action="{{ route('user.destroy', $user->id) }}" method="POST">
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