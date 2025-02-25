@extends('layouts.app')

@section('content')
    @include('components.progress-bar-judicial', ['step' => 7])

    <h2 class="text-center mb-4">Monto Indemnizatorio a Pagar</h2>
    <form method="POST" action="{{ route('judicial.step8') }}" class="p-4 shadow rounded bg-light">
        @csrf
        <div class="mb-3">
            <label for="dictamen_expediente" class="form-label">Dictamen del TTP - Nro Expediente:</label>
            <input type="text" name="dictamen_expediente" class="form-control" id="dictamen_expediente" required>
        </div>

        <div class="mb-3">
            <label for="dictamen_fecha" class="form-label">Fecha:</label>
            <input type="date" name="dictamen_fecha" class="form-control" id="dictamen_fecha" required>
        </div>

        <div class="mb-3">
            <label for="dictamen_monto" class="form-label">Monto:</label>
            <input type="number" name="dictamen_monto" class="form-control" id="dictamen_monto" required>
        </div>

        <div class="mb-3">
            <label for="orden_pago_fecha" class="form-label">Ordenado a pagar - Fecha:</label>
            <input type="date" name="orden_pago_fecha" class="form-control" id="orden_pago_fecha" required>
        </div>

        <div class="mb-3">
            <label for="orden_pago_monto" class="form-label">Monto:</label>
            <input type="number" name="orden_pago_monto" class="form-control" id="orden_pago_monto" required>
        </div>

        <div class="mb-3">
            <label for="instrumento_legal" class="form-label">Instrumento Legal:</label>
            <input type="text" name="instrumento_legal" class="form-control" id="instrumento_legal" required>
        </div>

        <div class="mb-3">
            <label for="concepto_indemnizacion" class="form-label">Concepto Incluido de Indemnización:</label>
            <textarea name="concepto_indemnizacion" class="form-control" id="concepto_indemnizacion"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Siguiente <i class="fas fa-arrow-right"></i></button>
    </form>
@endsection
