@extends('layouts.app')

@section('title', 'Listado de Tasaciones')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<div class="container appraisal-container">
    <div class="header-section d-flex justify-content-between align-items-center mb-3">
        <h1>Listado de Tasaciones</h1>
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-success export-btn" data-bs-toggle="modal" data-bs-target="#exportModal">
                <i class="fas fa-file-excel"></i> Exportar
            </button>
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="filterMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="filterMenuButton">
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#searchModal"><i class="fas fa-search"></i> Buscar por Nomenclatura</a></li>
                    <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#filterModal"><i class="fas fa-filter"></i> Filtrar por Estado</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="table-responsive">
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
                @foreach($tasaciones as $tasacion)
                    <tr>
                        <td>{{ $tasacion->nomenclatura }}</td>
                        <td>{{ $tasacion->inscripcion_dominio }}</td>
                        <td>{{ $tasacion->ubicacion }}</td>
                        <td>{{ $tasacion->nro_plano }}</td>
                        <td>
                            @switch($tasacion->estado)
                                @case('step1')
                                    Individualización de Inmuebles (STEP 1)
                                    @break
                                @case('step2')
                                    Organismo Expropiante (STEP 2)
                                    @break
                                @case('step3')
                                    Ley de Utilidad Pública (STEP 3)
                                    @break
                                @case('step4')
                                    Notificación Acto Expropiatorio (STEP 4)
                                    @break
                                @case('step5')
                                    Aceptación del Monto (STEP 5)
                                    @break
                                @case('completed')
                                    Completado
                                    @break
                                @default
                                    Estado Desconocido
                            @endswitch
                        </td>
                        <td>
                            @if($tasacion->estado != 'completed')
                                <a href="{{ route('appraisals.step' . (substr($tasacion->estado, -1) + 1), ['id' => $tasacion->id]) }}" class="btn btn-warning action-btn" title="Continuar a siguiente paso">
                                    <i class="fas fa-arrow-right"></i> Continuar
                                </a>
                            @endif
                            <!-- Botón para abrir el modal de selección de pasos -->
                            <button class="btn btn-primary action-btn" title="Editar Tasación" data-bs-toggle="modal" data-bs-target="#editModal{{ $tasacion->id }}">
                                <i class="fas fa-edit"></i> Editar
                            </button>
                            <button class="btn btn-danger action-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $loop->index }}" title="Eliminar Tasación">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                            <!-- Modal de Eliminar -->
                            <div class="modal fade" id="deleteModal{{ $loop->index }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Confirmar Eliminación</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            ¿Está seguro de que desea eliminar esta tasación?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                            <form action="{{ route('appraisals.destroy', ['id' => $tasacion->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <form method="GET" action="{{ route('appraisals.step1') }}">
        <button type="submit" class="btn btn-success add-btn">Agregar Tasación</button>
    </form>

    <p>La URL generada es: {{ route('appraisals.step1') }}</p>
</div>

<!-- Modal de Selección de Pasos -->
<div class="modal fade" id="editModal{{ $tasacion->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Tasación: {{ $tasacion->nomenclatura }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Selecciona el paso que deseas editar:</p>
                <ul class="list-group">
                    @if($tasacion->estado >= 'step1')
                        <li class="list-group-item">
                            <a href="{{ route('appraisals.step1', ['id' => $tasacion->id]) }}" class="btn btn-link">Step 1: Individualización de Inmuebles</a>
                        </li>
                    @endif
                    @if($tasacion->estado >= 'step2')
                        <li class="list-group-item">
                            <a href="{{ route('appraisals.step2', ['id' => $tasacion->id]) }}" class="btn btn-link">Step 2: Organismo Expropiante</a>
                        </li>
                    @endif
                    @if($tasacion->estado >= 'step3')
                        <li class="list-group-item">
                            <a href="{{ route('appraisals.step3', ['id' => $tasacion->id]) }}" class="btn btn-link">Step 3: Ley de Utilidad Pública</a>
                        </li>
                    @endif
                    @if($tasacion->estado >= 'step4')
                        <li class="list-group-item">
                            <a href="{{ route('appraisals.step4', ['id' => $tasacion->id]) }}" class="btn btn-link">Step 4: Notificación Acto Expropiatorio</a>
                        </li>
                    @endif
                    @if($tasacion->estado >= 'step5')
                        <li class="list-group-item">
                            <a href="{{ route('appraisals.step5', ['id' => $tasacion->id]) }}" class="btn btn-link">Step 5: Aceptación del Monto</a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

    <!-- Modal de Exportación -->
<div class="modal fade" id="exportModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Exportar a Excel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <!-- Rango de Fechas -->
                <label for="fechaDesde">Fecha Desde:</label>
                <input type="date" id="fechaDesde" class="form-control mb-2">

                <label for="fechaHasta">Fecha Hasta:</label>
                <input type="date" id="fechaHasta" class="form-control mb-3">

                <!-- Selección de Campos -->
                <label>Seleccione los campos a exportar:</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="nomenclatura" checked>
                    <label class="form-check-label" for="nomenclatura">Nomenclatura</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="inscripcion_dominio" checked>
                    <label class="form-check-label" for="inscripcion_dominio">Inscripción de Dominio</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="ubicacion" checked>
                    <label class="form-check-label" for="ubicacion">Ubicación</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="nro_plano" checked>
                    <label class="form-check-label" for="nro_plano">Nro Plano</label>
                </div>

                <!-- Selección de Estados -->
                <label class="mt-3">Seleccione los estados de tasaciones:</label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="estado_administrativa" checked>
                    <label class="form-check-label" for="estado_administrativa">Administrativa</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="estado_judicial" checked>
                    <label class="form-check-label" for="estado_judicial">Judicial</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="estado_finalizado" checked>
                    <label class="form-check-label" for="estado_finalizado">Finalizado</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success">Exportar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Búsqueda -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buscar por Nomenclatura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <input type="text" class="form-control" placeholder="Ingrese la nomenclatura...">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success">Buscar</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Filtro -->
<div class="modal fade" id="filterModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Filtrar por Estado</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <select class="form-control">
                    <option value="">Seleccionar estado...</option>
                    <option value="Administrativa">Administrativa</option>
                    <option value="Judicial">Judicial</option>
                    <option value="Finalizado">Finalizado</option>
                </select>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success">Aplicar Filtro</button>
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
