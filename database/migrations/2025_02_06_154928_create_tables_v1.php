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
            $table->string('username')->unique();
            $table->string('phone');
            $table->string('password');
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
            $table->string('breed', 50)->nullable();
            $table->binary('petImage')->nullable();
            $table->text('petNotes')->nullable();
            $table->tinyInteger('age')->nullable();
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
            $table->unsignedBigInteger('serviceID');
            $table->unsignedBigInteger('petID');
            $table->string('status', 50)->default('Pending');
            $table->foreign('serviceID')->references('serviceID')->on('services')->onDelete('cascade');
            $table->foreign('petID')->references('petID')->on('pets')->onDelete('cascade');
            $table->timestamps();
        });

        Schema::create('payments', function (Blueprint $table) {
            $table->id('paymentID');
            $table->decimal('amount', 10, 2);
            $table->timestamp('timestamp');
            $table->string('method')->nullable();
            $table->unsignedBigInteger('serviceID')->nullable();
            $table->string('status', 50)->default('Pending');
            $table->foreign('serviceID')->references('serviceID')->on('services')->onDelete('set null');
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
