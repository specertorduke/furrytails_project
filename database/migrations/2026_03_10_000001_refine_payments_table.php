<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Sanitise any existing rows that use a method we're removing
        DB::statement("UPDATE payments SET payment_method = 'Cash'
            WHERE payment_method NOT IN ('Cash', 'GCash')");

        // Narrow the payment_method enum to Cash / GCash only
        DB::statement("ALTER TABLE payments
            MODIFY COLUMN payment_method ENUM('Cash','GCash') NOT NULL DEFAULT 'Cash'");

        // Add payment_type (deposit | full | balance) and total_cost columns
        Schema::table('payments', function (Blueprint $table) {
            $table->decimal('total_cost', 10, 2)->nullable()->after('amount');
            $table->enum('payment_type', ['deposit', 'full', 'balance'])
                  ->default('full')
                  ->after('total_cost');
        });

        // Back-fill existing rows: treat all existing payments as 'full'
        DB::statement("UPDATE payments SET payment_type = 'full', total_cost = amount
            WHERE payment_type IS NULL OR total_cost IS NULL");
    }

    public function down(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn(['total_cost', 'payment_type']);
        });

        DB::statement("ALTER TABLE payments
            MODIFY COLUMN payment_method
            ENUM('Cash','Credit Card','Debit Card','PayPal','GCash','Bank Transfer','Other')
            NOT NULL DEFAULT 'Cash'");
    }
};
