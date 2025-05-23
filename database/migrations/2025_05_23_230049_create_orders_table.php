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
        Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('pack_id')->constrained()->onDelete('cascade');
        $table->enum('status', ['pending', 'paid', 'in_production', 'shipped', 'delivered', 'cancelled'])->default('pending');
        $table->string('payment_status')->default('pending');
        $table->decimal('total_price', 10, 2);
        $table->boolean('caption_enabled')->default(false);
        $table->text('shipping_address');
        $table->string('tracking_code')->nullable();
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
