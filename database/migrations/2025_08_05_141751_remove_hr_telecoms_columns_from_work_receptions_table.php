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
        Schema::table('work_receptions', function (Blueprint $table) {
            // Supprimer les colonnes Hr Telecoms
            $table->dropColumn(['hr_telecoms_representative', 'hr_telecoms_signature']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('work_receptions', function (Blueprint $table) {
            // Remettre les colonnes si on fait un rollback
            $table->string('hr_telecoms_representative')->nullable();
            $table->longText('hr_telecoms_signature')->nullable();
        });
    }
};