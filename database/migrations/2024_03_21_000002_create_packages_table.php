<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Agency
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('title');
            $table->string('destination');
            $table->text('description');
            $table->string('duration');
            $table->decimal('price', 10, 2);
            $table->boolean('includes_flights')->default(false);
            $table->boolean('includes_hotel')->default(false);
            $table->string('location'); // Starting location
            $table->enum('status', ['available', 'booked', 'cancelled'])->default('available');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }
}; 