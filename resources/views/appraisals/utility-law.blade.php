@extends('layouts.app')

@section('title', 'Ley de Utilidad Pública')


@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @include('components.progress-bar', ['step' => 3])

    <h2 class="text-center mb-4">Ley de Utilidad Pública</h2>

    <div class="form-container">
    <form method="POST" action="{{ route('appraisals.step3', ['id' => $tasacion->id]) }}" class="p-4 shadow rounded bg-light" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="numero_ley" class="form-label">Número:</label>
            <input type="text" name="numero_ley" class="form-control" id="numero_ley"
                   value="{{ old('numero_ley', $tasacion->numero_ley) }}"
                   maxlength="200" required>
        </div>

        <div class="mb-3">
            <label for="fecha_ley" class="form-label">Fecha:</label>
            <input type="date" name="fecha_ley" class="form-control" id="fecha_ley" value="{{ old('fecha_ley', $tasacion->fecha_ley) }}" required>
        </div>

        <div class="mb-3">
            <label for="boletin_oficial" class="form-label">Boletín Oficial (Texto o PDF/Word):</label>
            <input type="text" name="boletin_oficial" class="form-control mb-2" id="boletin_oficial"
                   value="{{ old('boletin_oficial', $tasacion->boletin_oficial) }}"
                   placeholder="Ingrese el boletín oficial o suba un archivo">

            <input type="file" name="boletin_oficial_archivo" class="form-control"
                   id="boletin_oficial_archivo" accept=".pdf,.doc,.docx">
        </div>

        <div class="mb-3">
            <label for="ley_documento" class="form-label">Ingresar Ley (PDF/Word):</label>
            <input type="file" name="ley_documento" class="form-control" id="ley_documento" accept=".pdf,.doc,.docx">
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
