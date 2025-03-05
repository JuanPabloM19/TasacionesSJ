@extends('layouts.app')

@section('title', 'Observaciones')


@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @include('components.progress-bar-judicial', ['step' => 10])

    <h2 class="text-center mb-4">Observaciones</h2>
    <div class="form-container">
    <form method="POST" action="{{ route('judicial.step10', ['tasacion_id' => $judicial->tasacion_id]) }}" enctype="multipart/form-data" class="p-4 shadow rounded bg-light">
        @csrf
        <div class="mb-3">
            <label for="observaciones_finales" class="form-label">Observaciones:</label>
            <textarea name="observaciones_finales" class="form-control" id="observaciones_finales" value="{{ old('observaciones_finales', $judicial->observaciones_finales) }}"></textarea>
        </div>

        <div class="mb-3">
            <label for="archivo_observaciones" class="form-label">Subir Archivo:</label>
            <input type="file" name="archivo_observaciones" class="form-control" id="archivo_observaciones value="{{ old('archivo_observaciones', $judicial->archivo_observaciones) }}"">
        </div>

        <button type="submit" class="btn btn-primary">Finalizar <i class="fas fa-check"></i></button>
    </form>
</div>
<div class="form-container alert alert-info d-flex align-items-center mt-4 p-3" style="background-color: #d9edf7; border-left: 5px solid #31708f; color: #31708f;">
    <i class="fas fa-lightbulb me-2" style="font-size: 24px;"></i>
    <div>
        <strong>Guardado Automático:</strong> Haga clic en <b>"Siguiente"</b> y sus datos se guardarán para poder continuar en otro momento.
    </div>
</div>
@endsection
