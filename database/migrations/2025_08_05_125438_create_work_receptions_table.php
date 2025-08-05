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
        Schema::create('work_receptions', function (Blueprint $table) {
            $table->id();
            
            // Section 1: Informations générales
            $table->string('company_name')->nullable();
            $table->string('client_name')->nullable();
            $table->string('acting_as')->nullable(); // Agissant en qualité de
            
            // Section 2: Coordonnées
            $table->text('installation_address')->nullable();
            $table->string('postal_code', 10)->nullable();
            $table->string('city')->nullable();
            
            // Section 3: Description des travaux
            $table->text('work_description')->nullable(); // Nature des travaux
            $table->string('model')->nullable(); // Modèle de matériel
            $table->integer('quantity')->nullable();
            
            // Section 4: Juridique
            $table->boolean('contract_reception_checked')->default(false);
            $table->date('contract_date')->nullable();
            $table->boolean('work_compliance_checked')->default(false);
            $table->string('electronic_location')->nullable(); // Fait électroniquement à
            $table->string('signatory_name')->nullable();
            $table->longText('client_signature')->nullable(); // Signature du client/signataire base64
            $table->string('technician_name')->nullable(); // Nom du technicien
            $table->longText('technician_signature')->nullable(); // Signature du technicien base64
            $table->string('hr_telecoms_representative')->nullable(); // Pour Hr Telecoms
            $table->longText('hr_telecoms_signature')->nullable(); // Signature Hr Telecoms base64
            
            // Métadonnées
            $table->enum('status', ['draft', 'validated'])->default('draft');
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Lien avec l'utilisateur connecté
            $table->timestamp('validated_at')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('work_receptions');
    }
};