@extends('layouts.app-layout')

@section('title', 'Categorias')
@section('header_title', 'Detalle de Categoría')

@section('content')

<a class="" href="{{ route('category.index') }}">
    Volver
</a>
<table border="1" cellpadding="5" cellspacing="0">

    <tr>
        <th>ID</th>
        <td>{{ $category->id }}</td>
    </tr>

    <tr>
        <th>Nombre</th>
        <td>{{ $category->name }}</td>
    </tr>

    <tr>
        <th>Estado</th>
        <td>
            <x-badges.status :value="$category->status" />
        </td>
    </tr>

    <tr>
        <th>Acciones</th>
        <td>

            {{-- EDITAR --}}
            <a href="{{ route('category.edit', $category->id) }}">
                Editar
            </a>

            @if ($category->status)
            <form action="{{ route('category.deactivate', $category->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit">
                    Desactivar
                </button>
            </form>
            @else
            <form action="{{ route('category.activate', $category->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <button type="submit">
                    Activar
                </button>
            </form>
            @endif

            {{-- ELIMINAR DEFINITIVO --}}
            <form action="{{ route('category.destroy', $category->id) }}" method="POST">
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