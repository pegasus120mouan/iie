<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('numero_dossier')->unique();
            $table->foreignId('formation_id')->constrained()->cascadeOnDelete();
            $table->string('nom');
            $table->string('prenoms');
            $table->date('date_naissance');
            $table->enum('sexe', ['M', 'F']);
            $table->string('telephone');
            $table->string('whatsapp')->nullable();
            $table->string('email');
            $table->text('adresse');
            $table->string('niveau_etude');
            $table->string('photo')->nullable();
            $table->string('piece_identite')->nullable();
            $table->enum('statut', ['en_attente', 'validee', 'refusee', 'annulee'])->default('en_attente');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
    }
};
