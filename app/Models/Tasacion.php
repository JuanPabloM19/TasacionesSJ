<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasacion extends Model
{
    use HasFactory;

    protected $table = 'tasaciones';

    protected $fillable = [
        'nomenclatura',
        'inscripcion_dominio',
        'ubicacion',
        'propietarios',
        'nro_plano',
        'superficie_total',
        'fraccion_expropiar',
        'nombre_reparticion',
        'expediente_nro',
        'fecha_iniciacion',
        'numero_ley',
        'fecha_ley',
        'boletin_oficial',
        'ley_documento',
        'numero_exp',
        'monto_acordado',
        'fecha_notificacion',
        'acta_numero',
        'incremento',
        'aceptacion',
        'convenio_avenamiento',
        'monto_pagado',
        'estado',
    ];

    public function tasacionJudicial()
    {
        return $this->hasOne(TasacionJudicial::class, 'tasacion_id');
    }

    public function getEstadoJudicialAttribute()
    {
        return $this->tasacionJudicial->estado ?? null;
    }

}
