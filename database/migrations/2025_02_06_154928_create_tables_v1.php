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
        Schema::create('users', function (Blueprint $table) {
            $table->id('userID');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->string('userImage')->nullable()->default('userImages/default.png');
            $table->string('username')->unique();
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->string('phone');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        // Set the auto-increment starting value
        DB::statement('ALTER TABLE Users AUTO_INCREMENT = 1000;');

        Schema::create('pets', function (Blueprint $table) {
            $table->id('petID');
            $table->string('name', 50);
            $table->string('species', 50);
            $table->string('breed', 50)->nullable(); 
            $table->string('gender', 10);  // Add gender
            $table->date('birthDate');     // Replace age with birthDate
            $table->decimal('weight', 5, 2)->nullable(); // Add weight in kg
            $table->string('petImage')->nullable()->default('petImages/default.png');
            $table->text('petNotes')->nullable();
            $table->text('medicalHistory')->nullable(); // Add medical history
            $table->text('allergies')->nullable();      // Add allergies
            $table->boolean('isVaccinated')->default(false); // Add vaccination status
            $table->date('lastVaccinationDate')->nullable(); // Add last vaccination date
            $table->unsignedBigInteger('userID');
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('services', function (Blueprint $table) {
            $table->id('serviceID');
            $table->string('name', 100);
            $table->string('serviceImage')->nullable()->default('serviceImages/default.png');  // Changed from binary to string
            $table->string('category', 50);  // Changed from serviceType to category
            $table->decimal('price', 10, 2);
            $table->text('description')->nullable();  // Made nullable
            $table->boolean('isActive')->default(true);  // Added isActive field
            $table->timestamps();
        });

        Schema::create('appointments', function (Blueprint $table) {
            $table->id('appointmentID');
            $table->date('date');
            $table->time('time');
            $table->unsignedBigInteger('serviceID');
            $table->unsignedBigInteger('petID');
            $table->string('status', 50)->default('Pending');
            $table->foreign('serviceID')->references('serviceID')->on('services')->onDelete('cascade');
            $table->foreign('petID')->references('petID')->on('pets')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('boardings', function (Blueprint $table) {
            $table->id('boardingID');
            $table->unsignedBigInteger('petID');
            $table->string('boardingType');
            $table->foreign('petID')->references('petID')->on('pets')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['Confirmed','Active', 'Completed', 'Cancelled'])->default('Active');
            $table->timestamps();
        });

        // Schema::create('payments', function (Blueprint $table) {
        //     $table->id('paymentID');
        //     $table->decimal('amount', 10, 2);
        //     $table->timestamp('timestamp');
        //     $table->string('method')->nullable();
        //     $table->string('status', 50)->default('Pending');
        //     $table->string('type'); 
        //     $table->morphs('payable'); // Adds payable_id and payable_type columns
        //     $table->timestamps();
        // });

        Schema::create('payments', function (Blueprint $table) {
            $table->id('paymentID');
            $table->decimal('amount', 10, 2);
            $table->enum('payment_method', ['Cash', 'Credit Card', 'Debit Card', 'PayPal', 'GCash', 'Bank Transfer', 'Other'])
                  ->default('Cash');
            $table->string('reference_number')->nullable(); // Transaction ID, receipt number, etc.
            $table->enum('status', ['Pending', 'Completed', 'Failed', 'Refunded'])
                  ->default('Pending');
            
            // Polymorphic relationship - to connect with appointments or boardings
            $table->morphs('payable');
            
            // Track who made the payment
            $table->unsignedBigInteger('userID');
            $table->foreign('userID')->references('userID')->on('users')->onDelete('cascade');
            
            $table->timestamps(); // Already gives you created_at which works as the payment timestamp
        });

        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id('logID');
            $table->string('table_name');      // The table being modified
            $table->unsignedBigInteger('record_id'); // ID of the record being changed
            $table->string('action');          // 'create', 'update', 'delete'
            $table->text('old_values')->nullable(); // JSON of old values (for updates/deletes)
            $table->text('new_values')->nullable(); // JSON of new values (for creates/updates)
            $table->unsignedBigInteger('userID')->nullable(); // User who made the change
            $table->string('ip_address')->nullable(); // IP address of user
            $table->string('user_agent')->nullable(); // Browser/app info
            $table->timestamps();
            
            // Indexes for faster searching
            $table->index(['table_name', 'record_id']);
            $table->index('created_at');
            
            // Foreign key for user
            $table->foreign('userID')->references('userID')->on('users')->onDelete('set null');
        });        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('boardings');
        Schema::dropIfExists('services');
        Schema::dropIfExists('pets');
        Schema::dropIfExists('users');
        Schema::dropIfExists('activity_logs');
    }
};
