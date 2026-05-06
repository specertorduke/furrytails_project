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
                'price' => 1000.00,
                'description' => 'Long-term boarding with overnight amenities plus additional activities. Special care for extended stays.',
                'isActive' => true,
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
                'phone' => '987 654 3210',
                'password' => bcrypt('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstName' => 'Test',
                'lastName' => 'Test',
                'email' => 'test.test@example.com',
                'username' => 'testtest',
                'phone' => '987 574 3210',
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
                'phone' => '912 345 6789',
                'password' => bcrypt('admin123'),
                'role' => 'admin',
                'admin_role' => 'super_admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstName' => 'Maria',
                'lastName' => 'Manager',
                'email' => 'manager@furrytails.com',
                'username' => 'mmanager',
                'phone' => '911 111 1111',
                'password' => bcrypt('Manager@2026'),
                'role' => 'admin',
                'admin_role' => 'manager',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstName' => 'Carlos',
                'lastName' => 'Staff',
                'email' => 'staff@furrytails.com',
                'username' => 'cstaff',
                'phone' => '922 222 2222',
                'password' => bcrypt('Staff@2026'),
                'role' => 'admin',
                'admin_role' => 'staff',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'firstName' => 'Viewer',
                'lastName' => 'Account',
                'email' => 'viewer@furrytails.com',
                'username' => 'viewonly',
                'phone' => '933 333 3333',
                'password' => bcrypt('Viewer@2026'),
                'role' => 'admin',
                'admin_role' => 'viewer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // PETS
        DB::table('pets')->insert([
            [
                'name' => 'Buddy',
                'species' => 'Dog',
                'breed' => 'Golden Retriever',
                'gender' => 'Male',
                'birthDate' => '2020-03-15',
                'weight' => 32.5,
                'isVaccinated' => true,
                'lastVaccinationDate' => '2024-01-15',
                'allergies' => 'None',
                'medicalHistory' => 'Regular checkups, no major health issues',
                'petNotes' => 'Very friendly, loves to play fetch',
                'petImage' => 'seed/buddy.png',
                'userID' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Luna',
                'species' => 'Cat',
                'breed' => 'Persian',
                'gender' => 'Female',
                'birthDate' => '2021-06-20',
                'weight' => 4.2,
                'isVaccinated' => true,
                'lastVaccinationDate' => '2024-02-01',
                'allergies' => 'Seafood',
                'medicalHistory' => 'Annual vaccinations up to date',
                'petNotes' => 'Quiet and gentle, prefers indoor activities',
                'petImage' => 'seed/luna.png',
                'userID' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Max',
                'species' => 'Dog',
                'breed' => 'Beagle',
                'gender' => 'Male',
                'birthDate' => '2022-01-10',
                'weight' => 12.8,
                'isVaccinated' => false,
                'lastVaccinationDate' => null,
                'allergies' => 'Chicken',
                'medicalHistory' => 'Minor skin allergy treatment in 2023',
                'petNotes' => 'Energetic and loves to explore',
                'petImage' => 'seed/max.jpg',
                'userID' => 1000,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // APPOINTMENTS
        DB::table('appointments')->insert([
            [
                'date' => '2027-03-15',
                'time' => '10:00:00',
                'serviceID' => 1, 
                'petID' => 1,
                'status' => 'Confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'date' => '2027-03-16',
                'time' => '10:00:00',
                'serviceID' => 2, 
                'petID' => 1,
                'status' => 'Confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        //BOARDINGS
        DB::table('boardings')->insert([
            [
                'boardingType' => 'Overnight',
                'start_date' => '2027-03-15',
                'end_date' => '2027-03-16',
                'petID' => 1,
                'status' => 'Confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'boardingType' => 'Daycare',
                'start_date' => '2027-03-18',
                'end_date' => '2027-03-18',
                'petID' => 1,
                'status' => 'Pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // PAYMENTS
        DB::table('payments')->insert([
            // Appointment 1 (Basic Grooming ₱500): GCash 30% deposit paid online, balance collected at visit
            [
                'amount'           => 150.00,   // 30% of ₱500
                'total_cost'       => 500.00,
                'payment_type'     => 'deposit',
                'payment_method'   => 'GCash',
                'reference_number' => 'GC2026031000001',
                'status'           => 'Completed',
                'payable_id'       => 1,
                'payable_type'     => 'App\Models\Appointment',
                'userID'           => 1000,
                'created_at'       => now()->subDays(5),
                'updated_at'       => now()->subDays(5),
            ],
            [
                'amount'           => 350.00,   // remaining 70%
                'total_cost'       => 500.00,
                'payment_type'     => 'balance',
                'payment_method'   => 'Cash',
                'reference_number' => null,
                'status'           => 'Completed',
                'payable_id'       => 1,
                'payable_type'     => 'App\Models\Appointment',
                'userID'           => 1000,
                'created_at'       => now()->subDays(1),
                'updated_at'       => now()->subDays(1),
            ],

            // Appointment 2 (Full Grooming ₱1,500): full GCash payment upfront
            [
                'amount'           => 1500.00,
                'total_cost'       => 1500.00,
                'payment_type'     => 'full',
                'payment_method'   => 'GCash',
                'reference_number' => 'GC2026031000002',
                'status'           => 'Completed',
                'payable_id'       => 2,
                'payable_type'     => 'App\Models\Appointment',
                'userID'           => 1000,
                'created_at'       => now()->subDays(2),
                'updated_at'       => now()->subDays(2),
            ],

            // Boarding 1 (Overnight, 2 days × ₱500 = ₱1,000): GCash deposit + balance collected
            [
                'amount'           => 300.00,   // 30% of ₱1,000
                'total_cost'       => 1000.00,
                'payment_type'     => 'deposit',
                'payment_method'   => 'GCash',
                'reference_number' => 'GC2026031000003',
                'status'           => 'Completed',
                'payable_id'       => 1,
                'payable_type'     => 'App\Models\Boarding',
                'userID'           => 1000,
                'created_at'       => now()->subDays(7),
                'updated_at'       => now()->subDays(7),
            ],
            [
                'amount'           => 700.00,   // remaining 70%
                'total_cost'       => 1000.00,
                'payment_type'     => 'balance',
                'payment_method'   => 'Cash',
                'reference_number' => null,
                'status'           => 'Completed',
                'payable_id'       => 1,
                'payable_type'     => 'App\Models\Boarding',
                'userID'           => 1000,
                'created_at'       => now()->subDays(5),
                'updated_at'       => now()->subDays(5),
            ],

            // Boarding 2 (Daycare ₱250): cash — pending collection at counter
            [
                'amount'           => 250.00,
                'total_cost'       => 250.00,
                'payment_type'     => 'full',
                'payment_method'   => 'Cash',
                'reference_number' => null,
                'status'           => 'Pending',
                'payable_id'       => 2,
                'payable_type'     => 'App\Models\Boarding',
                'userID'           => 1000,
                'created_at'       => now()->subDays(1),
                'updated_at'       => now()->subDays(1),
            ],
        ]);

        DB::table('settings')->updateOrInsert(
            ['key' => 'boarding_capacity'],
            ['value' => '10', 'description' => 'Maximum number of pets that can be boarded at once']
        );
    }
}
