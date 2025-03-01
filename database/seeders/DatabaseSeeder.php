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
            // Grooming Services
            [
                'name' => 'Basic Grooming',
                'category' => 'Grooming',
                'price' => 500.00,
                'description' => 'Includes bath and brush, nail trimming, and ear cleaning.',
                'isActive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Full Grooming',
                'category' => 'Grooming',
                'price' => 1500.00,
                'description' => 'Complete package including haircut and styling, de-shedding treatment, and teeth brushing.',
                'isActive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Spa Package',
                'category' => 'Grooming',
                'price' => 2000.00,
                'description' => 'Luxury treatment including aromatherapy bath, paw massage, and blueberry facial.',
                'isActive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Specialty Grooming',
                'category' => 'Grooming',
                'price' => 2500.00,
                'description' => 'Specialized service including breed-specific cuts, flea and tick treatment, and medicated baths.',
                'isActive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Training Services
            [
                'name' => 'Basic Obedience Training',
                'category' => 'Training',
                'price' => 1500.00,
                'description' => 'Training services including basic obedience commands, sit, stay, come, and leash training.',
                'isActive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Veterinary Services
            [
                'name' => 'Health Checkup',
                'category' => 'Veterinary',
                'price' => 250.00,
                'description' => 'Basic wellness examination for your pet.',
                'isActive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Nutritional Counseling',
                'category' => 'Veterinary',
                'price' => 350.00,
                'description' => 'Professional consultation for creating custom diet plans for your pet.',
                'isActive' => false,  // Example of an inactive service
                'created_at' => now(),
                'updated_at' => now(),
            ],
            
            // Boarding Services
            [
                'name' => 'Overnight Boarding',
                'category' => 'Boarding',
                'price' => 500.00,
                'description' => 'Overnight stay including cozy sleeping areas, regular feeding and walks, and playtime.',
                'isActive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Daycare',
                'category' => 'Boarding',
                'price' => 250.00,
                'description' => 'Day stay including supervised playgroups and nap times. Half-day or full-day options.',
                'isActive' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Extended Boarding',
                'category' => 'Boarding',
                'price' => 3000.00,
                'description' => 'Long-term boarding with overnight amenities plus additional activities. Special care for extended stays.',
                'isActive' => true,
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

        DB::table('users')->insert([
            [
                'firstName' => 'Admin',
                'lastName' => 'User',
                'email' => 'admin@furrytails.com',
                'username' => 'admin',
                'phone' => '09123456789',
                'password' => bcrypt('admin123'),
                'role' => 'admin', // Make sure you've added the role column to users table
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
                'gender' => 'Male',
                'birthDate' => '2020-03-15',
                'weight' => 32.5,
                'isVaccinated' => true,
                'lastVaccinationDate' => '2024-01-15',
                'allergies' => 'None',
                'medicalHistory' => 'Regular checkups, no major health issues',
                'petNotes' => 'Very friendly, loves to play fetch',
                'petImage' => 'seed/buddy.png',
                'userID' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Luna',
                'species' => 'Cat',
                'petType' => 'Persian',
                'gender' => 'Female',
                'birthDate' => '2021-06-20',
                'weight' => 4.2,
                'isVaccinated' => true,
                'lastVaccinationDate' => '2024-02-01',
                'allergies' => 'Seafood',
                'medicalHistory' => 'Annual vaccinations up to date',
                'petNotes' => 'Quiet and gentle, prefers indoor activities',
                'petImage' => 'seed/luna.png',
                'userID' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Max',
                'species' => 'Dog',
                'petType' => 'Beagle',
                'gender' => 'Male',
                'birthDate' => '2022-01-10',
                'weight' => 12.8,
                'isVaccinated' => false,
                'lastVaccinationDate' => null,
                'allergies' => 'Chicken',
                'medicalHistory' => 'Minor skin allergy treatment in 2023',
                'petNotes' => 'Energetic and loves to explore',
                'petImage' => 'seed/max.jpg',
                'userID' => 1,
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
                'status' => 'Confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => '2025-03-15',
                'time' => '10:00:00',
                'serviceID' => 2, 
                'petID' => 1,
                'status' => 'Confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        //BOARDINGS
        DB::table('boarding_reservations')->insert([
            [
                'boardingType' => 'Overnight',
                'start_date' => '2025-03-01',
                'end_date' => '2025-03-05',
                'petID' => 1,
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'boardingType' => 'Overnight',
                'start_date' => '2025-03-06',
                'end_date' => '2025-03-08',
                'petID' => 1,
                'status' => 'Active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // PAYMENTS
        DB::table('payments')->insert([
            // Appointment 1 payments (downpayment + balance)
            [
                'amount' => 250.00, // 50% downpayment
                'payment_method' => 'Cash',
                'reference_number' => 'DP-APT1-001',
                'status' => 'Completed',
                'payable_id' => 1,
                'payable_type' => 'App\Models\Appointment',
                'userID' => 1,
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(5),
            ],
            [
                'amount' => 250.00, // remaining balance
                'payment_method' => 'GCash',
                'reference_number' => 'GC-APT1-002',
                'status' => 'Completed',
                'payable_id' => 1,
                'payable_type' => 'App\Models\Appointment',
                'userID' => 1,
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subDays(1),
            ],

            // Appointment 2 payment (full payment)
            [
                'amount' => 1500.00,
                'payment_method' => 'Credit Card',
                'reference_number' => 'CC-APT2-001',
                'status' => 'Completed',
                'payable_id' => 2,
                'payable_type' => 'App\Models\Appointment',
                'userID' => 1,
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDays(2),
            ],

            // Boarding 1 payments (downpayment only, balance pending)
            [
                'amount' => 1000.00, // 50% downpayment
                'payment_method' => 'Bank Transfer',
                'reference_number' => 'BT-BRD1-001',
                'status' => 'Completed',
                'payable_id' => 1,
                'payable_type' => 'App\Models\Boarding', // Fixed the model name
                'userID' => 1,
                'created_at' => now()->subDays(7),
                'updated_at' => now()->subDays(7),
            ],
            [
                'amount' => 1000.00, // remaining balance
                'payment_method' => 'Cash',
                'reference_number' => null, // No reference yet since it's pending
                'status' => 'Pending',
                'payable_id' => 1,
                'payable_type' => 'App\Models\Boarding', // Fixed the model name
                'userID' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
