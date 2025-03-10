@extends('layouts.app')

@section('title', 'Organismo Expropiante')


@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @include('components.progress-bar', ['step' => 2])

    <h2 class="text-center mb-4">Organismo Expropiante</h2>

    <div class="form-container">
    <form method="POST" action="{{ route('appraisals.step2', ['id' => $tasacion->id]) }}" class="p-4 shadow rounded bg-light" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nombre_reparticion" class="form-label">Nombre o Repartición:</label>
            <input type="text" name="nombre_reparticion" class="form-control" id="nombre_reparticion"
                   value="{{ old('nombre_reparticion', $tasacion->nombre_reparticion) }}"
                   maxlength="200" required>
        </div>

        <div class="mb-3">
            <label for="expediente_nro" class="form-label">Expediente Nro (000-55500-0000):</label>
            <input type="text" name="expediente_nro" class="form-control" id="expediente_nro"
                   value="{{ old('expediente_nro', $tasacion->expediente_nro) }}"
                   pattern="\d{3}-\d{5}-\d{4}"
                   required>
        </div>

        <div class="mb-3">
            <label for="fecha_iniciacion" class="form-label">Fecha de Iniciación:</label>
            <input type="date" name="fecha_iniciacion" class="form-control" id="fecha_iniciacion" value="{{ old('fecha_iniciacion', $tasacion->fecha_iniciacion) }}" required>
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
