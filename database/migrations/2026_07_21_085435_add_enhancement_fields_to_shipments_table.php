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
        Schema::table('shipments', function (Blueprint $table) {
            // Sender fields
            $table->string('sender_phone', 20)->nullable();
            $table->string('sender_email')->nullable();
            $table->text('sender_address')->nullable();
            
            // Receiver fields
            $table->string('receiver_phone', 20)->nullable();
            $table->string('receiver_email')->nullable();
            $table->text('receiver_address')->nullable();
            
            // Parcel fields
            $table->text('parcel_description')->nullable();
            $table->decimal('parcel_weight', 8, 2)->nullable();
            $table->integer('parcel_quantity')->default(1);
            $table->decimal('declared_value', 10, 2)->nullable();
            
            // Shipping fields
            $table->enum('shipping_method', ['Standard', 'Express', 'Economy'])->default('Standard');
            $table->text('internal_notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shipments', function (Blueprint $table) {
            $table->dropColumn([
                'sender_phone',
                'sender_email',
                'sender_address',
                'receiver_phone',
                'receiver_email',
                'receiver_address',
                'parcel_description',
                'parcel_weight',
                'parcel_quantity',
                'declared_value',
                'shipping_method',
                'internal_notes',
            ]);
        });
    }
};
