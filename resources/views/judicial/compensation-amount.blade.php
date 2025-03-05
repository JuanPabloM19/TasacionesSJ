@extends('layouts.app')
@section('title', 'Monto Indemnizatorio a Pagar')


@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @include('components.progress-bar-judicial', ['step' => 7])

    <h2 class="text-center mb-4">Monto Indemnizatorio a Pagar</h2>
    <div class="form-container">
    <form method="POST" action="{{ route('judicial.step7', ['tasacion_id' => $judicial->tasacion_id]) }}" class="p-4 shadow rounded bg-light">
        @csrf
        <div class="mb-3">
            <label for="dictamen_expediente" class="form-label">Dictamen del TTP - Nro Expediente:</label>
            <input type="text" name="dictamen_expediente" class="form-control" id="dictamen_expediente" value="{{ old('dictamen_expediente', $judicial->dictamen_expediente) }}" required>
        </div>

        <div class="mb-3">
            <label for="dictamen_fecha" class="form-label">Fecha:</label>
            <input type="date" name="dictamen_fecha" class="form-control" id="dictamen_fecha" value="{{ old('dictamen_fecha', $judicial->dictamen_fecha) }}" required>
        </div>

        <div class="mb-3">
            <label for="dictamen_monto" class="form-label">Monto:</label>
            <input type="number" name="dictamen_monto" class="form-control" id="dictamen_monto" value="{{ old('dictamen_monto', $judicial->dictamen_monto) }}" required>
        </div>

        <div class="mb-3">
            <label for="orden_pago_fecha" class="form-label">Ordenado a pagar - Fecha:</label>
            <input type="date" name="orden_pago_fecha" class="form-control" id="orden_pago_fecha" value="{{ old('orden_pago_fecha', $judicial->orden_pago_fecha) }}" required>
        </div>

        <div class="mb-3">
            <label for="orden_pago_monto" class="form-label">Monto:</label>
            <input type="number" name="orden_pago_monto" class="form-control" id="orden_pago_monto" value="{{ old('orden_pago_monto', $judicial->orden_pago_monto) }}" required>
        </div>

        <div class="mb-3">
            <label for="instrumento_legal" class="form-label">Instrumento Legal:</label>
            <input type="text" name="instrumento_legal" class="form-control" id="instrumento_legal" value="{{ old('instrumento_legal', $judicial->instrumento_legal) }}" required>
        </div>

        <div class="mb-3">
            <label for="concepto_indemnizacion" class="form-label">Concepto Incluido de Indemnización:</label>
            <textarea name="concepto_indemnizacion" class="form-control" id="concepto_indemnizacion" value="{{ old('concepto_indemnizacion', $judicial->concepto_indemnizacion) }}"></textarea>
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
