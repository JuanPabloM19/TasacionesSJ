@extends('layouts.app')

@section('title', 'Ley de Utilidad Pública')


@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @include('components.progress-bar', ['step' => 3])

    <h2 class="text-center mb-4">Ley de Utilidad Pública</h2>

    <form method="POST" action="{{ route('appraisals.step3', ['id' => $tasacion->id]) }}" class="p-4 shadow rounded bg-light" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="numero" class="form-label">Número:</label>
            <input type="number" name="numero" class="form-control" id="numero" value="{{ old('numero', $tasacion->numero) }}" required>
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha:</label>
            <input type="date" name="fecha" class="form-control" id="fecha" value="{{ old('fecha', $tasacion->fecha) }}" required>
        </div>

        <div class="mb-3">
            <label for="boletin_oficial" class="form-label">Boletín Oficial:</label>
            <input type="text" name="boletin_oficial" class="form-control" id="boletin_oficial" value="{{ old('boletin_oficial', $tasacion->boletin_oficial) }}" required>
        </div>

        <div class="mb-3">
            <label for="ley_documento" class="form-label">Ingresar Ley (PDF/Word):</label>
            <input type="file" name="ley_documento" class="form-control" id="ley_documento" accept=".pdf,.doc,.docx">
        </div>

        <button type="submit" class="btn btn-primary">Siguiente <i class="fas fa-arrow-right"></i></button>
    </form>
@endsection
