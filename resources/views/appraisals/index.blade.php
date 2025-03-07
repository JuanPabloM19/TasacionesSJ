@extends('layouts.app')

@section('title', 'Listado de Tasaciones')

@section('content')
<link rel="stylesheet" href="{{ asset('css/styles.css') }}">
<div class="container appraisal-container">
    @if(session('success'))
        <div class="alert alert-success">
        {{ session('success') }}
        </div>
    @endif
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
        @if(request()->has('nomenclatura') || request()->has('estado'))
            <div class="alert alert-info d-flex justify-content-between align-items-center">
                <div>
                    <strong>Filtros activos:</strong>
                    @if(request('nomenclatura'))
                        <span class="badge bg-primary">Nomenclatura: {{ request('nomenclatura') }}</span>
                    @endif
                    @if(request('estado'))
                        <span class="badge bg-success">Estado: {{ request('estado') }}</span>
                    @endif
                </div>
                <a href="{{ route('appraisals.index') }}" class="btn btn-warning btn-sm">Quitar filtros</a>
            </div>
        @endif
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Nomenclatura</th>
                    <th>Inscripción de Dominio</th>
                    <th>Ubicación</th>
                    <th>Nro Plano</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                    <th>Aprobación</th>
                </tr>
            </thead>
            @if($tasaciones->isEmpty())
                <tr>
                    <td colspan="7" class="text-center text-danger">
                        No se encontraron tasaciones.
                    </td>
                </tr>
            @else
                <tbody>
                    @foreach($tasaciones as $tasacion)
                        <tr class="{{ $tasacion->estado == 'pagada' ? 'bg-cg text-white' : '' }}">
                            <td>
                                <a href="{{ route('appraisals.show', $tasacion->id) }}" class="text-primary" title="Ver detalles">
                                    <i class="fas fa-eye"></i>
                                </a>
                                {{ $tasacion->nomenclatura }}
                            </td>
                            <td>{{ $tasacion->inscripcion_dominio }}</td>
                            <td>{{ $tasacion->ubicacion }}</td>
                            <td>{{ $tasacion->nro_plano }}</td>
                            <td>
                                @if(optional($tasacion->tasacionJudicial)->estado)
                                    @switch(optional($tasacion->tasacionJudicial)->estado)
                                        @case('step6') Actuaciones Judiciales (6) @break
                                        @case('step7') Monto Indemnizatorio a Pagar (7) @break
                                        @case('step8') Transferencia de Dominio (8) @break
                                        @case('step9') Boletín Oficial (9) @break
                                        @case('step10') Judicial (En Proceso) (10) @break
                                        @case('pagada') <span class="text-success"><i class="fas fa-check-circle"></i> Pagada</span> @break
                                        @default Estado Judicial Desconocido
                                    @endswitch
                                @else
                                    @switch($tasacion->estado)
                                        @case('step1') Individualización de Inmuebles (1) @break
                                        @case('step2') Organismo Expropiante (2) @break
                                        @case('step3') Ley de Utilidad Pública (3) @break
                                        @case('step4') Notificación Acto Expropiatorio (4) @break
                                        @case('step5') Aceptación del Monto (5) @break
                                        @case('completed') Vía Administrativa Completada @break
                                        @case('pagada') <span class="text-success"><i class="fas fa-check-circle"></i> Pagada</span> @break
                                        @default Estado Administrativo Desconocido
                                    @endswitch
                                @endif
                            </td>
                            <td>
                                <div class="actions">
                                    @if($tasacion->estado == 'pagada')
                                        <!-- Sin botones -->
                                    @elseif(optional($tasacion->tasacionJudicial)->estado == 'step10')
                                        <!-- Judicial en Proceso (step10) -->
                                        <a href="{{ route('judicial.finalize', ['tasacion_id' => $tasacion->id]) }}" class="btn btn-success mb-1 mt-1">
                                            <i class="fas fa-check"></i> Finalizar
                                        </a>
                                        <button class="btn btn-primary mb-1 mt-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $tasacion->id }}">
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                        <button class="btn btn-danger mb-1 mt-1" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $tasacion->id }}">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    @elseif($tasacion->estado == 'completed' && !optional($tasacion->tasacionJudicial)->estado)
                                        <!-- Vía Administrativa Completada -->
                                        <a href="{{ route('appraisals.finalize', ['id' => $tasacion->id]) }}" class="btn btn-success mb-1 mt-1">
                                            <i class="fas fa-check"></i> Finalizar
                                        </a>
                                        <a href="{{ route('judicial.step6', ['tasacion_id' => $tasacion->id]) }}" class="btn btn-warning mb-1 mt-1">
                                            <i class="fas fa-gavel"></i> Ir a Judicial
                                        </a>
                                        <button class="btn btn-primary mb-1 mt-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $tasacion->id }}">
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                        <button class="btn btn-danger mb-1 mt-1" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $tasacion->id }}">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    @else
                                        <!-- Estados intermedios (step1-step5 y step6-step9) -->
                                        @php
                                            $stepNumber = $tasacion->estado_judicial
                                            ? intval(filter_var($tasacion->estado_judicial, FILTER_SANITIZE_NUMBER_INT))
                                            : (is_numeric(substr($tasacion->estado, -1)) ? intval(substr($tasacion->estado, -1)) : null);
                                            $nextStep = ($stepNumber !== null && $stepNumber < 10) ? 'step' . ($stepNumber + 1) : null;
                                        @endphp

                                        @if($nextStep)
                                            <a href="{{ route(optional($tasacion->tasacionJudicial)->estado ? 'judicial.' . $nextStep : 'appraisals.' . $nextStep, ['tasacion_id' => $tasacion->id]) }}" class="btn btn-warning mb-1 mt-1">
                                                <i class="fas fa-arrow-right"></i> Continuar
                                            </a>
                                        @endif
                                        <button class="btn btn-primary mb-1 mt-1" data-bs-toggle="modal" data-bs-target="#editModal{{ $tasacion->id }}">
                                            <i class="fas fa-edit"></i> Editar
                                        </button>
                                        <button class="btn btn-danger mb-1 mt-1" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $tasacion->id }}">
                                            <i class="fas fa-trash"></i> Eliminar
                                        </button>
                                    @endif
                                </div>
                            </td>
                            <td>
                                @if($tasacion->estado == 'pendiente')
                                    <span class="badge bg-secondary mb-1 mt-1">Pendiente de Aprobación</span>
                                @else
                                    <div class="approval mb-1 mt-1">
                                        @if($tasacion->aprobado)
                                            <span class="badge bg-success mb-1 mt-1">Aprobado</span>
                                            <small>por {{ $tasacion->aprobadoPor ? $tasacion->aprobadoPor->name : 'Desconocido' }}</small>
                                            @else
                                            <span class="badge bg-warning mb-1 mt-1">Pendiente</span>
                                            @if(Auth::user()->role == 'admin' || Auth::user()->role == 'publicador')
                                                <form method="POST" action="{{ route('appraisals.aprobar', $tasacion->id) }}">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn btn-success mb-1 mt-1"><i class="fas fa-check"></i> Aprobar</button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            @endif
        </table>
    </div>
    <form method="GET" action="{{ route('appraisals.step1') }}">
        <button type="submit" class="btn btn-success add-btn">Agregar Tasación</button>
    </form>
