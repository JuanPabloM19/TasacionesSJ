@extends('layouts.app')

@section('title', 'Actuaciones Judiciales')


@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @include('components.progress-bar-judicial', ['step' => 6])

    <h2 class="text-center mb-4">Actuaciones Judiciales</h2>
    <div class="form-container">
        <form method="POST" action="{{ route('judicial.step6', ['tasacion_id' => $judicial->tasacion_id]) }}" enctype="multipart/form-data" class="p-4 shadow rounded bg-light">
            @csrf
        <div class="mb-3">
            <label for="expediente_nro" class="form-label">Expediente Nro (000-55500-0000):</label>
            <input type="text" name="expediente_nro" class="form-control" id="expediente_nro"
                   value="{{ old('expediente_nro', $judicial->expediente_nro) }}"
                   pattern="\d{3}-\d{5}-\d{4}"
                   required>
        </div>

        <div class="mb-3">
            <label for="fecha_inicio" class="form-label">Fecha Inicio:</label>
            <input type="date" name="fecha_inicio" class="form-control" id="fecha_inicio" value="{{ old('fecha_inicio', $judicial->fecha_inicio) }}" required>
        </div>

        <div class="mb-3">
            <label for="juzgado_interviniente" class="form-label">Juzgado Interviniente:</label>
            <input type="text" name="juzgado_interviniente" class="form-control" id="juzgado_interviniente" value="{{ old('juzgado_interviniente', $judicial->juzgado_interviniente) }}" maxlength="200" required>
        </div>

        <div class="mb-3">
            <label for="caratula" class="form-label">Carátula:</label>
            <input type="text" name="caratula" class="form-control" id="caratula" value="{{ old('caratula', $judicial->caratula) }}" maxlength="200" required>
        </div>

        <div class="mb-3">
            <label for="boleta_deposito" class="form-label">Boleta de Depósito Judicial:</label>
            <input type="file" name="boleta_deposito" class="form-control" id="boleta_deposito" value="{{ old('boleta_deposito', $judicial->boleta_deposito) }}" >
            <input type="text" name="nro_comprobante" class="form-control mt-2" id="nro_comprobante" value="{{ old('nro_comprobante', $judicial->nro_comprobante) }}" maxlength="200" placeholder="Número de Comprobante" >
        </div>

        <div class="mb-3">
            <label for="monto_depositado" class="form-label">Monto depositado:</label>
            <input type="number" name="monto_depositado" class="form-control" id="monto_depositado" value="{{ old('monto_depositado', $judicial->monto_depositado) }}" required>
        </div>

        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones:</label>
            <textarea name="observaciones" class="form-control" id="observaciones" value="{{ old('observaciones', $judicial->observaciones) }}"></textarea>
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
