@extends('layouts.app-layout')

@section('title', 'Productos')
@section('header_title', 'Registrar nuevo producto')

@section('content')

<form method="POST" action="{{ route('product.store') }}">
    @csrf

    {{-- =========================
        PRODUCTO BASE
    ========================= --}}
    <div>
        <h5>Producto</h5>

        <input type="text" name="name" placeholder="Nombre">

        <textarea name="description" placeholder="Descripción"></textarea>

        <input type="text" name="unit_measure" placeholder="Unidad de medida">

        <input type="number" name="stock" placeholder="Stock">

        <select name="category_id">
            <option value="">Categoría</option>
            <option value="1">Categoría a</option>
        </select>

        <select name="brand_id">
            <option value="">Marca</option>
            <option value="1">Marca a</option>
        </select>
    </div>

    {{-- =========================
        IMÁGENES
    ========================= --}}
    <div id="images-wrapper">
        <div class="image-row">
            <input type="text" name="images[0][url]">
            <select name="images[0][type]">
                <option value="">Seleccione tipo</option>
                <option value="main">Principal</option>
                <option value="secondary">Secundaria</option>
            </select>
        </div>
    </div>

    <button type="button" id="add-image-btn">
        + Agregar
    </button>

    {{-- =========================
        PRECIO
    ========================= --}}
    <div>
        <h5>Precio</h5>

        <input type="number" name="price[amount]" placeholder="Monto">

        <input type="date" name="price[start_date]">

        <input type="date" name="price[end_date]">
    </div>

    {{-- =========================
        DESCUENTO
    ========================= --}}
    <div>
        <h5>Descuento (opcional)</h5>

        <input type="number" name="discount[amount]" placeholder="Monto descuento">

        <input type="date" name="discount[start_date]">

        <input type="date" name="discount[end_date]">
    </div>

    {{-- =========================
        DIMENSIONES
    ========================= --}}
    <div>
        <h5>Dimensiones</h5>

        <input type="number" name="dimension[length]" placeholder="Largo">

        <input type="number" name="dimension[width]" placeholder="Ancho">

        <input type="number" name="dimension[thickness]" placeholder="Grosor">
    </div>

    {{-- =========================
        BOTÓN
    ========================= --}}
    <button>
        Guardar producto
    </button>

</form>

@endsection