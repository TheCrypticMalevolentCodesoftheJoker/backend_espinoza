@extends('layouts.app-layout')

@section('title', 'Editar: ' . $product->name)
@section('header_title', 'Editar Producto')

@section('content')
<div class="form-standard-wrapper">
    <div class="form-standard__header">
        <span class="form-standard__title">
            Editar: {{ $product->name }}
        </span>
        <a class="stroke-button info" href="{{ route('product.show', $product->id) }}">
            Volver
        </a>
    </div>

    @if($errors->any())
        <div class="form-standard" style="background: #fff1f2; border: 1px solid #fda4af; margin-bottom: 20px; max-width: 1100px;">
            <ul style="color: #be123c; font-size: 14px; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form class="form-standard" action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data" style="max-width: 1100px;">
        @csrf
        @method('PATCH')

        {{-- DATOS GENERALES --}}
        <div class="form-standard__section">
            <h2 class="form-standard__section-title">Datos Generales</h2>
            <div class="form-standard__grid">
                <div class="form-standard__group">
                    <label class="form-standard__label">Nombre del Producto *</label>
                    <input type="text" name="name" value="{{ old('name', $product->name) }}"
                        class="form-standard__input @error('name') is-invalid @enderror" required>
                    @error('name') <span class="form-standard__error">{{ $message }}</span> @enderror
                </div>

                <div class="form-standard__group">
                    <label class="form-standard__label">Categoría *</label>
                    <select name="category_id" class="form-standard__input select" required>
                        @foreach($categories as $category)
                        <option value="{{ $category['id'] }}" {{ old('category_id', $product->categoryId) == $category['id'] ? 'selected' : '' }}>
                            {{ $category['name'] }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-standard__group">
                    <label class="form-standard__label">Marca *</label>
                    <select name="brand_id" class="form-standard__input select" required>
                        @foreach($brands as $brand)
                        <option value="{{ $brand['id'] }}" {{ old('brand_id', $product->brandId) == $brand['id'] ? 'selected' : '' }}>
                            {{ $brand['name'] }}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-standard__group">
                <label class="form-standard__label">Descripción</label>
                <textarea name="description" rows="3" class="form-standard__input form-standard__textarea" placeholder="Detalles adicionales del producto...">{{ old('description', $product->description) }}</textarea>
            </div>
            <div class="form-standard__grid">
                <div class="form-standard__group">
                    <label class="form-standard__label">Unidad de Medida *</label>
                    <select name="unit_measure" class="form-standard__input select" required>
                        <option value="m2" {{ old('unit_measure', $product->unitMeasure) == 'm2' ? 'selected' : '' }}>m2</option>
                        <option value="unidad" {{ old('unit_measure', $product->unitMeasure) == 'unidad' ? 'selected' : '' }}>unidad</option>
                        <option value="caja" {{ old('unit_measure', $product->unitMeasure) == 'caja' ? 'selected' : '' }}>caja</option>
                        <option value="millar" {{ old('unit_measure', $product->unitMeasure) == 'millar' ? 'selected' : '' }}>millar</option>
                        <option value="paquete" {{ old('unit_measure', $product->unitMeasure) == 'paquete' ? 'selected' : '' }}>paquete</option>
                        <option value="metro" {{ old('unit_measure', $product->unitMeasure) == 'metro' ? 'selected' : '' }}>metro</option>
                        <option value="kg" {{ old('unit_measure', $product->unitMeasure) == 'kg' ? 'selected' : '' }}>kg</option>
                    </select>
                </div>

                <div class="form-standard__group">
                    <label class="form-standard__label">Stock Actual *</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0"
                        class="form-standard__input" required>
                </div>

            </div>
            <div class="form-standard__grid">
                <div class="form-standard__group">
                    <label class="form-standard__label">Largo (cm) *</label>
                    <input type="text" name="length" value="{{ old('length', $product->length) }}" class="form-standard__input" required>
                </div>
                <div class="form-standard__group">
                    <label class="form-standard__label">Ancho (cm) *</label>
                    <input type="text" name="width" value="{{ old('width', $product->width) }}" class="form-standard__input" required>
                </div>
                <div class="form-standard__group">
                    <label class="form-standard__label">Grosor (mm) *</label>
                    <input type="text" name="thickness" value="{{ old('thickness', $product->thickness) }}" class="form-standard__input" required>
                </div>
            </div>
        </div>

        {{-- ARCHIVOS Y MULTIMEDIA --}}
        <div class="form-standard__section">
            <h2 class="form-standard__section-title">Archivos y Multimedia</h2>

            @if(!empty($product->images))
            <div style="display: flex; gap: 12px; margin-bottom: 25px; flex-wrap: wrap;">
                @foreach($product->images as $image)
                <div style="width: 80px; height: 80px; border-radius: 12px; border: 1px solid #e2e8f0; overflow: hidden; background: #f8fafc; display: flex; align-items: center; justify-content: center; position: relative; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
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
            @endif

            <div class="form-standard__group" style="flex-direction: row; align-items: center; gap: 12px; margin-bottom: 25px; background: #f1f5f9; padding: 12px 15px; border-radius: 10px; width: fit-content;">
                <input type="checkbox" name="replace_images" value="1" id="replace_images" {{ old('replace_images') ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer; accent-color: #3b82f6;">
                <label for="replace_images" style="font-size: 14px; color: #1e293b; cursor: pointer; font-weight: 600;">Reemplazar todas las imágenes actuales</label>
            </div>

            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                <h3 style="font-size: 13px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin: 0;">Cargar Nuevos Archivos</h3>
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
            <h2 class="form-standard__section-title">
                Actualizar Precio
                @if($product->currentPrice)
                <span style="font-size: 12px; font-weight: 500; color: #64748b; margin-left: 10px;">
                    (Actual: S/ {{ number_format($product->currentPrice->amount, 2) }})
                </span>
                @endif
            </h2>

            <div class="form-standard__grid--3 form-standard__grid">
                <div class="form-standard__group">
                    <label class="form-standard__label">Nuevo Monto (S/)</label>
                    <input type="number" name="price_amount" value="{{ old('price_amount') }}" step="0.01" min="0.01" class="form-standard__input">
                </div>
                <div class="form-standard__group">
                    <label class="form-standard__label">Fecha Inicio</label>
                    <input type="date" name="price_start_date" value="{{ old('price_start_date') }}" class="form-standard__input">
                </div>
                <div class="form-standard__group">
                    <label class="form-standard__label">Fecha Fin</label>
                    <input type="date" name="price_end_date" value="{{ old('price_end_date') }}" class="form-standard__input">
                </div>
            </div>
        </div>

        {{-- DESCUENTO --}}
        <div class="form-standard__section">
            <h2 class="form-standard__section-title">
                Actualizar Descuento
                @if($product->currentDiscount)
                <span style="font-size: 12px; font-weight: 500; color: #64748b; margin-left: 10px;">
                    (Actual: S/ {{ number_format($product->currentDiscount->amount, 2) }})
                </span>
                @endif
            </h2>

            <div class="form-standard__grid--3 form-standard__grid">
                <div class="form-standard__group">
                    <label class="form-standard__label">Nuevo Monto (S/)</label>
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

        <div class="form-standard__actions" style="margin-top: 30px;">
            <button type="submit" class="stroke-button success">
                Guardar Cambios
            </button>
        </div>
    </form>
</div>
@endsection