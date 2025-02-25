@extends('layouts.app')

@section('content')
    @include('components.progress-bar-judicial', ['step' => 6])

    <h2 class="text-center mb-4">Actuaciones Judiciales</h2>
    <form method="POST" action="{{ route('judicial.step7') }}" enctype="multipart/form-data" class="p-4 shadow rounded bg-light">
        @csrf
        <div class="mb-3">
            <label for="expediente_nro" class="form-label">Expediente Nro:</label>
            <input type="text" name="expediente_nro" class="form-control" id="expediente_nro" required>
        </div>

        <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha Inicio:</label>
            <input type="date" name="fecha_inicio" class="form-control" id="fecha_inicio" required>
        </div>

        <div class="mb-3">
            <label for="juzgado_interviniente" class="form-label">Juzgado Interviniente:</label>
            <input type="text" name="juzgado_interviniente" class="form-control" id="juzgado_interviniente" required>
        </div>

        <div class="mb-3">
            <label for="caratula" class="form-label">Carátula:</label>
            <input type="text" name="caratula" class="form-control" id="caratula" required>
        </div>

        <div class="mb-3">
            <label for="boleta_deposito" class="form-label">Boleta de Depósito Judicial:</label>
            <input type="file" name="boleta_deposito" class="form-control" id="boleta_deposito">
            <input type="text" name="nro_comprobante" class="form-control mt-2" id="nro_comprobante" placeholder="Número de Comprobante">
        </div>

        <div class="mb-3">
            <label for="monto_depositado" class="form-label">Monto depositado:</label>
            <input type="number" name="monto_depositado" class="form-control" id="monto_depositado" required>
        </div>

        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones:</label>
            <textarea name="observaciones" class="form-control" id="observaciones"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Siguiente <i class="fas fa-arrow-right"></i></button>
    </form>
@endsection
