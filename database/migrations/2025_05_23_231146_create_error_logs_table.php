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
        Schema::create('error_logs', function (Blueprint $table) {
            $table->id();
            $table->text('message'); // Mensagem principal do erro
            $table->text('trace')->nullable(); // Stack trace, se necessário
            $table->string('url')->nullable(); // Rota onde ocorreu o erro
            $table->string('method')->nullable(); // GET, POST, etc
            $table->string('ip')->nullable(); // IP do usuário
            $table->string('user_agent')->nullable(); // Navegador/dispositivo
            $table->unsignedBigInteger('user_id')->nullable(); // Se estiver logado
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('error_logs');
    }
};
