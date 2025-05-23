<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up() : void
    {
        Schema::create('packs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('size'); // ex: 5x7, 5x5
            $table->integer('photo_limit');
            $table->decimal('price', 10, 2);
            $table->boolean('includes_caption')->default(false);
            $table->boolean('includes_mold')->default(false);
            $table->string('mold_style')->nullable(); // nome da moldura
            $table->boolean('status')->default(true); // ativo/inativo
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packs');
    }
};
