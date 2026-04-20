@extends('layouts.app-layout')

@section('title', 'Marcas')
@section('header_title', 'Detalle de Marca')

@section('content')

<a href="{{ route('brand.index') }}">
    Volver
</a>

<table border="1" cellpadding="5" cellspacing="0">

    <tr>
        <th>ID</th>
        <td>{{ $brand->id }}</td>
    </tr>

    <tr>
        <th>Nombre</th>
        <td>{{ $brand->name }}</td>
    </tr>

    <tr>
        <th>Estado</th>
        <td>
            <x-badges.status :value="$brand->status" />
        </td>
    </tr>

    <tr>
        <th>Acciones</th>
        <td>

            <a href="{{ route('brand.edit', $brand->id) }}">
                Editar
            </a>

            @if ($brand->status)
            <form action="{{ route('brand.deactivate', $brand->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit">
                    Desactivar
                </button>
            </form>
            @else
            <form action="{{ route('brand.activate', $brand->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit">
                    Activar
                </button>
            </form>
            @endif

            <form action="{{ route('brand.destroy', $brand->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit">
                    Eliminar
                </button>
            </form>

        </td>
    </tr>

</table>

@endsection