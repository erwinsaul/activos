@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Crear Baja</h1>
    <form method="POST" action="{{ route('bajas.store') }}">
        @csrf
        <div class="form-group">
            <label for="nombre_activo">Activo:</label>
            <input type="text" id="nombre_activo" name="nombre_activo" value="{{ $activo->nombre }}" readonly class="form-control">
        </div>
        <div class="form-group">
            <label for="activo_id">Activo:</label>
            <input type="text" id="activo_id" name="activo_id" value="{{ $activo->id }}" readonly class="form-control">
        </div>
        <div class="form-group">
            <label for="cantidad_inicial">Cantidad Inicial:</label>
            <input type="text" id="cantidad_inicial" name="cantidad_inicial" value="{{ $activo->cantidad_inicial }}" readonly class="form-control">
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="motivo">Motivo:</label>
            <select class="form-control" id="motivo" name="motivo">
                <option value="Pérdida">Pérdida</option>
                <option value="Fin vida útil">Fin vida útil</option>
                <option value="Deshuso">Deshuso</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear Baja</button>
    </form>
</div>
@endsection
