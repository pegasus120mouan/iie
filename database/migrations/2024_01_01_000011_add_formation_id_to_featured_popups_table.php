<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('featured_popups', function (Blueprint $table) {
            $table->foreignId('formation_id')->nullable()->after('title')->constrained()->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('featured_popups', function (Blueprint $table) {
            $table->dropConstrainedForeignId('formation_id');
        });
    }
};
