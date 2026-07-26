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
        Schema::create('shipments', function (Blueprint $table) {
            $table->id();
            $table->string('tracking_number')->unique();
            $table->string('sender_name');
            $table->string('receiver_name');
            $table->unsignedBigInteger('origin_country_id')->nullable();
            $table->unsignedBigInteger('destination_country_id')->nullable();
            $table->string('current_status');
            $table->string('payment_status');
            $table->decimal('shipping_cost', 10, 2);
            $table->date('estimated_delivery')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
