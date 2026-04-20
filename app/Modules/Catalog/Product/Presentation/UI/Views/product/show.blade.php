@extends('layouts.app-layout')

@section('title', 'Detalle de Producto')
@section('header_title', 'Detalle del producto')

@section('content')

<div class="card p-4">


    {{-- =========================
        DIMENSIONES
    ========================= --}}
    <h5>Dimensiones</h5>

    @forelse ($product->dimensions as $d)
        <div>
            📏 {{ $d['length'] }} x {{ $d['width'] }} x {{ $d['thickness'] }}
        </div>
    @empty
        <p>No hay dimensiones registradas.</p>
    @endforelse

    <hr>

    {{-- =========================
        DESCUENTOS
    ========================= --}}
    <h5>Descuentos</h5>

    @forelse ($product->discounts as $d)
        <div>
            💰 {{ $d['amount'] }} |
            Desde: {{ $d['start_date'] }} -
            Hasta: {{ $d['end_date'] ?? 'sin fecha' }}
        </div>
    @empty
        <p>No hay descuentos.</p>
    @endforelse

    <hr>

    {{-- =========================
        IMÁGENES
    ========================= --}}
    <h5>Imágenes</h5>

    <div style="display:flex; gap:10px; flex-wrap:wrap;">
        @forelse ($product->images as $img)
            <div>
                <img src="{{ $img['url'] }}" width="120" alt="img">
                <p>{{ $img['type'] }}</p>
            </div>
        @empty
            <p>No hay imágenes.</p>
        @endforelse
    </div>

    <hr>

    {{-- =========================
        PRECIOS
    ========================= --}}
    <h5>Precios</h5>

    @forelse ($product->prices as $p)
        <div>
            💲 {{ $p['amount'] }} |
            Desde: {{ $p['start_date'] }} -
            Hasta: {{ $p['end_date'] ?? 'sin fecha' }}
        </div>
    @empty
        <p>No hay precios registrados.</p>
    @endforelse

</div>

@endsection