<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('total', 10, 2);
            $table->enum('status', ['pendiente', 'pagado', 'cancelado'])->default('pendiente');
            // Datos de tarjeta de pago
            $table->string('card_name')->nullable();
            $table->string('card_number')->nullable(); // Enmascarado
            $table->string('card_expiry')->nullable();
            $table->string('card_cvc')->nullable(); // Enmascarado
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}; 