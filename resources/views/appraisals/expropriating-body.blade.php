@extends('layouts.app')

@section('title', 'Organismo Expropiante')


@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @include('components.progress-bar', ['step' => 2])

    <h2 class="text-center mb-4">Organismo Expropiante</h2>

    <form method="POST" action="{{ route('appraisals.step3') }}" class="p-4 shadow rounded bg-light">
        @csrf
        <div class="mb-3">
            <label for="nombre_reparticion" class="form-label">Nombre o Repartición:</label>
            <input type="text" name="nombre_reparticion" class="form-control" id="nombre_reparticion" required>
        </div>

        <div class="mb-3">
            <label for="expediente_nro" class="form-label">Expediente Nro:</label>
            <input type="text" name="expediente_nro" class="form-control" id="expediente_nro" required>
        </div>

        <div class="mb-3">
            <label for="fecha_iniciacion" class="form-label">Fecha de Iniciación:</label>
            <input type="date" name="fecha_iniciacion" class="form-control" id="fecha_iniciacion" required>
        </div>

        <button type="submit" class="btn btn-primary">Siguiente <i class="fas fa-arrow-right"></i></button>
    </form>
@endsection
