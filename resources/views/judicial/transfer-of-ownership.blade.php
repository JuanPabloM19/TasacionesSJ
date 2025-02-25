@extends('layouts.app')

@section('title', 'Transferencia de Dominio')


@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    @include('components.progress-bar-judicial', ['step' => 8])

    <h2 class="text-center mb-4">Transferencia de Dominio</h2>
    <form method="POST" action="{{ route('judicial.step9') }}" class="p-4 shadow rounded bg-light">
        @csrf
        <div class="mb-3">
            <label for="dominio_publico" class="form-label">Dominio Público Provincial:</label>
            <input type="text" name="dominio_publico" class="form-control" id="dominio_publico" required>
        </div>

        <div class="mb-3">
            <label for="dominio_privado" class="form-label">Dominio Privado Provincial:</label>
            <input type="text" name="dominio_privado" class="form-control" id="dominio_privado" required>
        </div>

        <button type="submit" class="btn btn-primary">Siguiente <i class="fas fa-arrow-right"></i></button>
    </form>
@endsection
