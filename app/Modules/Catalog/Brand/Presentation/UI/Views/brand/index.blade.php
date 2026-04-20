@extends('layouts.app-layout')

@section('title', 'Marcas')
@section('header_title', 'Crud de Marcas')

@section('content')

<a href="{{ route('brand.create') }}">
    Nueva marca
</a>

@if(empty($brands))
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
        @foreach($brands as $brand)
        <tr>
            <td>{{ $brand->id }}</td>
            <td>{{ $brand->name }}</td>
            <td>
                <x-badges.status :value="$brand->status" />
            </td>
            <td>
                <a href="{{ route('brand.show', $brand->id) }}">
                    Detalles
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

@endsection