</div>

<!-- Modal de Selección de Pasos -->
@foreach($tasaciones as $tasacion)
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
                    <!-- Verificar si está en estado judicial -->
                    @if(optional($tasacion->tasacionJudicial)->estado && in_array(optional($tasacion->tasacionJudicial)->estado, ['step6', 'step7', 'step8', 'step9', 'step10']))
                        <!-- Mostrar Steps 6 al 10 si está en estado judicial -->
                        <li class="list-group-item">
                            <a href="{{ route('judicial.step6', ['tasacion_id' => $tasacion->id]) }}" class="btn btn-link custom-link">6: Actuaciones Judiciales</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('judicial.step7', ['tasacion_id' => $tasacion->id]) }}" class="btn btn-link custom-link">7: Monto Indemnizatorio a Pagar</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('judicial.step8', ['tasacion_id' => $tasacion->id]) }}" class="btn btn-link custom-link">8: Transferencia de Dominio</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('judicial.step9', ['tasacion_id' => $tasacion->id]) }}" class="btn btn-link custom-link">9: Boletín Oficial</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('judicial.step10', ['tasacion_id' => $tasacion->id]) }}" class="btn btn-link custom-link">10: Observaciones Judicial (En Proceso)</a>
                        </li>
                    @else
                        <!-- Mostrar Steps 1 al 5 si NO tiene estado judicial -->
                        <li class="list-group-item">
                            <a href="{{ route('appraisals.step1', ['id' => $tasacion->id]) }}" class="btn btn-link custom-link">1: Individualización de Inmuebles</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('appraisals.step2', ['id' => $tasacion->id]) }}" class="btn btn-link custom-link">2: Organismo Expropiante</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('appraisals.step3', ['id' => $tasacion->id]) }}" class="btn btn-link custom-link">3: Ley de Utilidad Pública</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('appraisals.step4', ['id' => $tasacion->id]) }}" class="btn btn-link custom-link">4: Notificación Acto Expropiatorio</a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{ route('appraisals.step5', ['id' => $tasacion->id]) }}" class="btn btn-link custom-link">5: Aceptación del Monto</a>
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
@endforeach

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

                <!-- Selección de Campos Administrativos -->
                <label>Seleccione los campos a exportar (Administrativos):</label>
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
                    <input class="form-check-input" type="checkbox" id="propietarios" checked>
                    <label class="form-check-label" for="propietarios">Propietarios</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="nro_plano" checked>
                    <label class="form-check-label" for="nro_plano">Nro Plano</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="superficie_total" checked>
                    <label class="form-check-label" for="superficie_total">Superficie Total</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="fraccion_expropiar" checked>
                    <label class="form-check-label" for="fraccion_expropiar">Fracción a Expropiar</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="nombre_reparticion" checked>
                    <label class="form-check-label" for="nombre_reparticion">Nombre Repartición</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="expediente_nro" checked>
                    <label class="form-check-label" for="expediente_nro">Expediente Nro</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="fecha_iniciacion" checked>
                    <label class="form-check-label" for="fecha_iniciacion">Fecha Iniciación</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="numero_ley" checked>
                    <label class="form-check-label" for="numero_ley">Numero de Ley</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="fecha_ley" checked>
                    <label class="form-check-label" for="fecha_ley">Fecha de Ley</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="boletin_oficial" checked>
                    <label class="form-check-label" for="boletin_oficial">Boletin Oficial</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="numero_exp" checked>
                    <label class="form-check-label" for="numero_exp">Numero Expediente</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="monto_acordado" checked>
                    <label class="form-check-label" for="monto_acordado">Monto Acordado</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="fecha_notificacion" checked>
                    <label class="form-check-label" for="fecha_notificacion">Fecha de Notificacion</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="acta_numero" checked>
                    <label class="form-check-label" for="acta_numero">Numero de Acta</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="incremento" checked>
                    <label class="form-check-label" for="incremento">Incremento</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="aceptacion" checked>
                    <label class="form-check-label" for="aceptacion">Aceptacion</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="monto_pagado" checked>
                    <label class="form-check-label" for="monto_pagado">Monto Pagado</label>
                </div>

                <!-- Campos Judiciales -->
                <label class="mt-3">Seleccione los campos a exportar (Judiciales):</label>
                {{-- <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="expediente_nro" checked>
                    <label class="form-check-label" for="expediente_nro">Numero de Expediente</label>
                </div> --}}
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="fecha_inicio" checked>
                    <label class="form-check-label" for="fecha_inicio">Fecha Inicio Judicial</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="juzgado_interviniente" checked>
                    <label class="form-check-label" for="juzgado_interviniente">Juzgado Interviniente</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="caratula" checked>
                    <label class="form-check-label" for="caratula">Carátula</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="boleta_deposito" checked>
                    <label class="form-check-label" for="boleta_deposito">Boleta Depósito</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="nro_comprobante" checked>
                    <label class="form-check-label" for="nro_comprobante">Numero de Comprobante</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="monto_depositado" checked>
                    <label class="form-check-label" for="monto_depositado">Monto Depositado</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="observaciones" checked>
                    <label class="form-check-label" for="observaciones">Observaciones</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="dictamen_expediente" checked>
                    <label class="form-check-label" for="dictamen_expediente">Dictamen Expediente</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="dictamen_fecha" checked>
                    <label class="form-check-label" for="dictamen_fecha">Fecha de Dictamen</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="dictamen_monto" checked>
                    <label class="form-check-label" for="dictamen_monto">Monto del Dictamen</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="orden_pago_fecha" checked>
                    <label class="form-check-label" for="orden_pago_fecha">Fecha de Orden de Pago</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="orden_pago_monto" checked>
                    <label class="form-check-label" for="orden_pago_monto">Monto de Orden de Pago</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="concepto_indemnizacion" checked>
                    <label class="form-check-label" for="concepto_indemnizacion">Concepto de Indemnizacion</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="dominio_publico" checked>
                    <label class="form-check-label" for="dominio_publico">Dominio Publico</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="dominio_privado" checked>
                    <label class="form-check-label" for="dominio_privado">Dominio Privado</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="boletin_numero" checked>
                    <label class="form-check-label" for="boletin_numero">Numero de Boletin</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="boletin_fecha" checked>
                    <label class="form-check-label" for="boletin_fecha">Fecha del Boletin</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="observaciones_finales" checked>
                    <label class="form-check-label" for="observaciones_finales">Observaciones Finales</label>
                </div>

                <!-- Selección de Estados -->
                <label class="mt-3">Seleccione los estados de tasaciones:</label>

                <!-- Estado Administrativo (Checkboxs) -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="step1" checked>
                    <label class="form-check-label" for="step1">Individualización de Inmuebles (1)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="step2" checked>
                    <label class="form-check-label" for="step2">Organismo Expropiante (2)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="step3" checked>
                    <label class="form-check-label" for="step3">Ley de Utilidad Pública (3)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="step4" checked>
                    <label class="form-check-label" for="step4">Notificación Acto Expropiatorio (4)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="step5" checked>
                    <label class="form-check-label" for="step5">Aceptación del Monto (5)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="completed" checked>
                    <label class="form-check-label" for="completed">Vía Administrativa Completada</label>
                </div>

                <!-- Estado Judicial (Checkboxs) -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="step6" checked>
                    <label class="form-check-label" for="step6">Actuaciones Judiciales (6)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="step7" checked>
                    <label class="form-check-label" for="step7">Monto Indemnizatorio a Pagar (7)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="step8" checked>
                    <label class="form-check-label" for="step8">Transferencia de Dominio (8)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="step9" checked>
                    <label class="form-check-label" for="step9">Boletín Oficial (9)</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="step10" checked>
                    <label class="form-check-label" for="step10">Judicial (En Proceso) (10))</label>
                </div>

                <!-- Estado de Pagada -->
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="estado_pagada" checked>
                    <label class="form-check-label" for="estado_pagada">Pagada</label>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-success" id="exportExcel">Exportar</button>
            </div>
        </div>
    </div>
