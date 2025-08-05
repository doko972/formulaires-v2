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
        Schema::table('sim_cards', function (Blueprint $table) {
            // Ajouter les colonnes manquantes pour les cartes SIM
            $table->enum('option', ['Backup', 'Routeur 4G', 'Téléphonie'])->nullable()->after('work_reception_id');
            $table->enum('operator', ['Free', 'Orange', 'Bouygues'])->nullable()->after('option');
            $table->string('sim_number')->nullable()->after('operator');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sim_cards', function (Blueprint $table) {
            $table->dropColumn(['option', 'operator', 'sim_number']);
        });
    }
};