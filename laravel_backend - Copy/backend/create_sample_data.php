<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;
use App\Models\Vendor;
use App\Models\Order;
use App\Models\Customer;

try {
    echo "Creating sample data...\n";

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
        ]
    ];

    foreach ($vendors as $vendorData) {
        $vendor = Vendor::firstOrCreate(['email' => $vendorData['email']], $vendorData);
        echo "Vendor created: {$vendor->name}\n";
    }

    // Create sample products
    $products = [
        [
            'product_code' => 'PROD0001',
            'name' => 'Ceylon Cinnamon Sticks',
            'description' => 'Premium quality Ceylon cinnamon sticks, hand-selected from the best gardens in Sri Lanka.',
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
            'description' => 'Traditional Ayurvedic herbal oil made from natural ingredients.',
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
            'description' => 'Traditional Sri Lankan wooden mask, hand-carved by skilled artisans.',
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
            'description' => 'Premium Ceylon black tea from the high-grown estates of Sri Lanka.',
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
        ]
    ];

    foreach ($products as $productData) {
        $product = Product::firstOrCreate(['product_code' => $productData['product_code']], $productData);
        echo "Product created: {$product->name}\n";
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
        $customer = Customer::firstOrCreate(['email' => $customerData['email']], $customerData);
        echo "Customer created: {$customer->name}\n";
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
        ]
    ];

    foreach ($orders as $orderData) {
        $order = Order::firstOrCreate(['order_number' => $orderData['order_number']], $orderData);
        echo "Order created: {$order->order_number}\n";
    }

    echo "\nSample data created successfully!\n";
    echo "- " . Vendor::count() . " vendors in database\n";
    echo "- " . Product::count() . " products in database\n";
    echo "- " . Customer::count() . " customers in database\n";
    echo "- " . Order::count() . " orders in database\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
