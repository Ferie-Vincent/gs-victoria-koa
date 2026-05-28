<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('temoignages', function (Blueprint $table) {
            $table->id();
            $table->string('nom_parent');
            $table->string('role_parent'); // "Maman d'Ange, CP1"
            $table->string('initiales', 5);
            $table->string('bg_color')->default('bg-violet-600'); // Tailwind class
            $table->text('texte');
            $table->tinyInteger('note')->default(5);
            $table->boolean('publie')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('temoignages');
    }
};
