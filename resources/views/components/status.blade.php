@props(['value'])

<span class="{{ $value ? 'status-success' : 'status-danger' }}">
    {{ $value ? 'Activo' : 'Inactivo' }}
</span>