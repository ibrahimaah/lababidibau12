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
        Schema::table('videos', function (Blueprint $table) {
            $table->timestamps(); // Adds created_at and updated_at columns
            
            // OR if you want to add them individually:
            // $table->timestamp('created_at')->nullable();
            // $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->dropTimestamps();
            
            // OR if you added them individually:
            // $table->dropColumn(['created_at', 'updated_at']);
        });
    }
};