@extends('layouts.app-layout')

@section('title', 'Categorias')
@section('header_title', 'Crud de Categorias')

@section('content')

@if (session('alert'))
<x-alerts.toast
    :variant="session('alert')['variant']"
    :code="session('alert')['code']"
    :message="session('alert')['message']" />
@endif

<a href="{{ route('category.create') }}">Nueva categoría</a>

@if(empty($categories))
    <x-alerts.toast
        variant="info"
        code="200"
        message="No hay registros disponibles" />
@else
<table border="1" cellpadding="5" cellspacing="0">
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
            <td><x-badges.status :value="$category->status" /></td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>
@endif

@endsection