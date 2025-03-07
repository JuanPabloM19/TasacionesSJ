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
            $table->boolean('aprobado')->default(false);
            $table->foreignId('aprobado_por')->nullable()->constrained('users')->onDelete('set null');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasaciones', function (Blueprint $table) {
            $table->dropColumn('aprobado');
            $table->dropForeign(['aprobado_por']);
            $table->dropColumn('aprobado_por');
        });
    }
};
