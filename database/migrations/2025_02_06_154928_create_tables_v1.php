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
            $table->string('phone');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });


        Schema::create('employees', function (Blueprint $table) {
            $table->id('employeeID');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('firstName');
            $table->string('lastName');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('role')->nullable();
            $table->timestamps();
        });

        // Set the auto-increment starting value
        DB::statement('ALTER TABLE Employees AUTO_INCREMENT = 1000;');

        // -- Roles:
        // -- 'Administrator','Manager', 'Receptionist', 'Groomer', 'Boarding Attendant',
        // -- 'Veterinarian', 'Pet Trainer',
        // -- 'Cleaning Staff'

        Schema::create('pets', function (Blueprint $table) {
            $table->id('petID');
            $table->string('name', 50);
            $table->string('species', 50);
            $table->string('petType', 50)->nullable();
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
            $table->binary('serviceImage')->nullable();
            $table->string('serviceType', 50);
            $table->decimal('price', 10, 2);
            $table->text('description');
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

        Schema::create('boarding_reservations', function (Blueprint $table) {
            $table->id('reservationID');
            $table->string('boardingType');
            $table->date('startDate');
            $table->date('endDate');
            $table->unsignedBigInteger('petID');
            $table->string('status', 50)->default('Pending');
            $table->foreign('petID')->references('petID')->on('pets')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id('paymentID');
            $table->decimal('amount', 10, 2);
            $table->timestamp('timestamp');
            $table->string('method')->nullable();
            $table->string('status', 50)->default('Pending');
            $table->string('type'); 
            $table->morphs('payable'); // Adds payable_id and payable_type columns
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
        Schema::dropIfExists('appointments');
        Schema::dropIfExists('boarding_reservations');
        Schema::dropIfExists('services');
        Schema::dropIfExists('pets');
        Schema::dropIfExists('users');
        Schema::dropIfExists('employees');
    }
};
