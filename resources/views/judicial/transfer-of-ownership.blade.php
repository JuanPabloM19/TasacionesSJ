@extends('layouts.app')

@section('title', 'Transferencia de Dominio')


@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @include('components.progress-bar-judicial', ['step' => 8])

    <h2 class="text-center mb-4">Transferencia de Dominio</h2>
    <div class="form-container">
    <form method="POST" action="{{ route('judicial.step8', ['tasacion_id' => $judicial->tasacion_id]) }}" class="p-4 shadow rounded bg-light" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="dominio_publico" class="form-label">Dominio Público Provincial:</label>
            <input type="text" name="dominio_publico" class="form-control mb-2"
                   id="dominio_publico"
                   value="{{ old('dominio_publico', $judicial->dominio_publico) }}"
                   placeholder="Ingrese la resolución o adjunte un archivo">

            <input type="file" name="dominio_publico_pdf" class="form-control"
                   id="dominio_publico_pdf" accept=".pdf">
        </div>

        <div class="mb-3">
            <label for="dominio_privado" class="form-label">Dominio Privado Provincial:</label>
            <input type="text" name="dominio_privado" class="form-control mb-2"
                   id="dominio_privado"
                   value="{{ old('dominio_privado', $judicial->dominio_privado) }}"
                   placeholder="Ingrese la resolución o adjunte un archivo">

            <input type="file" name="dominio_privado_pdf" class="form-control"
                   id="dominio_privado_pdf" accept=".pdf">
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
