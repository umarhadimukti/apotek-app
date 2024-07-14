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
        Schema::create('product_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('total_amount');
            $table->boolean('is_paid');
            $table->text('address')->nullable();
            $table->string('city')->nullable();
            $table->string('post_code')->nullable();
            $table->string('phone');
            $table->text('notes')->nullable();
            $table->string('proof');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_transactions');
    }
};