</div>

<script>
 document.getElementById('exportExcel').addEventListener('click', function() {
     let params = new URLSearchParams();

     // Capturar valores de los filtros de fecha
     params.append('fechaDesde', document.getElementById('fechaDesde').value);
     params.append('fechaHasta', document.getElementById('fechaHasta').value);

     // Capturar los valores de los checkboxes para campos seleccionados
     document.querySelectorAll('.form-check-input').forEach((checkbox) => {
         if (checkbox.checked) {
             console.log(`Campo seleccionado: ${checkbox.id}`);
             params.append(checkbox.id, '1');
         }
     });

     // Capturar los estados de los pasos seleccionados
     let estados = [];
     // Campos administrativos
     for (let i = 1; i <= 5; i++) {
         if (document.getElementById(`step${i}`).checked) {
             estados.push(`step${i}`);
         }
     }

     // Campos judiciales
     for (let i = 6; i <= 10; i++) {
         if (document.getElementById(`step${i}`).checked) {
             estados.push(`step${i}`);
         }
     }

     // Estado de "Pagada"
     if (document.getElementById('estado_pagada').checked) {
         estados.push('pagada');
     }

     if (estados.length > 0) {
         params.append('estados', estados.join(','));
     }

     console.log(params.toString()); // Verificar los parámetros
     window.location.href = "{{ route('appraisals.export') }}?" + params.toString();
 });

