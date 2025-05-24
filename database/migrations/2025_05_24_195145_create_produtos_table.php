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
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('size'); // Ex: 5x7, 5x5, 7x10
            $table->integer('photo_limit'); // Total de fotos no pack
            $table->decimal('price', 10, 2);
            $table->boolean('includes_caption')->default(false); // Permite legenda
            $table->boolean('includes_mold')->default(false);    // Permite moldura
            $table->boolean('status')->default(true);            // Ativo ou inativo
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
