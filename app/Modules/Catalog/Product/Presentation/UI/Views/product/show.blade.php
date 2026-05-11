@extends('layouts.app-layout')

@section('title', $product->name)
@section('header_title', 'Detalle de Producto')

@section('content')
<div class="data_table-vertical">
    <div class="data-table-vertical__header">
        <span class="data-table-vertical__title">
            {{ $product->name }}
        </span>
        <a class="stroke-button info" href="{{ route('product.index') }}">
            Volver
        </a>
    </div>

    <table class="data-table-vertical__table">
        <tr>
            <th>ID</th>
            <td>{{ $product->id }}</td>
        </tr>
        <tr>
            <th>Código</th>
            <td>{{ $product->code }}</td>
        </tr>
        <tr>
            <th>Categoría</th>
            <td>{{ $product->categoryName }}</td>
        </tr>
        <tr>
            <th>Marca</th>
            <td>{{ $product->brandName }}</td>
        </tr>
        <tr>
            <th>Nombre del Producto</th>
            <td>{{ $product->name }}</td>
        </tr>
        <tr>
            <th>Descripción</th>
            <td>{{ $product->description ?? 'Sin descripción' }}</td>
        </tr>
        <tr>
            <th>Unidad de Medida</th>
            <td>{{ $product->unitMeasure }}</td>
        </tr>
        <tr>
            <th>Dimensiones</th>
            <td>{{ $product->length }} (Largo) × {{ $product->width }} (Ancho) × {{ $product->thickness }} (Grosor)</td>
        </tr>
        <tr>
            <th>Stock Actual</th>
            <td>{{ $product->stock }}</td>
        </tr>
        <tr>
            <th>Estado</th>
            <td>
                <x-status :value="$product->status" />
            </td>
        </tr>
        <tr>
            <th>Creado</th>
            <td>{{ $product->createdAt?->format('Y-m-d H:i') ?? '—' }}</td>
        </tr>
        <tr>
            <th>Actualizado</th>
            <td>{{ $product->updatedAt?->format('Y-m-d H:i') ?? '—' }}</td>
        </tr>
        @if(!empty($product->images))
        <tr>
            <th>Multimedia</th>
            <td>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(80px, 1fr)); gap: 10px;">
                    @foreach($product->images as $image)
                    <div style="aspect-ratio: 1; border-radius: 8px; border: 1px solid #e2e8f0; overflow: hidden; position: relative; background: #f8fafc; display: flex; align-items: center; justify-content: center;">
                        @if($image->type === 'png')
                        <img src="{{ $image->url }}" alt="" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                        <div style="text-align: center;">
                            <i data-lucide="box" style="width: 24px; height: 24px; color: #94a3b8;"></i>
                            <div style="font-size: 8px; font-weight: bold; color: #64748b; margin-top: 2px;">3D</div>
                        </div>
                        @endif
                        <span style="position: absolute; bottom: 3px; right: 3px; background: rgba(0,0,0,0.6); color: white; font-size: 7px; padding: 1px 4px; border-radius: 3px; text-transform: uppercase;">{{ $image->type }}</span>
                    </div>
                    @endforeach
                </div>
            </td>
        </tr>
        @endif
        <tr>
            <th>Precio Vigente</th>
            <td>
                @if($product->currentPrice)
                <div style="display: flex; flex-direction: column; gap: 4px;">
                    <div><strong>Monto:</strong> S/ {{ number_format($product->currentPrice->amount, 2) }}</div>
                    <div><strong>Inicio:</strong> {{ $product->currentPrice->startDate->format('d/m/Y') }}</div>
                    <div><strong>Fin:</strong> {{ $product->currentPrice->endDate?->format('d/m/Y') ?? '—' }}</div>
                    <div><strong>Estado:</strong> <x-status :value="$product->currentPrice->status" /></div>
                </div>
                @else
                <span style="color: #ef4444;">No asignado</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Descuento Activo</th>
            <td>
                @if($product->currentDiscount)
                <div style="display: flex; flex-direction: column; gap: 4px;">
                    <div><strong>Monto:</strong> <span style="color: #ef4444;">- S/ {{ number_format($product->currentDiscount->amount, 2) }}</span></div>
                    <div><strong>Inicio:</strong> {{ $product->currentDiscount->startDate->format('d/m/Y') }}</div>
                    <div><strong>Fin:</strong> {{ $product->currentDiscount->endDate?->format('d/m/Y') ?? '—' }}</div>
                    <div><strong>Estado:</strong> <x-status :value="$product->currentDiscount->status" /></div>
                </div>
                @else
                <span style="color: #94a3b8;">Sin descuento</span>
                @endif
            </td>
        </tr>
        <tr>
            <th>Acciones</th>
            <td class="table-actions">
                <a class="stroke-button info" href="{{ route('product.edit', $product->id) }}">
                    Editar
                </a>

                @if($product->status)
                <form action="{{ route('product.deactivate', $product->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <button class="stroke-button danger" type="submit">Desactivar</button>
                </form>
                @else
                <form action="{{ route('product.activate', $product->id) }}" method="POST">
                    @csrf @method('PATCH')
                    <button class="stroke-button success" type="submit">Activar</button>
                </form>
                @endif

                <form action="{{ route('product.destroy', $product->id) }}" method="POST">
                    @csrf @method('DELETE')
                    <button class="stroke-button danger" type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
    </table>
</div>
@endsection