<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get some customers and products for realistic orders
        $customers = Customer::all();
        $products = Product::all();

        if ($customers->isEmpty() || $products->isEmpty()) {
            $this->command->info('Please seed customers and products first.');
            return;
        }

        $orders = [
            [
                'order_number' => Order::generateOrderNumber(),
                'customer_name' => 'Arjuna Silva',
                'customer_email' => 'arjuna.silva@email.com',
                'customer_phone' => '+94 77 123 4567',
                'products' => [
                    ['name' => 'Ceylon Cinnamon Sticks', 'price' => 25.99, 'quantity' => 2],
                    ['name' => 'Ceylon Black Tea', 'price' => 18.50, 'quantity' => 1]
                ],
                'total_amount' => 70.48,
                'status' => 'completed',
                'notes' => 'Customer requested express delivery'
            ],
            [
                'order_number' => Order::generateOrderNumber(),
                'customer_name' => 'Priya Fernando',
                'customer_email' => 'priya.fernando@gmail.com',
                'customer_phone' => '+94 71 987 6543',
                'products' => [
                    ['name' => 'Ayurvedic Herbal Oil', 'price' => 32.75, 'quantity' => 1],
                    ['name' => 'Traditional Jewelry Set', 'price' => 125.00, 'quantity' => 1]
                ],
                'total_amount' => 157.75,
                'status' => 'processing',
                'notes' => 'Gift wrapping requested'
            ],
            [
                'order_number' => Order::generateOrderNumber(),
                'customer_name' => 'Saman Perera',
                'customer_email' => 'saman.perera@yahoo.com',
                'customer_phone' => '+94 76 555 1234',
                'products' => [
                    ['name' => 'Ceylon Spices Collection', 'price' => 42.99, 'quantity' => 1],
                    ['name' => 'Black Pepper Premium', 'price' => 22.50, 'quantity' => 2],
                    ['name' => 'Cardamom Premium Grade', 'price' => 38.99, 'quantity' => 1]
                ],
                'total_amount' => 126.98,
                'status' => 'shipped',
                'notes' => 'Regular customer - priority handling'
            ],
            [
                'order_number' => Order::generateOrderNumber(),
                'customer_name' => 'Nimal Jayawardena',
                'customer_email' => 'nimal.j@hotmail.com',
                'customer_phone' => '+94 75 888 9999',
                'products' => [
                    ['name' => 'Traditional Batik Wear', 'price' => 89.99, 'quantity' => 1]
                ],
                'total_amount' => 89.99,
                'status' => 'pending',
                'notes' => 'Size medium confirmed'
            ],
            [
                'order_number' => Order::generateOrderNumber(),
                'customer_name' => 'Kamala Wijesinghe',
                'customer_email' => 'kamala.w@outlook.com',
                'customer_phone' => '+94 72 444 5555',
                'products' => [
                    ['name' => 'Carved Wooden Elephant', 'price' => 45.50, 'quantity' => 2],
                    ['name' => 'Handwoven Basket', 'price' => 28.75, 'quantity' => 1],
                    ['name' => 'Cultural Art Piece', 'price' => 95.50, 'quantity' => 1]
                ],
                'total_amount' => 215.25,
                'status' => 'completed',
                'notes' => 'Corporate gift order'
            ],
            [
                'order_number' => Order::generateOrderNumber(),
                'customer_name' => 'Ruwan Bandara',
                'customer_email' => 'ruwan.bandara@gmail.com',
                'customer_phone' => '+94 78 222 3333',
                'products' => [
                    ['name' => 'Authentic Curry Spice Mix', 'price' => 15.99, 'quantity' => 3],
                    ['name' => 'Cloves Whole', 'price' => 19.75, 'quantity' => 1],
                    ['name' => 'Beli Mal Tea', 'price' => 16.25, 'quantity' => 2]
                ],
                'total_amount' => 84.47,
                'status' => 'processing',
                'notes' => 'Bulk order for restaurant'
            ],
            [
                'order_number' => Order::generateOrderNumber(),
                'customer_name' => 'Sanduni Rathnayake',
                'customer_email' => 'sanduni.r@email.lk',
                'customer_phone' => '+94 70 111 2222',
                'products' => [
                    ['name' => 'Ceylon Black Tea', 'price' => 18.50, 'quantity' => 2],
                    ['name' => 'Ceylon Cinnamon Sticks', 'price' => 25.99, 'quantity' => 1]
                ],
                'total_amount' => 62.99,
                'status' => 'completed',
                'notes' => 'First time customer'
            ],
            [
                'order_number' => Order::generateOrderNumber(),
                'customer_name' => 'Dilani Mendis',
                'customer_email' => 'dilani.mendis@gmail.com',
                'customer_phone' => '+94 74 333 4444',
                'products' => [
                    ['name' => 'Wooden Handicrafts Collection', 'price' => 65.00, 'quantity' => 1],
                    ['name' => 'Traditional Jewelry Set', 'price' => 125.00, 'quantity' => 1]
                ],
                'total_amount' => 190.00,
                'status' => 'shipped',
                'notes' => 'Wedding gift set'
            ],
            [
                'order_number' => Order::generateOrderNumber(),
                'customer_name' => 'Chathura Wickramasinghe',
                'customer_email' => 'chathura.w@yahoo.com',
                'customer_phone' => '+94 76 777 8888',
                'products' => [
                    ['name' => 'Ayurvedic Herbal Oil', 'price' => 32.75, 'quantity' => 2],
                    ['name' => 'Cardamom Premium Grade', 'price' => 38.99, 'quantity' => 1]
                ],
                'total_amount' => 104.49,
                'status' => 'pending',
                'notes' => 'Health and wellness order'
            ],
            [
                'order_number' => Order::generateOrderNumber(),
                'customer_name' => 'Mahinda Rajapaksa',
                'customer_email' => 'mahinda.r@sltnet.lk',
                'customer_phone' => '+94 77 666 7777',
                'products' => [
                    ['name' => 'Ceylon Spices Collection', 'price' => 42.99, 'quantity' => 1],
                    ['name' => 'Traditional Batik Wear', 'price' => 89.99, 'quantity' => 1]
                ],
                'total_amount' => 132.98,
                'status' => 'cancelled',
                'notes' => 'Customer requested cancellation'
            ]
        ];

        foreach ($orders as $index => $orderData) {
            $orderData['order_number'] = 'ORD-' . str_pad($index + 1, 4, '0', STR_PAD_LEFT);
            $orderData['order_date'] = $orderData['order_date'] ?? now()->subDays(count($orders) - $index);

            Order::updateOrCreate(
                ['order_number' => $orderData['order_number']],
                $orderData
            );
        }

        $this->command->info('Created ' . count($orders) . ' sample orders.');
    }
}
