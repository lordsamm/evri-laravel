<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payment_proofs', function (Blueprint $table) {
            $table->foreignId('shipment_fee_id')->nullable()->after('id')->constrained('shipment_fees')->onDelete('cascade');
        });

        // Delete existing payment proofs since they can't be mapped to specific fees
        DB::table('payment_proofs')->delete();

        Schema::table('payment_proofs', function (Blueprint $table) {
            $table->dropForeign(['shipment_id']);
            $table->dropColumn('shipment_id');
            $table->unsignedBigInteger('shipment_fee_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_proofs', function (Blueprint $table) {
            $table->foreignId('shipment_id')->nullable()->after('id')->constrained()->onDelete('cascade');
        });

        // Delete existing payment proofs since they can't be mapped back to shipments
        DB::table('payment_proofs')->delete();

        Schema::table('payment_proofs', function (Blueprint $table) {
            $table->dropForeign(['shipment_fee_id']);
            $table->dropColumn('shipment_fee_id');
            $table->unsignedBigInteger('shipment_id')->nullable(false)->change();
        });
    }
};
