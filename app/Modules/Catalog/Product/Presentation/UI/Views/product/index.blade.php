@extends('layouts.app-layout')

@section('title', 'Productos')
@section('header_title', 'Listado de productos')

@section('content')

<div class="card p-3 mb-3">
    <h5>Productos</h5>

    <table border="1" class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Código</th>
                <th>Categoría</th>
                <th>Marca</th>
                <th>Nombre</th>
                <th>Stock</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
        @forelse ($products as $product)
            <tr>
                <td>{{ $product->id }}</td>
                <td>{{ $product->code }}</td>
                <td>{{ $product->category_name }}</td>
                <td>{{ $product->brand_name }}</td>
                <td>{{ $product->name }}</td>
                <td>{{ $product->stock }}</td>
                <td>
                    <x-badges.status :value="$product->status" />
                </td>
                <td>
                    <a href="{{ route('product.show', $product->id) }}">
                        Ver detalle
                    </a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="8">No hay productos registrados</td>
            </tr>
        @endforelse
        </tbody>

    </table>
</div>

@endsection