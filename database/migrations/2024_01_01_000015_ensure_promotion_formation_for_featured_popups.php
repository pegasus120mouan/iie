<?php

use App\Models\FeaturedPopup;
use App\Models\Formation;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        $promotion = Formation::promotion();

        FeaturedPopup::query()
            ->whereNull('formation_id')
            ->orWhere('formation_id', '!=', $promotion->id)
            ->update(['formation_id' => $promotion->id]);
    }

    public function down(): void
    {
        //
    }
};
