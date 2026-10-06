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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->enum('type', ['fixed', 'percent']);
            $table->unsignedBigInteger('value');
            $table->unsignedBigInteger('max_discount_amount')->nullable(); //سقف تخفیف
            $table->unsignedBigInteger('min_order_amount')->nullable(); // حداقل مبلغ سفارش
            $table->unsignedInteger('usage_limit')->nullable();
            $table->unsignedInteger('used_count')->nullable();
            $table->timestamp('start_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
