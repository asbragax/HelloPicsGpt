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
        Schema::create('external_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('pedido_id')
                ->constrained('pedidos')
                ->onDelete('cascade');
            $table->text('url');
            $table->boolean('valid')->default(false);
            $table->text('notes')->nullable();
            $table->boolean('reviewed_by_admin')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('external_links');
    }
};
