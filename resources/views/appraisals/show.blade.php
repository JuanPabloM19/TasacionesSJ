@extends('layouts.app')

@section('title', 'Detalles de la Tasación')

@section('content')
<div class="container pt-8 pb-8 header-section">
    <h1>Detalles de la Tasación</h1>

    {{-- Step 1: Individualización de Inmuebles --}}
    @if($tasacion->nomenclatura || $tasacion->inscripcion_dominio || $tasacion->ubicacion || $tasacion->propietarios || $tasacion->nro_plano || $tasacion->superficie_total || $tasacion->fraccion_expropiar)
    <div class="card mb-3">
        <div class="card-header titb">
            Individualización de Inmuebles (1)
        </div>
        <div class="card-body">
            @if($tasacion->nomenclatura)
            <p><strong>Nomenclatura:</strong> {{ $tasacion->nomenclatura }}</p>
            @endif
            @if($tasacion->inscripcion_dominio)
            <p><strong>Inscripción de Dominio:</strong> {{ $tasacion->inscripcion_dominio }}</p>
            @endif
            @if($tasacion->ubicacion)
            <p><strong>Ubicación:</strong> {{ $tasacion->ubicacion }}</p>
            @endif
            @if($tasacion->propietarios)
            <p><strong>Propietarios:</strong> {{ $tasacion->propietarios }}</p>
            @endif
            @if($tasacion->nro_plano)
            <p><strong>Numero de plano:</strong> {{ $tasacion->nro_plano }}</p>
            @endif
            @if($tasacion->superficie_total)
            <p><strong>Superficie Total:</strong> {{ $tasacion->superficie_total }}</p>
            @endif
            @if($tasacion->unidad_superficie)
            <p><strong>Unidad de Superficie:</strong> {{ $tasacion->unidad_superficie }}</p>
            @endif
            @if($tasacion->fraccion_expropiar)
            <p><strong>Fraccion a expropiar:</strong> {{ $tasacion->fraccion_expropiar }}</p>
            @endif
        </div>
    </div>
    @endif

    {{-- Step 2: Organismo Expropiante --}}
    @if($tasacion->nombre_reparticion || $tasacion->expediente_nro || $tasacion->fecha_iniciacion)
    <div class="card mb-3">
        <div class="card-header titb">
            Organismo Expropiante (2)
        </div>
        <div class="card-body">
            @if($tasacion->nombre_reparticion)
            <p><strong>Nombre de la Repartición:</strong> {{ $tasacion->nombre_reparticion }}</p>
            @endif
            @if($tasacion->expediente_nro)
            <p><strong>Expediente Nro:</strong> {{ $tasacion->expediente_nro }}</p>
            @endif
            @if($tasacion->fecha_iniciacion)
            <p><strong>Fecha de Iniciación:</strong> {{ $tasacion->fecha_iniciacion }}</p>
            @endif
        </div>
    </div>
    @endif

    {{-- Step 3: Ley de Utilidad Pública --}}
    @if($tasacion->numero_ley || $tasacion->fecha_ley || $tasacion->boletin_oficial || $tasacion->ley_documento)
    <div class="card mb-3">
        <div class="card-header titb">
            Ley de Utilidad Pública (3)
        </div>
        <div class="card-body">
            @if($tasacion->numero_ley)
            <p><strong>Número de Ley:</strong> {{ $tasacion->numero_ley }}</p>
            @endif
            @if($tasacion->fecha_ley)
            <p><strong>Fecha de Ley:</strong> {{ $tasacion->fecha_ley }}</p>
            @endif
            @if($tasacion->boletin_oficial)
                <p><strong>Boletin Oficial:</strong> ${{ $tasacion->boletin_oficial }}</p>
            @endif

            @if($tasacion->ley_documento)
                <p><strong>Documento de Ley:</strong>
                    <a href="{{ asset('storage/'.$tasacion->ley_documento) }}" class="btn btn-primary btn-sm" target="_blank">
                        Descargar
                    </a>
                </p>
            @endif
        </div>
    </div>
    @endif

    {{-- Step 4: Notificación Acto Expropiatorio --}}
    @if($tasacion->numero_exp || $tasacion->monto_acordado || $tasacion->fecha_notificacion || $tasacion->acta_numero || $tasacion->acta_documento )
    <div class="card mb-3">
        <div class="card-header titb">
            Notificación Acto Expropiatorio (4)
        </div>
        <div class="card-body">
            @if($tasacion->numero_exp)
            <p><strong>Número de expendiente:</strong> {{ $tasacion->numero_exp }}</p>
            @endif
            @if($tasacion->monto_acordado)
            <p><strong>Monto acordado:</strong> {{ $tasacion->monto_acordado }}</p>
            @endif
            @if($tasacion->fecha_notificacion)
            <p><strong>Fecha de notificacion:</strong> {{ $tasacion->fecha_notificacion }}</p>
            @endif
            @if($tasacion->acta_numero)
            <p><strong>Numero de acta:</strong> {{ $tasacion->acta_numero }}</p>
            @endif
            @if($tasacion->acta_documento)
                <p><strong>Documento de acta:</strong>
                    <a href="{{ asset('storage/'.$tasacion->acta_documento) }}" class="btn btn-primary btn-sm" target="_blank">
                        Descargar
                    </a>
                </p>
            @endif
        </div>
    </div>
    @endif

    {{-- Step 5: Aceptación del Monto --}}
    @if($tasacion->incremento || $tasacion->aceptacion || $tasacion->convenio_avenamiento || $tasacion->monto_pagado)
    <div class="card mb-3">
        <div class="card-header titb">
            Aceptación del Monto (5)
        </div>
        <div class="card-body">
            @if($tasacion->incremento)
            <p><strong>Incremento del 10%:</strong> ${{ $tasacion->incremento}}</p>
            @endif
            @if($tasacion->aceptacion)
            <p><strong>Aceptacion:</strong> {{ $tasacion->aceptacion }}</p>
            @endif
            @if($tasacion->convenio_avenamiento)
                <p><strong>Convenio de avenamiento:</strong>
                    <a href="{{ asset('storage/'.$tasacion->convenio_avenamiento) }}" class="btn btn-primary btn-sm" target="_blank">
                        Descargar
                    </a>
                </p>
            @endif
            @if($tasacion->monto_pagado)
            <p><strong>Monto pagado:</strong> {{ $tasacion->monto_pagado }}</p>
            @endif
        </div>
    </div>
    @endif

    {{-- STEPS JUDICIALES --}}
