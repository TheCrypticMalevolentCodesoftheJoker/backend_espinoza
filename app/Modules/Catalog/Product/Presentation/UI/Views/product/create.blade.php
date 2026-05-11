@extends('layouts.app-layout')

@section('title', 'Nuevo Producto')
@section('header_title', 'Registrar Producto')

@section('content')
<div class="form-standard-wrapper">
    <div class="form-standard__header">
        <span class="form-standard__title">
            Nuevo Producto
        </span>
        <a class="stroke-button info" href="{{ route('product.index') }}">
            Volver
        </a>
    </div>

    <form class="form-standard" action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" style="max-width: 1000px;">
        @csrf

        {{-- DATOS GENERALES --}}
        <div class="form-standard__section">
            <h2 class="form-standard__section-title">Datos Generales</h2>

            <div class="form-standard__grid">
                <div class="form-standard__group">
                    <label class="form-standard__label">Nombre del Producto *</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                        class="form-standard__input @error('name') is-invalid @enderror"
                        placeholder="Ej: Porcelanato Gris 60x60" required>
                    @error('name') <span class="form-standard__error">{{ $message }}</span> @enderror
                </div>

                <div class="form-standard__group">
                    <label class="form-standard__label">Categoría *</label>
                    <select name="category_id" class="form-standard__input select" required>
                        <option value="">— Seleccionar —</option>
                        @foreach($categories as $category)
                        <option value="{{ $category['id'] }}" {{ old('category_id') == $category['id'] ? 'selected' : '' }}>
                            {{ $category['name'] }}
                        </option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="form-standard__error">{{ $message }}</span> @enderror
                </div>

                <div class="form-standard__group">
                    <label class="form-standard__label">Marca *</label>
                    <select name="brand_id" class="form-standard__input select" required>
                        <option value="">— Seleccionar —</option>
                        @foreach($brands as $brand)
                        <option value="{{ $brand['id'] }}" {{ old('brand_id') == $brand['id'] ? 'selected' : '' }}>
                            {{ $brand['name'] }}
                        </option>
                        @endforeach
                    </select>
                    @error('brand_id') <span class="form-standard__error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="form-standard__group">
                <label class="form-standard__label">Descripción</label>
                <textarea name="description" rows="3" class="form-standard__input form-standard__textarea" placeholder="Detalles adicionales del producto...">{{ old('description') }}</textarea>
            </div>
            <div class="form-standard__grid">
                <div class="form-standard__group">
                    <label class="form-standard__label">Unidad de Medida *</label>
                    <select name="unit_measure" class="form-standard__input select" required>
                        <option value="">— Seleccionar —</option>
                        <option value="m2" {{ old('unit_measure') == 'm2' ? 'selected' : '' }}>m2</option>
                        <option value="unidad" {{ old('unit_measure') == 'unidad' ? 'selected' : '' }}>unidad</option>
                        <option value="caja" {{ old('unit_measure') == 'caja' ? 'selected' : '' }}>caja</option>
                        <option value="millar" {{ old('unit_measure') == 'millar' ? 'selected' : '' }}>millar</option>
                        <option value="paquete" {{ old('unit_measure') == 'paquete' ? 'selected' : '' }}>paquete</option>
                        <option value="metro" {{ old('unit_measure') == 'metro' ? 'selected' : '' }}>metro</option>
                        <option value="kg" {{ old('unit_measure') == 'kg' ? 'selected' : '' }}>kg</option>
                    </select>
                </div>

                <div class="form-standard__group">
                    <label class="form-standard__label">Stock Inicial *</label>
                    <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0"
                        class="form-standard__input" required>
                </div>
            </div>

            <div class="form-standard__grid--3 form-standard__grid">
                <div class="form-standard__group">
                    <label class="form-standard__label">Largo (cm) *</label>
                    <input type="text" name="length" value="{{ old('length') }}" class="form-standard__input" placeholder="0.00" required>
                </div>
                <div class="form-standard__group">
                    <label class="form-standard__label">Ancho (cm) *</label>
                    <input type="text" name="width" value="{{ old('width') }}" class="form-standard__input" placeholder="0.00" required>
                </div>
                <div class="form-standard__group">
                    <label class="form-standard__label">Grosor (mm) *</label>
                    <input type="text" name="thickness" value="{{ old('thickness') }}" class="form-standard__input" placeholder="0.00" required>
                </div>
            </div>


        </div>

        {{-- ARCHIVOS Y MULTIMEDIA --}}
        <div class="form-standard__section">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 class="form-standard__section-title" style="margin-bottom: 0;">Archivos y Multimedia</h2>
                <button type="button" class="stroke-button info" id="add-multimedia">
                    + Agregar Archivo
                </button>
            </div>

            <div id="multimedia-container" style="display: flex; flex-direction: column; gap: 12px;">
                {{-- Se cargará dinámicamente vía JS --}}
            </div>

            @error('multimedia.*')
            <span class="form-standard__error" style="display: block; margin-top: 10px;">{{ $message }}</span>
            @enderror
        </div>

        {{-- PRECIO --}}
        <div class="form-standard__section">
            <h2 class="form-standard__section-title">Configuración de Precio</h2>

            <div class="form-standard__grid--3 form-standard__grid">
                <div class="form-standard__group">
                    <label class="form-standard__label">Monto (S/) *</label>
                    <input type="number" name="price_amount" value="{{ old('price_amount') }}" step="0.01" min="0.01" class="form-standard__input" required>
                    @error('price_amount') <span class="form-standard__error">{{ $message }}</span> @enderror
                </div>
                <div class="form-standard__group">
                    <label class="form-standard__label">Fecha Inicio *</label>
                    <input type="date" name="price_start_date" value="{{ old('price_start_date') }}" class="form-standard__input" required>
                </div>
                <div class="form-standard__group">
                    <label class="form-standard__label">Fecha Fin</label>
                    <input type="date" name="price_end_date" value="{{ old('price_end_date') }}" class="form-standard__input">
                </div>
            </div>
        </div>

        {{-- DESCUENTO --}}
        <div class="form-standard__section">
            <h2 class="form-standard__section-title">Descuento (Opcional)</h2>

            <div class="form-standard__grid--3 form-standard__grid">
                <div class="form-standard__group">
                    <label class="form-standard__label">Monto Descuento (S/)</label>
                    <input type="number" name="discount_amount" value="{{ old('discount_amount') }}" step="0.01" min="0.01" class="form-standard__input">
                </div>
                <div class="form-standard__group">
                    <label class="form-standard__label">Fecha Inicio</label>
                    <input type="date" name="discount_start_date" value="{{ old('discount_start_date') }}" class="form-standard__input">
                </div>
                <div class="form-standard__group">
                    <label class="form-standard__label">Fecha Fin</label>
                    <input type="date" name="discount_end_date" value="{{ old('discount_end_date') }}" class="form-standard__input">
                </div>
            </div>
        </div>

        <div class="form-standard__actions" style="margin-top: 20px;">
            <button type="submit" class="stroke-button success">
                Registrar Producto
            </button>
        </div>
    </form>
</div>
@endsection