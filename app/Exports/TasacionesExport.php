<?php

namespace App\Exports;

use App\Models\Tasacion;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class TasacionesExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize
{
    /**
     * Obtener los datos de las tasaciones con la relación 'tasacionJudicial'.
     */
    public function collection()
    {
        return Tasacion::with('tasacionJudicial')->get();
    }

    /**
     * Definir los encabezados del archivo Excel.
     */
    public function headings(): array
    {
        return [
            'Nomenclatura',
            'Inscripción Dominio',
            'Ubicación',
            'Propietarios',
            'Nro Plano',
            'Superficie Total',
            'Fracción Expropiar',
            'Nombre Repartición',
            'Expediente Nro',
            'Fecha Iniciación',
            'Número Ley',
            'Fecha Ley',
            'Boletín Oficial',
            'Ley Documento',
            'Número Exp',
            'Monto Acordado',
            'Fecha Notificación',
            'Acta Número',
            'Incremento',
            'Aceptación',
            'Convenio Avenamiento',
            'Monto Pagado',
            'Estado',
            'Estado Judicial',
            'Carátula',
            'Observaciones',
            'Dictamen Expediente',
            'Dictamen Fecha',
            'Dictamen Monto',
            'Orden Pago Fecha',
            'Orden Pago Monto',
            'Instrumento Legal',
            'Concepto Indemnización',
            'Dominio Público',
            'Dominio Privado',
            'Boletín Número',
            'Boletín Fecha',
            'Boletín Archivo',
            'Observaciones Finales',
            'Archivo Observaciones',
        ];
    }

    /**
     * Mapear los datos para la exportación.
     */
    public function map($tasacion): array
{
    return [
        $tasacion->nomenclatura,
        $tasacion->inscripcion_dominio,
        $tasacion->ubicacion,
        $tasacion->propietarios,
        $tasacion->nro_plano,
        $tasacion->superficie_total,
        $tasacion->fraccion_expropiar,
        $tasacion->nombre_reparticion,
        $tasacion->expediente_nro,
        $this->formatDate($tasacion->fecha_iniciacion),
        $tasacion->numero_ley,
        $this->formatDate($tasacion->fecha_ley),
        $tasacion->boletin_oficial,
        $tasacion->ley_documento,
        $tasacion->numero_exp,
        $tasacion->monto_acordado,
        $this->formatDate($tasacion->fecha_notificacion),
        $tasacion->acta_numero,
        $tasacion->incremento,
        $tasacion->aceptacion,
        $tasacion->convenio_avenamiento,
        $tasacion->monto_pagado,
        $tasacion->estado,
        // Datos de la relación TasacionJudicial
        $tasacion->tasacionJudicial ? $tasacion->tasacionJudicial->estado : null,
        $tasacion->tasacionJudicial ? $tasacion->tasacionJudicial->caratula : null,
        $tasacion->tasacionJudicial ? $tasacion->tasacionJudicial->observaciones : null,
        $tasacion->tasacionJudicial ? $tasacion->tasacionJudicial->dictamen_expediente : null,
        $this->formatDate($tasacion->tasacionJudicial ? $tasacion->tasacionJudicial->dictamen_fecha : null),
        $tasacion->tasacionJudicial ? $tasacion->tasacionJudicial->dictamen_monto : null,
        $this->formatDate($tasacion->tasacionJudicial ? $tasacion->tasacionJudicial->orden_pago_fecha : null),
        $tasacion->tasacionJudicial ? $tasacion->tasacionJudicial->orden_pago_monto : null,
        $tasacion->tasacionJudicial ? $tasacion->tasacionJudicial->instrumento_legal : null,
        $tasacion->tasacionJudicial ? $tasacion->tasacionJudicial->concepto_indemnizacion : null,
        $tasacion->tasacionJudicial ? $tasacion->tasacionJudicial->dominio_publico : null,
        $tasacion->tasacionJudicial ? $tasacion->tasacionJudicial->dominio_privado : null,
        $tasacion->tasacionJudicial ? $tasacion->tasacionJudicial->boletin_numero : null,
        $this->formatDate($tasacion->tasacionJudicial ? $tasacion->tasacionJudicial->boletin_fecha : null),
        $tasacion->tasacionJudicial ? $tasacion->tasacionJudicial->boletin_archivo : null,
        $tasacion->tasacionJudicial ? $tasacion->tasacionJudicial->observaciones_finales : null,
        $tasacion->tasacionJudicial ? $tasacion->tasacionJudicial->archivo_observaciones : null,
    ];
}

    /**
     * Función auxiliar para formatear fechas.
     */
    private function formatDate($date)
    {
        // Verifica si la fecha no es nula ni vacía
        return $date ? \Carbon\Carbon::parse($date)->format('d/m/Y') : null;
    }

}
