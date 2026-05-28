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
        Schema::create('calendrier_events', function (Blueprint $table) {
            $table->id();
            $table->string('label');                        // Ex: "VACANCES DE NOËL"
            $table->string('date_affichee')->nullable();    // Ex: "Vend. 19 déc. 2025 → Lun. 05 jan. 2026"
            $table->string('duree')->default('—');          // Ex: "16 j."
            $table->string('type')->default('classes');     // classes | vacances | rentree | ferie
            $table->string('icone')->default('fi-sr-book'); // Flaticon class
            $table->unsignedSmallInteger('ordre')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calendrier_events');
    }
};
