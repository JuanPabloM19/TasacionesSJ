@extends('layouts.app')

@section('title', 'Notificación de Acto Expropiatorio')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @include('components.progress-bar', ['step' => 4])

    <h2 class="text-center mb-4">Notificación de Acto Expropiatorio</h2>

    <div class="form-container">
    <form method="POST" action="{{ route('appraisals.step4', ['id' => $tasacion->id]) }}" class="p-4 shadow rounded bg-light">
        @csrf
        <div class="mb-3">
            <label for="numero_exp" class="form-label">Número Expediente:</label>
            <input type="number" name="numero_exp" class="form-control" id="numero_exp" value="{{ old('numero_exp', $tasacion->numero_exp) }}" required>
        </div>

        <div class="mb-3">
            <label for="monto_acordado" class="form-label">Monto Acordado:</label>
            <input type="number" name="monto_acordado" class="form-control" id="monto_acordado" value="{{ old('monto_acordado', $tasacion->monto_acordado) }}" required>
        </div>

        <div class="mb-3">
            <label for="fecha_notificacion" class="form-label">Fecha:</label>
            <input type="date" name="fecha_notificacion" class="form-control" id="fecha_notificacion" value="{{ old('fecha_notificacion', $tasacion->fecha_notificacion) }}" required>
        </div>

        <div class="mb-3">
            <label for="acta_numero" class="form-label">Acta Número:</label>
            <input type="text" name="acta_numero" class="form-control" id="acta_numero" value="{{ old('acta_numero', $tasacion->acta_numero) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Siguiente <i class="fas fa-arrow-right"></i></button>
    </form>
</div>
<div class="form-container alert alert-info d-flex align-items-center mt-4 p-3" style="background-color: #d9edf7; border-left: 5px solid #31708f; color: #31708f;">
    <i class="fas fa-lightbulb me-2" style="font-size: 24px;"></i>
    <div>
        <strong>Guardado Automático:</strong> Haga clic en <b>"Siguiente"</b> y sus datos se guardarán para poder continuar en otro momento.
    </div>
</div>
@endsection
