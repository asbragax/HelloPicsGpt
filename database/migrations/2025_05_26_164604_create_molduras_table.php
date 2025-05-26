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
        Schema::create('molduras', function (Blueprint $table) {
            $table->id();
            $table->string('nome'); // ex: "Vintage Branca"
            $table->string('descricao')->nullable(); // opcional
            $table->string('imagem')->nullable(); // caminho para exibir no frontend
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('molduras');
    }
};
