@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Activos</h1>
    <div class="mb-3">
        <a href="{{ route('activos.create') }}" class="btn btn-success">Agregar Nuevo Activo</a>
    </div>
    <div class="mb-3">
        <a href="{{ route('bajas.index') }}" class="btn btn-secondary">Listar Todas las Bajas</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Cantidad Inicial</th>
                <th>Cantidad Actual</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($activos as $activo)
            <tr>
                <td>{{ $activo->codigo }}</td>
                <td>{{ $activo->nombre }}</td>
                <td>{{ $activo->descripcion }}</td>
                <td>{{ $activo->cantidad_inicial }}</td>
                <td>{{ $activo->stock_actual }}</td>
                <td>                    
                    <a href="{{ route('activos.edit', $activo->id) }}" class="btn btn-primary">Editar</a>
                    @if($activo->stock_actual == 0)                    
                        <button class="btn btn-primary" class="btn btn-danger" disabled>Dar Baja</button>
                    @else                        
                        <a href="{{ route('bajas.create', ['id_activo' => $activo->id]) }}" class="btn btn-danger">Dar Baja</a>
                    @endif
                    
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
