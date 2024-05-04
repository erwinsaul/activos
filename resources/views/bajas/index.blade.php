@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Bajas</h1> 
    <a href="{{ route('activos.index') }}" class="btn btn-secondary mb-3">Regresar</a>   
    <table class="table mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Activo</th>
                <th>Cantidad</th>
                <th>Motivo</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bajas as $baja)
            <tr>
                <td>{{ $baja->id }}</td>
                <td>{{ $baja->activo->nombre }}</td>                
                <td>{{ $baja->cantidad }}</td>
                <td>{{ $baja->motivo }}</td>
                <td>{{ $baja->fecha }}</td>                                
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
