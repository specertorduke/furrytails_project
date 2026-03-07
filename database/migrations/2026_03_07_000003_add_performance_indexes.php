<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Appointments — frequently filtered by status and date
        Schema::table('appointments', function (Blueprint $table) {
            $table->index('status', 'appointments_status_idx');
            $table->index('date',   'appointments_date_idx');
        });

        // Boardings — frequently filtered by status and date ranges
        Schema::table('boardings', function (Blueprint $table) {
            $table->index('status',     'boardings_status_idx');
            $table->index('start_date', 'boardings_start_date_idx');
        });

        // Payments — frequently filtered by status and user
        Schema::table('payments', function (Blueprint $table) {
            $table->index('status', 'payments_status_idx');
        });

        // Activity logs — add missing indexes for Reports page filtering
        Schema::table('activity_logs', function (Blueprint $table) {
            $table->index('userID', 'activity_logs_user_idx');
            $table->index('action', 'activity_logs_action_idx');
        });
    }

    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            $table->dropIndex('appointments_status_idx');
            $table->dropIndex('appointments_date_idx');
        });

        Schema::table('boardings', function (Blueprint $table) {
            $table->dropIndex('boardings_status_idx');
            $table->dropIndex('boardings_start_date_idx');
        });

        Schema::table('payments', function (Blueprint $table) {
            $table->dropIndex('payments_status_idx');
        });

        Schema::table('activity_logs', function (Blueprint $table) {
            $table->dropIndex('activity_logs_user_idx');
            $table->dropIndex('activity_logs_action_idx');
        });
    }
};
