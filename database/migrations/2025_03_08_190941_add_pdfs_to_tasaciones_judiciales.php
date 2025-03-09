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
        Schema::table('tasaciones_judiciales', function (Blueprint $table) {
            if (!Schema::hasColumn('tasaciones_judiciales', 'expediente_nro')) {
                $table->string('expediente_nro', 20)->nullable();
            }
            if (!Schema::hasColumn('tasaciones_judiciales', 'fecha_inicio')) {
                $table->date('fecha_inicio')->nullable();
            }
            if (!Schema::hasColumn('tasaciones_judiciales', 'juzgado_interviniente')) {
                $table->string('juzgado_interviniente', 200)->nullable();
            }
            if (!Schema::hasColumn('tasaciones_judiciales', 'caratula')) {
                $table->string('caratula', 200)->nullable();
            }
            if (!Schema::hasColumn('tasaciones_judiciales', 'boleta_deposito')) {
                $table->string('boleta_deposito')->nullable();
            }
            if (!Schema::hasColumn('tasaciones_judiciales', 'nro_comprobante')) {
                $table->string('nro_comprobante', 200)->nullable();
            }
            if (!Schema::hasColumn('tasaciones_judiciales', 'instrumento_legal_pdf')) {
                $table->string('instrumento_legal_pdf')->nullable();
            }
            if (!Schema::hasColumn('tasaciones_judiciales', 'dominio_publico_pdf')) {
                $table->string('dominio_publico_pdf')->nullable();
            }
            if (!Schema::hasColumn('tasaciones_judiciales', 'dominio_privado_pdf')) {
                $table->string('dominio_privado_pdf')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('tasaciones_judiciales', function (Blueprint $table) {
            $table->dropColumn([
                'fecha_inicio',
                'juzgado_interviniente',
                'caratula',
                'boleta_deposito',
                'nro_comprobante',
                'instrumento_legal_pdf',
                'dominio_publico_pdf',
                'dominio_privado_pdf',
            ]);

            // No eliminamos 'expediente_nro' para evitar errores si ya existía antes
        });
    }
};
