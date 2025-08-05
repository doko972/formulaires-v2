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
            // Ajouter la colonne work_reception_id après l'id
            $table->foreignId('work_reception_id')->after('id')->constrained('work_receptions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sim_cards', function (Blueprint $table) {
            // Supprimer la contrainte de clé étrangère et la colonne
            $table->dropForeign(['work_reception_id']);
            $table->dropColumn('work_reception_id');
        });
    }
};