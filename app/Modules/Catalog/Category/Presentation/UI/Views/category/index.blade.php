@extends('layouts.app-layout')

@section('title', 'Categorias')
@section('header_title', 'Crud de Categorias')

@section('content')

<a class="" href="{{ route('category.create') }}">
    Nueva categoría
</a>


@if(empty($categories))
<x-alerts.toast
    variant="info"
    code="200"
    message="No hay registros disponibles" />
@else
<table border="1" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>
                <x-badges.status :value="$category->status" />
            </td>
            <td>
                <a href="{{ route('category.show', $category->id) }}">
                    Detalles
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif
@endsection