@extends('layouts.app')
@section('content')
    @include('components.progress-bar-judicial', ['step' => 9])

    <h2 class="text-center mb-4">Boletín Oficial</h2>
    <form method="POST" action="{{ route('judicial.step10') }}" enctype="multipart/form-data" class="p-4 shadow rounded bg-light">
        @csrf
        <div class="mb-3">
            <label for="boletin_numero" class="form-label">Número:</label>
            <input type="text" name="boletin_numero" class="form-control" id="boletin_numero" required>
        </div>

        <div class="mb-3">
            <label for="boletin_fecha" class="form-label">Fecha:</label>
            <input type="date" name="boletin_fecha" class="form-control" id="boletin_fecha" required>
        </div>

        <div class="mb-3">
            <label for="boletin_archivo" class="form-label">Archivo Boletín:</label>
            <input type="file" name="boletin_archivo" class="form-control" id="boletin_archivo">
        </div>

        <button type="submit" class="btn btn-primary">Siguiente <i class="fas fa-arrow-right"></i></button>
    </form>
@endsection
