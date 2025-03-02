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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username');
            }  // Añadir el campo username
            if (!Schema::hasColumn('users', 'nombre')) {
                $table->string('nombre');
            }
            if (!Schema::hasColumn('users', 'apellido')) {
                $table->string('apellido');
            }
            if (!Schema::hasColumn('users', 'dni')) {
                $table->string('dni');
            }
            if (!Schema::hasColumn('users', 'telefono')) {
                $table->string('telefono');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'username')) {
                $table->string('username');
            }
            if (!Schema::hasColumn('users', 'nombre')) {
                $table->string('nombre');
            }
            if (!Schema::hasColumn('users', 'apellido')) {
                $table->string('apellido');
            }
            if (!Schema::hasColumn('users', 'dni')) {
                $table->string('dni');
            }
            if (!Schema::hasColumn('users', 'telefono')) {
                $table->string('telefono');
            }
        });
    }
};
