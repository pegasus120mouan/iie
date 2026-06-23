<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('featured_popups', function (Blueprint $table) {
            $table->string('slug')->nullable()->unique()->after('title');
        });

        foreach (DB::table('featured_popups')->get() as $popup) {
            $base = Str::slug($popup->title ?: 'formation-en-vue') ?: 'formation-en-vue';
            $slug = $base;
            $i = 1;

            while (DB::table('featured_popups')->where('slug', $slug)->exists()) {
                $slug = $base.'-'.$i++;
            }

            DB::table('featured_popups')->where('id', $popup->id)->update(['slug' => $slug]);
        }
    }

    public function down(): void
    {
        Schema::table('featured_popups', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
