@extends('layouts.app')

@section('title', content: 'Precarga Judicial')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <h2 class="text-center mb-4">Ingresar Precarga Judicial</h2>
    <div class="form-container">
    <form action="{{ route('appraisals.judicial.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="nomenclatura" class="form-label">Nomenclatura (15 dígitos):</label>
            <input type="text" name="nomenclatura" class="form-control" id="nomenclatura"
                   value="{{ old('nomenclatura') }}"
                   maxlength="15" pattern="\d{15}" required>
        </div>

        <div class="mb-3">
            <label for="inscripcion_dominio" class="form-label">Inscripción de Dominio:</label>
            <input type="text" name="inscripcion_dominio" class="form-control" id="inscripcion_dominio" value="{{ old('inscripcion_dominio') }}" maxlength="200" required>
        </div>

        <div class="mb-3">
            <label for="ubicacion" class="form-label">Ubicación:</label>
            <input type="text" name="ubicacion" class="form-control" id="ubicacion" value="{{ old('ubicacion') }}" maxlength="200" required>
        </div>

        <div class="mb-3">
            <label for="propietarios" class="form-label">Propietarios:</label>
            <input type="text" name="propietarios" class="form-control" id="propietarios" value="{{ old('propietarios') }}" maxlength="200" required>
        </div>

        <div class="mb-3">
            <label for="nro_plano" class="form-label">Número de Plano (01/00000/0000):</label>
            <input type="text" name="nro_plano" class="form-control" id="nro_plano"
                   value="{{ old('nro_plano') }}"
                   pattern="\d{2}/\d{5}/\d{4}" required>
        </div>

        <div class="mb-3">
            <label for="superficie_total" class="form-label">Superficie Total:</label>
            <div class="input-group">
                <input type="number" name="superficie_total" class="form-control" id="superficie_total"
                       value="{{ old('superficie_total') }}" required>
                <select name="unidad_superficie" class="form-select">
                    <option value="m2" {{ old('unidad_superficie') == 'm2' ? 'selected' : '' }}>m²</option>
                    <option value="ha" {{ old('unidad_superficie') == 'ha' ? 'selected' : '' }}>ha</option>
                </select>
            </div>
        </div>
        <div class="mb-3">
            <label for="fraccion_expropiar" class="form-label">Fracción a expropiar:</label>
            <input type="text" name="fraccion_expropiar" class="form-control" id="fraccion_expropiar" value="{{ old('fraccion_expropiar') }}"  maxlength="200" required>
        </div>
        <div class="mb-3">
            <label for="nombre_reparticion" class="form-label">Nombre o Repartición:</label>
            <input type="text" name="nombre_reparticion" class="form-control" id="nombre_reparticion"
                   value="{{ old('nombre_reparticion') }}"
                   maxlength="200" required>
        </div>

        <div class="mb-3">
            <label for="expediente_nro" class="form-label">Expediente Nro (000-55500-0000):</label>
            <input type="text" name="expediente_nro" class="form-control" id="expediente_nro"
                   value="{{ old('expediente_nro') }}"
                   pattern="\d{3}-\d{5}-\d{4}"
                   required>
        </div>

        <div class="mb-3">
            <label for="fecha_iniciacion" class="form-label">Fecha de Iniciación:</label>
            <input type="date" name="fecha_iniciacion" class="form-control" id="fecha_iniciacion" value="{{ old('fecha_iniciacion') }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Continuar</button>
    </form>
    </div>
@endsection