</script>

<!-- Modal de Búsqueda -->
<div class="modal fade" id="searchModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Buscar por Nomenclatura</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form method="GET" action="{{ route('appraisals.index') }}">
                    <input type="text" class="form-control mb-2" name="nomenclatura"
                           placeholder="Ingrese la nomenclatura..."
                           value="{{ request('nomenclatura') }}">
                    <button type="submit" class="btn btn-success w-100">Buscar</button>
                </form>
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
                <form method="GET" action="{{ route('appraisals.index') }}">
                    <label for="administrativa">Etapa Administrativa</label>
                    <select class="form-control mb-2" name="estado_administrativa" id="administrativa">
                        <option value="">Todos los estados</option>
                        <option value="step1" {{ request('estado_administrativa') == 'step1' ? 'selected' : '' }}>Individualización de Inmuebles (1)</option>
                        <option value="step2" {{ request('estado_administrativa') == 'step2' ? 'selected' : '' }}>Organismo Expropiante (2)</option>
                        <option value="step3" {{ request('estado_administrativa') == 'step3' ? 'selected' : '' }}>Ley de Utilidad Pública (3)</option>
                        <option value="step4" {{ request('estado_administrativa') == 'step4' ? 'selected' : '' }}>Notificación Acto Expropiatorio (4)</option>
                        <option value="step5" {{ request('estado_administrativa') == 'step5' ? 'selected' : '' }}>Aceptación del Monto (5)</option>
                        <option value="completed" {{ request('estado_administrativa') == 'completed' ? 'selected' : '' }}>Vía Administrativa Completada</option>
                        <option value="no" {{ request('estado_administrativa') == 'no' ? 'selected' : '' }}>No aplicar filtro</option>
                    </select>

                    <label for="judicial">Etapa Judicial</label>
                    <select class="form-control mb-2" name="estado_judicial" id="judicial">
                        <option value="">Todos los estados</option>
                        <option value="step6" {{ request('estado_judicial') == 'step6' ? 'selected' : '' }}>Actuaciones Judiciales (6)</option>
                        <option value="step7" {{ request('estado_judicial') == 'step7' ? 'selected' : '' }}>Monto Indemnizatorio a Pagar (7)</option>
                        <option value="step8" {{ request('estado_judicial') == 'step8' ? 'selected' : '' }}>Transferencia de Dominio (8)</option>
                        <option value="step9" {{ request('estado_judicial') == 'step9' ? 'selected' : '' }}>Boletín Oficial (9)</option>
                        <option value="step10" {{ request('estado_judicial') == 'step10' ? 'selected' : '' }}>Judicial (En Proceso) (10)</option>
                        <option value="no" {{ request('estado_judicial') == 'no' ? 'selected' : '' }}>No aplicar filtro</option>
                    </select>

                    <label for="pagada">Estado Pagada</label>
                    <select class="form-control mb-2" name="estado_pagada" id="pagada">
                        <option value="">Todos los estados</option>
                        <option value="pagada" {{ request('estado_pagada') == 'pagada' ? 'selected' : '' }}>Pagada</option>
                        <option value="no" {{ request('estado_pagada') == 'no' ? 'selected' : '' }}>No aplicar filtro</option>
                    </select>

                    <button type="submit" class="btn btn-success w-100">Aplicar Filtro</button>
                </form>
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
        margin-top: 100px;
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

    /* Estilo personalizado para los enlaces */
    .custom-link {
        color: #333; /* Color oscuro o cualquier otro que se adapte al diseño */
        text-decoration: none; /* Eliminar subrayado */
    }

    .custom-link:hover {
        color: #ff6200; /* Cambiar color al pasar el mouse (puedes usar otro color) */
        text-decoration: none; /* Subrayado al pasar el mouse, solo para darle un toque visual */
    }

    /* .actions{
        padding-top: 5px;
        padding-bottom: 5px;
    } */

</style>
@endsection
