<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // SERVICES
        DB::table('services')->insert([
            // Appointment Services
            [
                'name' => 'Basic Grooming',
                'serviceImage' => null,
                'serviceType' => 'Appointment',
                'price' => 500.00,
                'description' => 'Includes bath and brush, nail trimming, and ear cleaning.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Full Grooming',
                'serviceImage' => null,
                'serviceType' => 'Appointment',
                'price' => 1500.00,
                'description' => 'Complete package including haircut and styling, de-shedding treatment, and teeth brushing.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Spa Package',
                'serviceImage' => null,
                'serviceType' => 'Appointment',
                'price' => 2000.00,
                'description' => 'Luxury treatment including aromatherapy bath, paw massage, and blueberry facial.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Specialty Grooming',
                'serviceImage' => null,
                'serviceType' => 'Appointment',
                'price' => 2500.00,
                'description' => 'Specialized service including breed-specific cuts, flea and tick treatment, and medicated baths.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pet Training',
                'serviceImage' => null,
                'serviceType' => 'Appointment',
                'price' => 1500.00,
                'description' => 'Training services including basic obedience, behavioral correction, and socialization.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Health Checkup',
                'serviceImage' => null,
                'serviceType' => 'Appointment',
                'price' => 250.00,
                'description' => 'Basic wellness examination for your pet.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nutritional Counseling',
                'serviceImage' => null,
                'serviceType' => 'Appointment',
                'price' => 350.00,
                'description' => 'Professional consultation for creating custom diet plans for your pet.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Boarding Services
            [
                'name' => 'Overnight Boarding',
                'serviceImage' => null,
                'serviceType' => 'Boarding',
                'price' => 500.00,
                'description' => 'Overnight stay including cozy sleeping areas, regular feeding and walks, and playtime.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Daycare',
                'serviceImage' => null,
                'serviceType' => 'Boarding',
                'price' => 250.00,
                'description' => 'Day stay including supervised playgroups and nap times. Half-day or full-day options.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Extended Boarding',
                'serviceImage' => null,
                'serviceType' => 'Boarding',
                'price' => 500.00,
                'description' => 'Long-term boarding with overnight amenities plus additional activities. Special care for extended stays.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // EMPLOYEES
        DB::table('employees')->insert([
            [
                'username' => 'employee001',
                'password' => bcrypt('password123'),
                'firstName' => 'John',
                'lastName' => 'Doe',
                'email' => 'john.doe@example.com',
                'phone' => '09123456789',
                'role' => 'Manager',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // USERS
        DB::table('users')->insert([
            [
                'firstName' => 'Jane',
                'lastName' => 'Smith',
                'email' => 'jane.smith@example.com',
                'username' => 'janesmith',
                'phone' => '09876543210',
                'password' => bcrypt('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // PETS
        DB::table('pets')->insert([
            [
                'name' => 'Buddy',
                'species' => 'Dog',
                'petType' => 'Golden Retriever',
                'petNotes' => 'Very friendly',
                'age' => 3,
                'userID' => 1, // FK to the inserted user above
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Moodeng',
                'species' => 'Hippopotamus',
                'petType' => 'Pygmy Hippo',
                'petNotes' => 'Loves Biting',
                'age' => 2,
                'userID' => 1, // FK to the inserted user above
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // APPOINTMENTS
        DB::table('appointments')->insert([
            [
                'date' => '2025-03-15',
                'time' => '10:00:00',
                'serviceID' => 1, 
                'petID' => 1,
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => '2025-03-15',
                'time' => '10:00:00',
                'serviceID' => 2, 
                'petID' => 1,
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        //BOARDINGS
        DB::table('boarding_reservations')->insert([
            [
                'boardingType' => 'Overnight',
                'startDate' => '2025-03-01',
                'endDate' => '2025-03-05',
                'serviceID' => 8, 
                'petID' => 1,
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'boardingType' => 'Overnight',
                'startDate' => '2025-03-06',
                'endDate' => '2025-03-08',
                'serviceID' => 8, 
                'petID' => 1,
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // PAYMENTS
        DB::table('payments')->insert([
            [
                'amount' => 200.00,
                'timestamp' => now(),
                'method' => 'Cash',
                'status' => 'Pending',
                'payable_id' => 1, // ID of the related appointment or boarding reservation
                'payable_type' => Appointment::class, // Class name of the related model
            ],
            [
                'amount' => 300.00,
                'timestamp' => now(),
                'method' => 'Credit Card',
                'status' => 'Completed',
                'payable_id' => 1, // ID of the related appointment or boarding reservation
                'payable_type' => BoardingReservation::class, // Class name of the related model
            ],
        ]);
    }
}
