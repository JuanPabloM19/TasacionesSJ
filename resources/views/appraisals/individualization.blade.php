@extends('layouts.app')

@section('content')
    @include('components.progress-bar', ['step' => 1]) {{-- Muestra la barra con el primer paso activo --}}

    <h2 class="text-center mb-4">Individualización de Inmuebles</h2>

    <form method="POST" action="{{ route('appraisals.step2') }}" class="p-4 shadow rounded bg-light">
        @csrf
        <div class="mb-3">
            <label for="nomenclatura" class="form-label">Nomenclatura:</label>
            <input type="text" name="nomenclatura" class="form-control" id="nomenclatura" required>
        </div>

        <div class="mb-3">
            <label for="inscripcion_dominio" class="form-label">Inscripción de Dominio:</label>
            <input type="text" name="inscripcion_dominio" class="form-control" id="inscripcion_dominio" required>
        </div>

        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación:</label>
            <input type="text" name="ubicacion" class="form-control" id="ubicacion" required>
        </div>

        <div class="mb-3">
            <label for="propietarios" class="form-label">Propietarios:</label>
            <input type="text" name="propietarios" class="form-control" id="propietarios" required>
        </div>

        <div class="mb-3">
            <label for="nro_plano" class="form-label">Número de Plano:</label>
            <input type="text" name="nro_plano" class="form-control" id="nro_plano" required>
        </div>

        <div class="mb-3">
            <label for="superficie_total" class="form-label">Superficie Total:</label>
            <input type="number" name="superficie_total" class="form-control" id="superficie_total" required>
        </div>

        <div class="mb-3">
            <label for="fraccion_expropiar" class="form-label">Fracción a expropiar:</label>
            <input type="number" name="fraccion_expropiar" class="form-control" id="fraccion_expropiar" required>
        </div>

        <button type="submit" class="btn btn-primary">Siguiente <i class="fas fa-arrow-right"></i></button>
    </form>
@endsection
