<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $customers = [
            [
                'customer_number' => Customer::generateCustomerNumber(),
                'name' => 'Arjuna Silva',
                'email' => 'arjuna.silva@email.com',
                'phone' => '+94 77 123 4567',
                'address' => '123 Galle Road, Colombo 03',
                'city' => 'Colombo',
                'country' => 'Sri Lanka',
                'date_of_birth' => '1985-03-15',
                'status' => 'active',
                'total_spent' => 245.50,
                'total_orders' => 8
            ],
            [
                'customer_number' => Customer::generateCustomerNumber(),
                'name' => 'Priya Fernando',
                'email' => 'priya.fernando@gmail.com',
                'phone' => '+94 71 987 6543',
                'address' => '456 Kandy Road, Peradeniya',
                'city' => 'Kandy',
                'country' => 'Sri Lanka',
                'date_of_birth' => '1992-07-22',
                'status' => 'active',
                'total_spent' => 189.75,
                'total_orders' => 5
            ],
            [
                'customer_number' => Customer::generateCustomerNumber(),
                'name' => 'Saman Perera',
                'email' => 'saman.perera@yahoo.com',
                'phone' => '+94 76 555 1234',
                'address' => '789 Main Street, Galle',
                'city' => 'Galle',
                'country' => 'Sri Lanka',
                'date_of_birth' => '1978-11-08',
                'status' => 'active',
                'total_spent' => 432.25,
                'total_orders' => 12
            ],
            [
                'customer_number' => Customer::generateCustomerNumber(),
                'name' => 'Nimal Jayawardena',
                'email' => 'nimal.j@hotmail.com',
                'phone' => '+94 75 888 9999',
                'address' => '321 Temple Road, Negombo',
                'city' => 'Negombo',
                'country' => 'Sri Lanka',
                'date_of_birth' => '1990-05-12',
                'status' => 'active',
                'total_spent' => 156.80,
                'total_orders' => 4
            ],
            [
                'customer_number' => Customer::generateCustomerNumber(),
                'name' => 'Kamala Wijesinghe',
                'email' => 'kamala.w@outlook.com',
                'phone' => '+94 72 444 5555',
                'address' => '654 Hill Street, Nuwara Eliya',
                'city' => 'Nuwara Eliya',
                'country' => 'Sri Lanka',
                'date_of_birth' => '1987-09-30',
                'status' => 'active',
                'total_spent' => 298.40,
                'total_orders' => 7
            ],
            [
                'customer_number' => Customer::generateCustomerNumber(),
                'name' => 'Ruwan Bandara',
                'email' => 'ruwan.bandara@gmail.com',
                'phone' => '+94 78 222 3333',
                'address' => '987 Beach Road, Hikkaduwa',
                'city' => 'Hikkaduwa',
                'country' => 'Sri Lanka',
                'date_of_birth' => '1983-12-18',
                'status' => 'active',
                'total_spent' => 378.90,
                'total_orders' => 9
            ],
            [
                'customer_number' => Customer::generateCustomerNumber(),
                'name' => 'Sanduni Rathnayake',
                'email' => 'sanduni.r@email.lk',
                'phone' => '+94 70 111 2222',
                'address' => '147 Lake Road, Anuradhapura',
                'city' => 'Anuradhapura',
                'country' => 'Sri Lanka',
                'date_of_birth' => '1995-02-14',
                'status' => 'active',
                'total_spent' => 125.60,
                'total_orders' => 3
            ],
            [
                'customer_number' => Customer::generateCustomerNumber(),
                'name' => 'Mahinda Rajapaksa',
                'email' => 'mahinda.r@sltnet.lk',
                'phone' => '+94 77 666 7777',
                'address' => '258 Ancient City Road, Polonnaruwa',
                'city' => 'Polonnaruwa',
                'country' => 'Sri Lanka',
                'date_of_birth' => '1975-08-25',
                'status' => 'inactive',
                'total_spent' => 89.30,
                'total_orders' => 2
            ],
            [
                'customer_number' => Customer::generateCustomerNumber(),
                'name' => 'Dilani Mendis',
                'email' => 'dilani.mendis@gmail.com',
                'phone' => '+94 74 333 4444',
                'address' => '369 Flower Road, Batticaloa',
                'city' => 'Batticaloa',
                'country' => 'Sri Lanka',
                'date_of_birth' => '1989-06-07',
                'status' => 'active',
                'total_spent' => 267.15,
                'total_orders' => 6
            ],
            [
                'customer_number' => Customer::generateCustomerNumber(),
                'name' => 'Chathura Wickramasinghe',
                'email' => 'chathura.w@yahoo.com',
                'phone' => '+94 76 777 8888',
                'address' => '741 Mountain View, Badulla',
                'city' => 'Badulla',
                'country' => 'Sri Lanka',
                'date_of_birth' => '1991-10-03',
                'status' => 'active',
                'total_spent' => 198.75,
                'total_orders' => 5
            ]
        ];

        foreach ($customers as $customerData) {
            $customer = Customer::firstOrNew(['email' => $customerData['email']]);
            unset($customerData['customer_number']);

            if (! $customer->exists) {
                $customer->customer_number = Customer::generateCustomerNumber();
            }

            $customer->fill($customerData)->save();
        }
    }
}
