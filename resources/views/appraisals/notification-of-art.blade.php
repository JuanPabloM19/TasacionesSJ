@extends('layouts.app')

@section('title', 'Notificación de Acto Expropiatorio')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @include('components.progress-bar', ['step' => 4])

    <h2 class="text-center mb-4">Notificación de Acto Expropiatorio</h2>

    <form method="POST" action="{{ route('appraisals.step5') }}" class="p-4 shadow rounded bg-light">
        @csrf
        <div class="mb-3">
            <label for="nombre_reparticion" class="form-label">Número Expediente:</label>
            <input type="text" name="nombre_reparticion" class="form-control" id="nombre_reparticion" required>
        </div>

        <div class="mb-3">
            <label for="monto_acordado" class="form-label">Monto Acordado:</label>
            <input type="text" name="monto_acordado" class="form-control" id="monto_acordado" required>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha:</label>
            <input type="date" name="fecha" class="form-control" id="fecha" required>
        </div>

        <div class="mb-3">
            <label for="acta_numero" class="form-label">Acta Número:</label>
            <input type="number" name="acta_numero" class="form-control" id="acta_numero" required>
        </div>

        <button type="submit" class="btn btn-primary">Siguiente <i class="fas fa-arrow-right"></i></button>
    </form>
@endsection
