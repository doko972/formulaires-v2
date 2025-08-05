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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            
            // Relation avec work_receptions
            $table->foreignId('work_reception_id')->constrained('work_receptions')->onDelete('cascade');
            
            // Données du matériel
            $table->string('name')->nullable(); // Nom/modèle du matériel
            $table->string('type')->nullable(); // Type de matériel
            $table->integer('quantity')->nullable(); // Quantité
            $table->text('description')->nullable(); // Description optionnelle
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};