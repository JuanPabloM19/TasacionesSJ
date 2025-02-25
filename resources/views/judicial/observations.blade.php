@extends('layouts.app')

@section('title', 'Observaciones')


@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @include('components.progress-bar-judicial', ['step' => 10])

    <h2 class="text-center mb-4">Observaciones</h2>
    <form method="POST" action="{{ route('judicial.finish') }}" enctype="multipart/form-data" class="p-4 shadow rounded bg-light">
        @csrf
        <div class="mb-3">
            <label for="observaciones" class="form-label">Observaciones:</label>
            <textarea name="observaciones" class="form-control" id="observaciones"></textarea>
        </div>

        <div class="mb-3">
            <label for="archivo_observaciones" class="form-label">Subir Archivo:</label>
            <input type="file" name="archivo_observaciones" class="form-control" id="archivo_observaciones">
        </div>

        <button type="submit" class="btn btn-primary">Finalizar <i class="fas fa-check"></i></button>
    </form>
@endsection
