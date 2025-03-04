@extends('layouts.app')

@section('title', 'Aceptación de Monto Acordado')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @include('components.progress-bar', ['step' => 5])

    <h2 class="text-center mb-4">Aceptación de Monto Acordado</h2>

    <div class="form-container">
    <form method="POST" action="{{ route('appraisals.step5', ['id' => $tasacion->id]) }}" class="p-4 shadow rounded bg-light" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="incremento_10" class="form-label">Incremento del 10%:</label>
            <select name="incremento" class="form-select" id="incremento" required>
                <option value="1" {{ old('incremento', $tasacion->incremento) == 1 ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ old('incremento', $tasacion->incremento) == 0 ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="aceptacion" class="form-label">Aceptación:</label>
            <select name="aceptacion" class="form-select" id="aceptacion" required>
                <option value="1" {{ old('aceptacion', $tasacion->aceptacion) == 1 ? 'selected' : '' }}>Sí</option>
                <option value="0" {{ old('aceptacion', $tasacion->aceptacion) == 0 ? 'selected' : '' }}>No</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="convenio_avenamiento" class="form-label">Convenio de Avenamiento (PDF/Word):</label>
            <input type="file" name="convenio_avenamiento" class="form-control" id="convenio_avenamiento" accept=".pdf,.doc,.docx">
        </div>

        <div class="mb-3">
            <label for="monto_pagado" class="form-label">Monto Pagado:</label>
            <input type="number" name="monto_pagado" class="form-control" id="monto_pagado" value="{{ old('monto_pagado', $tasacion->monto_pagado) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Finalizar <i class="fas fa-check-circle"></i></button>
    </form>
</div>
<div class="form-container alert alert-info d-flex align-items-center mt-4 p-3" style="background-color: #d9edf7; border-left: 5px solid #31708f; color: #31708f;">
    <i class="fas fa-lightbulb me-2" style="font-size: 24px;"></i>
    <div>
        <strong>Guardado Automático:</strong> Haga clic en <b>"Siguiente"</b> y sus datos se guardarán para poder continuar en otro momento.
    </div>
</div>
@endsection
