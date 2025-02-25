@extends('layouts.app')

@section('title', 'Listado de Tasaciones')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">

<div class="container appraisal-container">
    <div class="header-section d-flex justify-content-between align-items-center mb-3">
        <h1>Listado de Tasaciones</h1>
        <button class="btn btn-success export-btn" data-bs-toggle="modal" data-bs-target="#exportModal">
            <i class="fas fa-file-excel"></i> Exportar
        </button>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th>Nomenclatura</th>
                <th>Inscripción de Dominio</th>
                <th>Ubicación</th>
                <th>Nro Plano</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @php
                $tasaciones = [
                    ['id' => 1, 'nomenclatura' => '123-ABC', 'inscripcion_dominio' => '456XYZ', 'ubicacion' => 'San Juan', 'nro_plano' => '789', 'estado' => 'Administrativa'],
                    ['id' => 2, 'nomenclatura' => '456-DEF', 'inscripcion_dominio' => '789XYZ', 'ubicacion' => 'Pocito', 'nro_plano' => '321', 'estado' => 'Judicial'],
                    ['id' => 3, 'nomenclatura' => '789-GHI', 'inscripcion_dominio' => '101XYZ', 'ubicacion' => 'Rawson', 'nro_plano' => '654', 'estado' => 'Finalizado'],
                ];
            @endphp

            @foreach($tasaciones as $tasacion)
                <tr>
                    <td>{{ $tasacion['nomenclatura'] }}</td>
                    <td>{{ $tasacion['inscripcion_dominio'] }}</td>
                    <td>{{ $tasacion['ubicacion'] }}</td>
                    <td>{{ $tasacion['nro_plano'] }}</td>
                    <td>
                        @if($tasacion['estado'] == 'Administrativa')
                            <span class="badge bg-warning">Administrativa</span>
                        @elseif($tasacion['estado'] == 'Judicial')
                            <span class="badge bg-danger">Judicial</span>
                        @else
                            <span class="badge bg-success">Finalizado</span>
                        @endif
                    </td>
                    <td>
                        @if($tasacion['estado'] == 'Administrativa')
                            <a href="{{ route('judicial.step6') }}" class="btn btn-warning action-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Continuar a Judicial">
                                <i class="fas fa-arrow-right"></i> Ir a Judicial
                            </a>
                            <button class="btn btn-success action-btn" data-bs-toggle="modal" data-bs-target="#finalizeModal{{ $tasacion['id'] }}">
                                <i class="fas fa-check"></i> Finalizar
                            </button>
                            <a href="{{ route('appraisals.step1') }}" class="btn btn-primary action-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar Tasación">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <button class="btn btn-danger action-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $loop->index }}" title="Eliminar Tasación">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        @elseif($tasacion['estado'] == 'Judicial')
                            <button class="btn btn-warning action-btn" data-bs-toggle="modal" data-bs-target="#judicialModal{{ $tasacion['id'] }}">
                                <i class="fas fa-plus"></i> Cargar datos
                            </button>
                            <button class="btn btn-success action-btn" data-bs-toggle="modal" data-bs-target="#finalizeModal{{ $tasacion['id'] }}">
                                <i class="fas fa-check"></i> Finalizar
                            </button>
                            <a href="{{ route('judicial.step6') }}" class="btn btn-primary action-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar Tasación">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <button class="btn btn-danger action-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $loop->index }}" title="Eliminar Tasación">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        @else
                            <a href="{{ route('appraisals.step1') }}" class="btn btn-primary action-btn" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar Tasación">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <button class="btn btn-danger action-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $loop->index }}" title="Eliminar Tasación">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        @endif
                    </td>
                </tr>

                <!-- Modal de Finalización -->
                <div class="modal fade" id="finalizeModal{{ $tasacion['id'] }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirmar Finalización</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                ¿Está seguro de que desea finalizar esta tasación?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form>
                                    <button type="submit" class="btn btn-warning">Finalizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal de Carga Judicial -->
                <div class="modal fade" id="judicialModal{{ $tasacion['id'] }}" tabindex="-1" aria-labelledby="judicialModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Cargar Datos Judiciales</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Desea cargar los datos judiciales y continuar?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form action="{{ route('judicial.step6', $tasacion['id']) }}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Cargar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('appraisals.step1') }}" class="btn btn-success add-btn">Agregar Tasación</a>

    <!-- Modal de Exportación -->
    <div class="modal fade" id="exportModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Exportar a Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <label for="dateRange">Seleccione el rango de fechas:</label>
                    <input type="date" id="dateRange" class="form-control mb-3">
                    <label>Seleccione los campos:</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="nomenclatura">
                        <label class="form-check-label" for="nomenclatura">Nomenclatura</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="ubicacion">
                        <label class="form-check-label" for="ubicacion">Ubicación</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-success">Exportar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        font-family: 'Arial', sans-serif;
    }

    .appraisal-container {
        background: white;
        padding: 25px;
        border-radius: 12px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        margin-top: 50px;
    }

    .header-section h1 {
        color: #ff6200;
        font-size: 28px;
    }

    table.table thead th {
        background: #ff6200;
        color: white;
        border: none;
    }

    table.table tbody tr:hover {
        background: #fdf2e9;
    }

    .action-btn, .export-btn, .add-btn {
        transition: all 0.3s ease;
        border-radius: 8px;
        margin-right: 5px;
    }

    .action-btn:hover, .export-btn:hover, .add-btn:hover {
        transform: scale(1.05);
    }

    .badge {
        font-size: 0.9rem;
        padding: 0.5em 0.8em;
        border-radius: 12px;
    }

    .modal-header {
        background: #ff6200;
        color: white;
    }

    .modal-header .btn-close {
        filter: invert(1);
    }
</style>
@endsection
