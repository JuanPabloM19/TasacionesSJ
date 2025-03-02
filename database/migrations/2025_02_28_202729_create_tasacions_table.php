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
        Schema::create('tasacions', function (Blueprint $table) {
            $table->id();
            $table->string('nomenclatura')->unique();
            $table->string('inscripcion_dominio');
            $table->string('ubicacion');
            $table->string('propietarios');
            $table->string('nro_plano');
            $table->decimal('superficie_total', 10, 2);
            $table->decimal('fraccion_expropiar', 10, 2);

            $table->string('nombre_reparticion')->nullable();
            $table->bigInteger('expediente_nro')->nullable();
            $table->date('fecha_iniciacion')->nullable();

            $table->bigInteger('numero_ley')->nullable();
            $table->date('fecha_ley')->nullable();
            $table->string('boletin_oficial')->nullable();
            $table->string('ley_documento')->nullable();

            $table->bigInteger('numero_exp')->nullable();
            $table->decimal('monto_acordado', 10, 2)->nullable();
            $table->date('fecha_notificacion')->nullable();
            $table->string('acta_numero')->nullable();

            $table->boolean('incremento')->nullable();
            $table->boolean('aceptacion')->nullable();
            $table->string('convenio_avenamiento')->nullable();
            $table->decimal('monto_pagado', 10, 2)->nullable();

            $table->string('estado')->default('step1');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasacions');
    }
};
