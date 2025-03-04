@extends('layouts.app')
@section('title', 'Boletín Oficial')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @include('components.progress-bar-judicial', ['step' => 9])

    <h2 class="text-center mb-4">Boletín Oficial</h2>
    <div class="form-container">
    <form method="POST" action="{{ route('judicial.step10', ['tasacion_id' => $judicial->tasacion_id]) }}" enctype="multipart/form-data" class="p-4 shadow rounded bg-light">
        @csrf
        <div class="mb-3">
            <label for="boletin_numero" class="form-label">Número:</label>
            <input type="text" name="boletin_numero" class="form-control" id="boletin_numero" value="{{ old('boletin_numero', $judicial->boletin_numero) }}" required>
        </div>

        <div class="mb-3">
            <label for="boletin_fecha" class="form-label">Fecha:</label>
            <input type="date" name="boletin_fecha" class="form-control" id="boletin_fecha" value="{{ old('boletin_fecha', $judicial->boletin_fecha) }}" required>
        </div>

        <div class="mb-3">
            <label for="boletin_archivo" class="form-label">Archivo Boletín:</label>
            <input type="file" name="boletin_archivo" class="form-control" id="boletin_archivo" value="{{ old('boletin_archivo', $judicial->boletin_archivo) }}">
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
