@extends('layouts.app-layout')

@section('title', 'Categorias')
@section('header_title', 'Crud de Categorias')

@section('content')

<section class="category-section">

    @if (session('alert'))
    <x-alerts.toast
        :variant="session('alert')['variant']"
        :code="session('alert')['code']"
        :message="session('alert')['message']" />
    @endif

    <a class="category-link" href="{{ route('category.create') }}">
        Nueva categoría
    </a>

    <div class="category-section__table-wrapper">

        @if(empty($categories))
            <x-alerts.toast
                variant="info"
                code="200"
                message="No hay registros disponibles" />
        @else
        <table class="category-table" border="1" cellpadding="5" cellspacing="0">
            <thead class="category-table__head">
                <tr class="category-table__row">
                    <th class="category-table__cell">ID</th>
                    <th class="category-table__cell">Nombre</th>
                    <th class="category-table__cell">Estado</th>
                    <th class="category-table__cell">Acciones</th>
                </tr>
            </thead>

            <tbody class="category-table__body">
                @foreach($categories as $category)
                <tr class="category-table__row">
                    <td class="category-table__cell">{{ $category->id }}</td>
                    <td class="category-table__cell">{{ $category->name }}</td>
                    <td class="category-table__cell">
                        <x-badges.status :value="$category->status" />
                    </td>
                    <td class="category-table__cell"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

    </div>

</section>

@endsection