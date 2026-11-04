<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Support\Facades\Schema;

class AdminSampleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing data
        Schema::disableForeignKeyConstraints();

        try {
            Product::truncate();
            Vendor::truncate();
            Order::truncate();
            Customer::truncate();
        } finally {
            Schema::enableForeignKeyConstraints();
        }

        // Create sample vendors
        $vendors = [
            [
                'name' => 'Spice Gardens Ltd',
                'email' => 'contact@spicegardens.lk',
                'phone' => '+94771234567',
                'address' => '123 Kandy Road, Kandy, Sri Lanka',
                'city' => 'Kandy',
                'country' => 'Sri Lanka',
                'status' => 'active',
                'contact_person' => 'Rajesh Silva',
                'business_type' => 'Spice Supplier',
                'tax_number' => 'VAT123456789'
            ],
            [
                'name' => 'Ayurveda Exports',
                'email' => 'info@ayurvedaexports.lk',
                'phone' => '+94777654321',
                'address' => '456 Galle Road, Colombo, Sri Lanka',
                'city' => 'Colombo',
                'country' => 'Sri Lanka',
                'status' => 'active',
                'contact_person' => 'Priya Fernando',
                'business_type' => 'Ayurvedic Products',
                'tax_number' => 'VAT987654321'
            ],
            [
                'name' => 'Craft Masters',
                'email' => 'sales@craftmasters.lk',
                'phone' => '+94771111222',
                'address' => '789 Beach Road, Galle, Sri Lanka',
                'city' => 'Galle',
                'country' => 'Sri Lanka',
                'status' => 'pending',
                'contact_person' => 'Kumara Perera',
                'business_type' => 'Handicrafts',
                'tax_number' => 'VAT555666777'
            ],
            [
                'name' => 'Ceylon Tea Co',
                'email' => 'orders@ceylontea.lk',
                'phone' => '+94773333444',
                'address' => '321 Hill Country, Nuwara Eliya, Sri Lanka',
                'city' => 'Nuwara Eliya',
                'country' => 'Sri Lanka',
                'status' => 'active',
                'contact_person' => 'Saman Jayawardena',
                'business_type' => 'Tea Supplier',
                'tax_number' => 'VAT111222333'
            ]
        ];

        foreach ($vendors as $vendor) {
            Vendor::create($vendor);
        }

        // Create sample products
        $products = [
            [
                'product_code' => 'PROD0001',
                'name' => 'Ceylon Cinnamon Sticks',
                'description' => 'Premium quality Ceylon cinnamon sticks, hand-selected from the best gardens in Sri Lanka. Perfect for cooking and baking.',
                'category' => 'Spices',
                'price' => 25.99,
                'cost_price' => 15.00,
                'stock_quantity' => 150,
                'min_stock_level' => 20,
                'sku' => 'CIN-001',
                'status' => 'active',
                'weight' => 0.250,
                'dimensions' => '10x5x3 cm',
                'tags' => 'cinnamon,spices,ceylon,organic',
                'featured' => true
            ],
            [
                'product_code' => 'PROD0002',
                'name' => 'Ayurvedic Herbal Oil',
                'description' => 'Traditional Ayurvedic herbal oil made from natural ingredients. Great for massage and therapeutic use.',
                'category' => 'Ayurvedic',
                'price' => 45.00,
                'cost_price' => 25.00,
                'stock_quantity' => 75,
                'min_stock_level' => 10,
                'sku' => 'AYU-001',
                'status' => 'active',
                'weight' => 0.500,
                'dimensions' => '15x5x5 cm',
                'tags' => 'ayurvedic,oil,herbal,natural',
                'featured' => true
            ],
            [
                'product_code' => 'PROD0003',
                'name' => 'Hand-carved Wooden Mask',
                'description' => 'Traditional Sri Lankan wooden mask, hand-carved by skilled artisans. Perfect for decoration or cultural displays.',
                'category' => 'Handicrafts',
                'price' => 75.50,
                'cost_price' => 40.00,
                'stock_quantity' => 25,
                'min_stock_level' => 5,
                'sku' => 'HAN-001',
                'status' => 'active',
                'weight' => 1.200,
                'dimensions' => '25x20x10 cm',
                'tags' => 'handicraft,wooden,mask,traditional',
                'featured' => false
            ],
            [
                'product_code' => 'PROD0004',
                'name' => 'Ceylon Black Tea',
                'description' => 'Premium Ceylon black tea from the high-grown estates of Sri Lanka. Rich flavor and aroma.',
                'category' => 'Tea',
                'price' => 18.99,
                'cost_price' => 10.00,
                'stock_quantity' => 200,
                'min_stock_level' => 30,
                'sku' => 'TEA-001',
                'status' => 'active',
                'weight' => 0.250,
                'dimensions' => '12x8x4 cm',
                'tags' => 'tea,ceylon,black tea,premium',
                'featured' => true
            ],
            [
                'product_code' => 'PROD0005',
                'name' => 'Turmeric Powder',
                'description' => 'Pure turmeric powder with high curcumin content. Organic and naturally processed.',
                'category' => 'Spices',
                'price' => 12.50,
                'cost_price' => 7.00,
                'stock_quantity' => 300,
                'min_stock_level' => 50,
                'sku' => 'TUR-001',
                'status' => 'active',
                'weight' => 0.200,
                'dimensions' => '10x6x6 cm',
                'tags' => 'turmeric,spices,organic,powder',
                'featured' => false
            ],
            [
                'product_code' => 'PROD0006',
                'name' => 'Coconut Shell Bowl',
                'description' => 'Eco-friendly coconut shell bowl, perfect for serving and decoration. Handmade and sustainable.',
                'category' => 'Handicrafts',
                'price' => 22.00,
                'cost_price' => 12.00,
                'stock_quantity' => 80,
                'min_stock_level' => 15,
                'sku' => 'COC-001',
                'status' => 'active',
                'weight' => 0.300,
                'dimensions' => '15x15x8 cm',
                'tags' => 'coconut,bowl,eco-friendly,handmade',
                'featured' => false
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        // Create sample customers
        $customers = [
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'phone' => '+1234567890',
                'address' => '123 Main St, New York, NY 10001',
                'city' => 'New York',
                'country' => 'USA',
                'status' => 'active'
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane.smith@example.com',
                'phone' => '+1987654321',
                'address' => '456 Oak Ave, Los Angeles, CA 90210',
                'city' => 'Los Angeles',
                'country' => 'USA',
                'status' => 'active'
            ],
            [
                'name' => 'Bob Johnson',
                'email' => 'bob.johnson@example.com',
                'phone' => '+1555666777',
                'address' => '789 Pine St, Chicago, IL 60601',
                'city' => 'Chicago',
                'country' => 'USA',
                'status' => 'active'
            ]
        ];

        foreach ($customers as $customerData) {
            $customer = Customer::firstOrNew(['email' => $customerData['email']]);

            if (! $customer->exists) {
                $customer->customer_number = Customer::generateCustomerNumber();
            }

            $customer->fill($customerData)->save();
        }

        // Create sample orders
        $orders = [
            [
                'order_number' => 'ORD-001',
                'customer_id' => 1,
                'order_date' => now()->subDays(5),
                'status' => 'completed',
                'total_amount' => 125.50,
                'shipping_address' => '123 Main St, New York, NY 10001',
                'billing_address' => '123 Main St, New York, NY 10001',
                'payment_method' => 'credit_card',
                'payment_status' => 'paid',
                'notes' => 'Customer requested express shipping'
            ],
            [
                'order_number' => 'ORD-002',
                'customer_id' => 2,
                'order_date' => now()->subDays(3),
                'status' => 'processing',
                'total_amount' => 89.99,
                'shipping_address' => '456 Oak Ave, Los Angeles, CA 90210',
                'billing_address' => '456 Oak Ave, Los Angeles, CA 90210',
                'payment_method' => 'paypal',
                'payment_status' => 'paid',
                'notes' => 'Gift wrapping requested'
            ],
            [
                'order_number' => 'ORD-003',
                'customer_id' => 3,
                'order_date' => now()->subDays(1),
                'status' => 'shipped',
                'total_amount' => 234.75,
                'shipping_address' => '789 Pine St, Chicago, IL 60601',
                'billing_address' => '789 Pine St, Chicago, IL 60601',
                'payment_method' => 'bank_transfer',
                'payment_status' => 'paid',
                'notes' => 'Bulk order for restaurant'
            ],
            [
                'order_number' => 'ORD-004',
                'customer_id' => 1,
                'order_date' => now(),
                'status' => 'pending',
                'total_amount' => 67.48,
                'shipping_address' => '123 Main St, New York, NY 10001',
                'billing_address' => '123 Main St, New York, NY 10001',
                'payment_method' => 'credit_card',
                'payment_status' => 'pending',
                'notes' => 'New order, awaiting payment confirmation'
            ]
        ];

        foreach ($orders as $order) {
            $customer = Customer::find($order['customer_id']);

            $order['customer_name'] = $customer?->name ?? 'Sample Customer';
            $order['customer_email'] = $customer?->email;
            $order['customer_phone'] = $customer?->phone;

            Order::create($order);
        }

        echo "Sample data created successfully!\n";
        echo "- " . count($vendors) . " vendors created\n";
        echo "- " . count($products) . " products created\n";
        echo "- " . count($customers) . " customers created\n";
        echo "- " . count($orders) . " orders created\n";
    }
}
