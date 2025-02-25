@extends('layouts.app')

@section('title', 'Aceptación de Monto Acordado')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @include('components.progress-bar', ['step' => 5])

    <h2 class="text-center mb-4">Aceptación de Monto Acordado</h2>

    <form method="POST" action="{{ route('appraisals.finish') }}" class="p-4 shadow rounded bg-light" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="incremento_10" class="form-label">Incremento del 10%:</label>
            <select name="incremento_10" class="form-select" id="incremento_10" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="aceptacion" class="form-label">Aceptación:</label>
            <select name="aceptacion" class="form-select" id="aceptacion" required>
                <option value="1">Sí</option>
                <option value="0">No</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="convenio_avenamiento" class="form-label">Convenio de Avenamiento (PDF/Word):</label>
            <input type="file" name="convenio_avenamiento" class="form-control" id="convenio_avenamiento" accept=".pdf,.doc,.docx" required>
        </div>

        <div class="mb-3">
            <label for="monto_pagado" class="form-label">Monto Pagado:</label>
            <input type="number" name="monto_pagado" class="form-control" id="monto_pagado" required>
        </div>

        <button type="submit" class="btn btn-primary">Finalizar <i class="fas fa-check-circle"></i></button>
    </form>
@endsection
