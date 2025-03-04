<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasaciones_judiciales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tasacion_id')->constrained('tasaciones')->onDelete('cascade'); // Relación con tasaciones

            // Step 6: Actuaciones Judiciales
            $table->string('expediente_nro')->nullable();
            $table->date('fecha_inicio')->nullable();
            $table->string('juzgado_interviniente')->nullable();
            $table->string('caratula')->nullable();
            $table->string('boleta_deposito')->nullable();
            $table->string('nro_comprobante')->nullable();
            $table->decimal('monto_depositado', 15, 2)->nullable();
            $table->text('observaciones')->nullable();

            // Step 7: Monto Indemnizatorio
            $table->string('dictamen_expediente')->nullable();
            $table->date('dictamen_fecha')->nullable();
            $table->decimal('dictamen_monto', 15, 2)->nullable();
            $table->date('orden_pago_fecha')->nullable();
            $table->decimal('orden_pago_monto', 15, 2)->nullable();
            $table->string('instrumento_legal')->nullable();
            $table->text('concepto_indemnizacion')->nullable();

            // Step 8: Transferencia de Dominio
            $table->string('dominio_publico')->nullable();
            $table->string('dominio_privado')->nullable();

            // Step 9: Boletín Oficial
            $table->string('boletin_numero')->nullable();
            $table->date('boletin_fecha')->nullable();
            $table->string('boletin_archivo')->nullable();

            // Step 10: Observaciones Finales
            $table->text('observaciones_finales')->nullable();
            $table->string('archivo_observaciones')->nullable();

            // Estado del proceso judicial
            $table->enum('estado', ['step6', 'step7', 'step8', 'step9', 'step10', 'completed'])->default('step6');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasaciones_judiciales');
    }
};
