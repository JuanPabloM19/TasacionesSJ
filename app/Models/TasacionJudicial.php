<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TasacionJudicial extends Model {
    use HasFactory;

    protected $table = 'tasaciones_judiciales';

    protected $fillable = [
        'tasacion_id',
        'expediente_nro',
        'fecha_inicio',
        'juzgado_interviniente',
        'caratula',
        'boleta_deposito',
        'nro_comprobante',
        'monto_depositado',
        'observaciones',

        'dictamen_expediente',
        'dictamen_fecha',
        'dictamen_monto',
        'orden_pago_fecha',
        'orden_pago_monto',
        'instrumento_legal',
        'concepto_indemnizacion',

        'dominio_publico',
        'dominio_privado',

        'boletin_numero',
        'boletin_fecha',
        'boletin_archivo',

        'observaciones_finales',
        'archivo_observaciones',

        'estado',
    ];

    public function tasacion()
    {
        return $this->belongsTo(Tasacion::class, 'tasacion_id');
    }

}
