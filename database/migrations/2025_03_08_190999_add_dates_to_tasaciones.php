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
        Schema::table('tasaciones', function (Blueprint $table) {
            if (!Schema::hasColumn('tasaciones', 'nomenclatura')) {
                $table->string('nomenclatura', 15)->unique();
            }
            if (!Schema::hasColumn('tasaciones', 'inscripcion_dominio')) {
                $table->string('inscripcion_dominio', 200);
            }
            if (!Schema::hasColumn('tasaciones', 'ubicacion')) {
                $table->string('ubicacion', 200);
            }
            if (!Schema::hasColumn('tasaciones', 'propietarios')) {
                $table->string('propietarios', 200);
            }
            if (!Schema::hasColumn('tasaciones', 'nro_plano')) {
                $table->string('nro_plano', 14);
            }
            if (!Schema::hasColumn('tasaciones', 'superficie_total')) {
                $table->decimal('superficie_total', 100, 2);
            }
            if (!Schema::hasColumn('tasaciones', 'unidad_superficie')) {
                $table->enum('unidad_superficie', ['m2', 'ha'])->default('m2');
            }
            if (!Schema::hasColumn('tasaciones', 'fraccion_expropiar')) {
                $table->string('fraccion_expropiar', 200);
            }
            if (!Schema::hasColumn('tasaciones', 'nombre_reparticion')) {
                $table->string('nombre_reparticion', 200)->nullable();
            }
            if (!Schema::hasColumn('tasaciones', 'expediente_nro')) {
                $table->string('expediente_nro', 20)->nullable();
            }
            if (!Schema::hasColumn('tasaciones', 'fecha_iniciacion')) {
                $table->date('fecha_iniciacion')->nullable();
            }
            if (!Schema::hasColumn('tasaciones', 'numero_ley')) {
                $table->string('numero_ley', 200)->nullable();
            }
            if (!Schema::hasColumn('tasaciones', 'fecha_ley')) {
                $table->date('fecha_ley')->nullable();
            }
            if (!Schema::hasColumn('tasaciones', 'boletin_oficial')) {
                $table->string('boletin_oficial')->nullable();
            }
            if (!Schema::hasColumn('tasaciones', 'boletin_oficial_archivo')) {
                $table->string('boletin_oficial_archivo')->nullable();
            }
            if (!Schema::hasColumn('tasaciones', 'ley_documento')) {
                $table->string('ley_documento')->nullable();
            }
            if (!Schema::hasColumn('tasaciones', 'numero_exp')) {
                $table->string('numero_exp', 20)->nullable();
            }
            if (!Schema::hasColumn('tasaciones', 'monto_acordado')) {
                $table->decimal('monto_acordado', 50, 2)->nullable();
            }
            if (!Schema::hasColumn('tasaciones', 'fecha_notificacion')) {
                $table->date('fecha_notificacion')->nullable();
            }
            if (!Schema::hasColumn('tasaciones', 'acta_numero')) {
                $table->string('acta_numero')->nullable();
            }
            if (!Schema::hasColumn('tasaciones', 'acta_documento')) {
                $table->string('acta_documento')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('tasaciones', function (Blueprint $table) {
            $table->dropColumn([
                'inscripcion_dominio',
                'ubicacion',
                'propietarios',
                'nro_plano',
                'superficie_total',
                'unidad_superficie',
                'fraccion_expropiar',
                'nombre_reparticion',
                'expediente_nro',
                'fecha_iniciacion',
                'numero_ley',
                'fecha_ley',
                'boletin_oficial',
                'boletin_oficial_archivo',
                'ley_documento',
                'numero_exp',
                'monto_acordado',
                'fecha_notificacion',
                'acta_numero',
                'acta_documento',
            ]);
        });
    }
};
