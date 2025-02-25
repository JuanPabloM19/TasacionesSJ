@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Listado de Tasaciones</h1>
    <table class="table">
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
                    ['id' => 1, 'nomenclatura' => '123-ABC', 'inscripcion_dominio' => '456XYZ', 'ubicacion' => 'San Juan', 'nro_plano' => '789', 'estado' => 'Inscripcion'],
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
                        @if($tasacion['estado'] == 'Inscripcion')
                            <span class="badge bg-warning">Inscripción</span>
                        @elseif($tasacion['estado'] == 'Judicial')
                            <span class="badge bg-danger">Judicial</span>
                        @else
                            <span class="badge bg-success">Finalizado</span>
                        @endif
                    </td>
                    <td>
                        @if($tasacion['estado'] == 'Inscripcion')
                            <a href="{{ route('appraisals.step2') }}" class="btn btn-success" data-bs-toggle="tooltip" data-bs-placement="top" title="Continuar a Judicial">
                                <i class="fas fa-arrow-right"></i> Ir a Judicial
                            </a>
                            <a href="{{ route('appraisals.step1') }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar Tasación">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $loop->index }}" title="Eliminar Tasación">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                            {{-- <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#finalizeModal{{ $tasacion['id'] }}">
                                <i class="fas fa-check"></i> Finalizar
                            </button> --}}
                        @elseif($tasacion['estado'] == 'Judicial')
                            {{-- <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#finalizeModal{{ $tasacion['id'] }}">
                                <i class="fas fa-check"></i> Finalizar
                            </button> --}}
                            <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#judicialModal{{ $tasacion['id'] }}">
                                <i class="fas fa-plus"></i> Cargar datos
                            </button>
                            <a href="{{ route('appraisals.step1') }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar Tasación">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $loop->index }}" title="Eliminar Tasación">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        @else
                            <a href="{{ route('appraisals.step1') }}" class="btn btn-primary" data-bs-toggle="tooltip" data-bs-placement="top" title="Editar Tasación">
                                <i class="fas fa-edit"></i> Editar
                            </a>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $loop->index }}" title="Eliminar Tasación">
                                <i class="fas fa-trash"></i> Eliminar
                            </button>
                        @endif
                    </td>
                </tr>

                <!-- Modal de Finalización -->
                {{-- <div class="modal fade" id="finalizeModal{{ $tasacion['id'] }}" tabindex="-1" aria-labelledby="finalizeModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirmar Finalización</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                ¿Está seguro de que desea finalizar esta tasación?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <form action="{{ route('appraisals.finalize', $tasacion['id']) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">Finalizar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> --}}

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
                                    <button type="submit" class="btn btn-secondary">Cargar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('appraisals.step1') }}" class="btn btn-success">Agregar Tasación</a>
</div>
@endsection
