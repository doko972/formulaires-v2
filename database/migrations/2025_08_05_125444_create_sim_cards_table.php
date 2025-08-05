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
        Schema::create('sim_cards', function (Blueprint $table) {
            $table->id();
            
            // Relation avec work_receptions
            $table->foreignId('work_reception_id')->constrained()->onDelete('cascade');
            
            // Données de la carte SIM
            $table->enum('option', ['Backup', 'Routeur 4G', 'Téléphonie'])->nullable();
            $table->enum('operator', ['Free', 'Orange', 'Bouygues'])->nullable();
            $table->string('sim_number')->nullable(); // N° de Carte Sim
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sim_cards');
    }
};