@if($tasacion->tasacionJudicial)

{{-- Step 6: Inicio del proceso judicial --}}
@if($tasacion->tasacionJudicial->expediente_nro || $tasacion->tasacionJudicial->fecha_inicio || $tasacion->tasacionJudicial->juzgado_interviniente || $tasacion->tasacionJudicial->caratula || $tasacion->tasacionJudicial->boleta_deposito || $tasacion->tasacionJudicial->nro_comprobante || $tasacion->tasacionJudicial->monto_depositado || $tasacion->tasacionJudicial->observaciones)
<div class="card mb-3">
    <div class="card-header bg-warning text-white">
        Inicio del Proceso Judicial (6)
    </div>
    <div class="card-body">
        @if($tasacion->tasacionJudicial->expediente_nro)
        <p><strong>Número de Expediente:</strong> {{ $tasacion->tasacionJudicial->expediente_nro }}</p>
        @endif
        @if($tasacion->tasacionJudicial->fecha_inicio)
        <p><strong>Fecha de Inicio:</strong> {{ $tasacion->tasacionJudicial->fecha_inicio }}</p>
        @endif
        @if($tasacion->tasacionJudicial->juzgado_interviniente)
        <p><strong>Juzgado Interviniente:</strong> {{ $tasacion->tasacionJudicial->juzgado_interviniente }}</p>
        @endif
        @if($tasacion->tasacionJudicial->caratula)
        <p><strong>Carátula:</strong> {{ $tasacion->tasacionJudicial->caratula }}</p>
        @endif
        @if($tasacion->tasacionJudicial->boleta_deposito)
            <p><strong>Boleta de Depósito:</strong>
                <a href="{{ asset('storage/'.$tasacion->tasacionJudicial->boleta_deposito) }}" class="btn btn-primary btn-sm" target="_blank">
                    Descargar
                </a>
            </p>
        @endif
        @if($tasacion->tasacionJudicial->nro_comprobante)
        <p><strong>Numero de comprobante:</strong> {{ $tasacion->tasacionJudicial->nro_comprobante }}</p>
        @endif
        @if($tasacion->tasacionJudicial->monto_depositado)
        <p><strong>Monto depositado:</strong> {{ $tasacion->tasacionJudicial->monto_depositado }}</p>
        @endif
        @if($tasacion->tasacionJudicial->observaciones)
        <p><strong>Observaciones:</strong> {{ $tasacion->tasacionJudicial->observaciones }}</p>
        @endif
    </div>
</div>
@endif

