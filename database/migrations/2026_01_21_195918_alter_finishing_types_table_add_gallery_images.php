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
        Schema::table('finishing_types', function (Blueprint $table) {
            // Удалить старое поле если существует
            if (Schema::hasColumn('finishing_types', 'image')) {
                $table->dropColumn('image');
            }
            // Добавить новое поле для галереи
            $table->json('gallery_images')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('finishing_types', function (Blueprint $table) {
            $table->string('image', 255)->nullable();
            $table->dropColumn('gallery_images');
        });
    }
};
