@extends('layouts.app')

@section('title', 'Individualización de Inmuebles')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @include('components.progress-bar', ['step' => 1]) {{-- Muestra la barra con el primer paso activo --}}

    <h2 class="text-center mb-4">Individualización de Inmuebles</h2>

    <div class="form-container">
    <form method="POST" action="{{ route('appraisals.step1') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="nomenclatura" class="form-label">Nomenclatura:</label>
            <input type="text" name="nomenclatura" class="form-control" id="nomenclatura" value="{{ old('nomenclatura', $tasacion->nomenclatura) }}" required>
        </div>

        <div class="mb-3">
            <label for="inscripcion_dominio" class="form-label">Inscripción de Dominio:</label>
            <input type="text" name="inscripcion_dominio" class="form-control" id="inscripcion_dominio" value="{{ old('inscripcion_dominio', $tasacion->inscripcion_dominio) }}" required>
        </div>

        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación:</label>
            <input type="text" name="ubicacion" class="form-control" id="ubicacion" value="{{ old('ubicacion', $tasacion->ubicacion) }}" required>
        </div>

        <div class="mb-3">
            <label for="propietarios" class="form-label">Propietarios:</label>
            <input type="text" name="propietarios" class="form-control" id="propietarios" value="{{ old('propietarios', $tasacion->propietarios) }}" required>
        </div>

        <div class="mb-3">
            <label for="nro_plano" class="form-label">Número de Plano:</label>
            <input type="text" name="nro_plano" class="form-control" id="nro_plano" value="{{ old('nro_plano', $tasacion->nro_plano) }}" required>
        </div>

        <div class="mb-3">
            <label for="superficie_total" class="form-label">Superficie Total:</label>
            <input type="number" name="superficie_total" class="form-control" id="superficie_total" value="{{ old('superficie_total', $tasacion->superficie_total) }}" required>
        </div>

        <div class="mb-3">
            <label for="fraccion_expropiar" class="form-label">Fracción a expropiar:</label>
            <input type="number" name="fraccion_expropiar" class="form-control" id="fraccion_expropiar" value="{{ old('fraccion_expropiar', $tasacion->fraccion_expropiar) }}" required>
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
