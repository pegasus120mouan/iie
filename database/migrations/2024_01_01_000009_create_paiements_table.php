<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('inscription_id')->constrained()->cascadeOnDelete();
            $table->decimal('montant', 12, 2);
            $table->enum('mode', ['especes', 'virement', 'mobile_money', 'carte', 'cheque'])->default('especes');
            $table->enum('statut', ['en_attente', 'valide', 'refuse', 'rembourse'])->default('en_attente');
            $table->string('reference')->nullable();
            $table->date('date_paiement')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