{{-- Step 7: Monto de Indemnización --}}
@if($tasacion->tasacionJudicial->dictamen_expediente || $tasacion->tasacionJudicial->dictamen_fecha || $tasacion->tasacionJudicial->dictamen_monto || $tasacion->tasacionJudicial->orden_pago_fecha || $tasacion->tasacionJudicial->orden_pago_monto || $tasacion->tasacionJudicial->instrumento_legal || $tasacion->tasacionJudicial->concepto_indemnizacion)
<div class="card mb-3">
    <div class="card-header bg-warning text-white">
        Monto de Indemnización (7)
    </div>
    <div class="card-body">
        @if($tasacion->tasacionJudicial->dictamen_expediente)
        <p><strong>Dictamen Expediente:</strong> {{ $tasacion->tasacionJudicial->dictamen_expediente }}</p>
        @endif
        @if($tasacion->tasacionJudicial->dictamen_fecha)
        <p><strong>Fecha del Dictamen:</strong> {{ $tasacion->tasacionJudicial->dictamen_fecha }}</p>
        @endif
        @if($tasacion->tasacionJudicial->dictamen_monto)
        <p><strong>Monto del Dictamen:</strong> ${{ $tasacion->tasacionJudicial->dictamen_monto }}</p>
        @endif
        @if($tasacion->tasacionJudicial->orden_pago_fecha)
        <p><strong>Fecha de orden de pago:</strong> ${{ $tasacion->tasacionJudicial->orden_pago_fecha }}</p>
        @endif
        @if($tasacion->tasacionJudicial->orden_pago_monto)
        <p><strong>Monto de orden de pago:</strong> ${{ $tasacion->tasacionJudicial->orden_pago_monto }}</p>
        @endif
        @if($tasacion->tasacionJudicial->instrumento_legal)
        <p><strong>Instrumento Legal:</strong> ${{ $tasacion->tasacionJudicial->instrumento_legal }}</p>
        @endif
        @if($tasacion->tasacionJudicial->concepto_indemnizacion)
        <p><strong>Concepto de Indemnización:</strong> ${{ $tasacion->tasacionJudicial->concepto_indemnizacion }}</p>
        @endif
    </div>
</div>
@endif

{{-- Step 8: Transferencia de Dominio --}}
@if($tasacion->tasacionJudicial->dominio_publico || $tasacion->tasacionJudicial->dominio_privado || $tasacion->tasacionJudicial->dominio_publico_pdf || $tasacion->tasacionJudicial->dominio_privado_pdf)
<div class="card mb-3">
    <div class="card-header bg-warning text-white">
        Transferencia de Dominio (8)
    </div>
    <div class="card-body">
    @if($tasacion->tasacionJudicial->dominio_publico)
        <p><strong>Dominio Publico:</strong> ${{ $tasacion->tasacionJudicial->dominio_publico }}</p>
    @endif
    @if($tasacion->tasacionJudicial->dominio_privado)
        <p><strong>Dominio Privado:</strong> ${{ $tasacion->tasacionJudicial->dominio_privado }}</p>
    @endif
        @if($tasacion->tasacionJudicial->dominio_publico_pdf)
            <p><strong>Dominio Publico:</strong>
                <a href="{{ asset('storage/'.$tasacion->tasacionJudicial->dominio_publico_pdf) }}" class="btn btn-primary btn-sm" target="_blank">
                    Descargar
                </a>
            </p>
        @endif
        @if($tasacion->tasacionJudicial->dominio_privado_pdf)
            <p><strong>Dominio Privado:</strong>
                <a href="{{ asset('storage/'.$tasacion->tasacionJudicial->dominio_privado_pdf) }}" class="btn btn-primary btn-sm" target="_blank">
                    Descargar
                </a>
            </p>
        @endif
    </div>
</div>
@endif

{{-- Step 9: Publicación en Boletín Oficial --}}
@if($tasacion->tasacionJudicial->boletin_numero || $tasacion->tasacionJudicial->boletin_fecha)
<div class="card mb-3">
    <div class="card-header bg-warning text-white">
        Publicación en Boletín Oficial (9)
    </div>
    <div class="card-body">
        @if($tasacion->tasacionJudicial->boletin_numero)
        <p><strong>Número de Boletín:</strong> {{ $tasacion->tasacionJudicial->boletin_numero }}</p>
        @endif
        @if($tasacion->tasacionJudicial->boletin_fecha)
        <p><strong>Fecha del Boletín:</strong> {{ $tasacion->tasacionJudicial->boletin_fecha }}</p>
        @endif
        @if($tasacion->tasacionJudicial->boletin_archivo)
            <p><strong>Archivo de la Boleta:</strong>
                <a href="{{ asset('storage/'.$tasacion->tasacionJudicial->boletin_archivo) }}" class="btn btn-primary btn-sm" target="_blank">
                    Descargar
                </a>
            </p>
        @endif
    </div>
</div>
@endif

{{-- Step 10: Observaciones Finales --}}
@if($tasacion->tasacionJudicial->observaciones_finales)
<div class="card mb-3">
    <div class="card-header bg-warning text-white">
        Observaciones Finales (10)
    </div>
    <div class="card-body">
        @if($tasacion->tasacionJudicial->observaciones_finales)
            <p><strong>Observaciones:</strong> {{ $tasacion->tasacionJudicial->observaciones_finales }}</p>
        @endif
        @if($tasacion->tasacionJudicial->archivo_observaciones)
            <p><strong>Archivo de Observaciones:</strong>
                <a href="{{ asset('storage/'.$tasacion->tasacionJudicial->archivo_observaciones) }}" class="btn btn-primary btn-sm" target="_blank">
                    Descargar
                </a>
            </p>
        @endif
    </div>
</div>
@endif
@endif

</div>
@endsection

<style>
    .header-section h1 {
        color: #ff6200;
        font-size: 38px;
    }

    .titb {
        background-color: #ff6200 !important;
        color: white !important;
    }
</style>
