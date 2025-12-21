<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('map_settings', function (Blueprint $table) {
            $table->id();
            $table->text('embed_url')->nullable();
            $table->integer('height')->default(270);
            $table->boolean('is_active')->default(true);
            // $table->string('location_name')->nullable();
            // $table->text('address')->nullable();
            $table->timestamps();
        });

        // Insert default data
        DB::table('map_settings')->insert([
            'embed_url' => 'https://www.google.com/maps/embed?pb=!1m17!1m12!1m3!1d2000.50685128268!2d6.956550975592145!3d50.62490387478869!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m2!1m1!2zNTDCsDM3JzI5LjYiTiA2wrA1NyczMi45IkU!5e1!3m2!1sen!2s!4v1765740969123!5m2!1sen!2s',
            'height' => 270,
            'is_active' => true,
            // 'location_name' => 'Default Location',
            // 'address' => 'Cologne, Germany',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('map_settings');
    }
};
