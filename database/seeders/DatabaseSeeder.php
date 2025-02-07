<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1. SERVICES
        DB::table('services')->insert([
            [
                'name' => 'Basic Grooming',
                'serviceImage' => null,
                'serviceType' => 'Grooming',
                'price' => 500.00,
                'description' => 'Basic grooming package',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Full Grooming',
                'serviceImage' => null,
                'serviceType' => 'Grooming',
                'price' => 1500.00,
                'description' => 'Full grooming package',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Overnight Boarding',
                'serviceImage' => null,
                'serviceType' => 'Boarding',
                'price' => 500.00,
                'description' => 'Full grooming package',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 2. EMPLOYEES
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

        // 3. USERS
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

        // 4. PETS
        DB::table('pets')->insert([
            [
                'name' => 'Buddy',
                'species' => 'Dog',
                'breed' => 'Golden Retriever',
                'petImage' => null,
                'petNotes' => 'Very friendly',
                'age' => 3,
                'userID' => 1, // FK to the inserted user above
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 5. APPOINTMENTS
        DB::table('appointments')->insert([
            [
                'date' => '2025-02-15',
                'time' => '10:00:00',
                'serviceID' => 1, // FK to the inserted service
                'petID' => 1,     // FK to the inserted pet
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 6. BOARDING_RESERVATIONS
        DB::table('boarding_reservations')->insert([
            [
                'boardingType' => 'Overnight',
                'startDate' => '2025-03-01',
                'endDate' => '2025-03-05',
                'serviceID' => 3, // FK to the inserted service
                'petID' => 1, // FK to the inserted pet
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // 7. PAYMENTS
        DB::table('payments')->insert([
            [
                'amount' => 200.00,
                'timestamp' => now(),
                'method' => 'Cash',
                'serviceID' => 1, // FK to the inserted appointment
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
