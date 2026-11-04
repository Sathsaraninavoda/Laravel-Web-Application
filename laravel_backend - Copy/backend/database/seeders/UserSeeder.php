<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
            ],
            [
                'name' => 'Vendor User',
                'email' => 'vendor@example.com',
                'password' => Hash::make('password123'),
                'role' => 'vendor',
            ],
            [
                'name' => 'John Customer',
                'email' => 'customer1@example.com',
                'password' => Hash::make('password123'),
                'role' => 'customer',
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'customer2@example.com',
                'password' => Hash::make('password123'),
                'role' => 'customer',
            ],
            [
                'name' => 'Mike Johnson',
                'email' => 'customer3@example.com',
                'password' => Hash::make('password123'),
                'role' => 'customer',
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                array_merge($user, ['email_verified_at' => now()])
            );
        }

        $this->command->info('Created sample users: 1 admin, 1 vendor, 3 customers');
    }
}
