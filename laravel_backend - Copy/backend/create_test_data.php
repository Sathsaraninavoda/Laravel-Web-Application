<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Product;
use App\Models\Vendor;
use App\Models\Customer;
use App\Models\Order;

try {
    echo "Creating test data...\n";

    // Create a simple product
    $product = new Product();
    $product->product_code = 'PROD0001';
    $product->name = 'Ceylon Cinnamon Sticks';
    $product->description = 'Premium quality Ceylon cinnamon sticks';
    $product->category = 'Spices';
    $product->price = 25.99;
    $product->cost_price = 15.00;
    $product->stock_quantity = 150;
    $product->min_stock_level = 20;
    $product->sku = 'CIN-001';
    $product->status = 'active';
    $product->weight = 0.250;
    $product->dimensions = '10x5x3 cm';
    $product->tags = 'cinnamon,spices,ceylon';
    $product->featured = true;
    $product->save();
    echo "Product created: {$product->name}\n";

    // Create a simple vendor
    $vendor = new Vendor();
    $vendor->name = 'Spice Gardens Ltd';
    $vendor->email = 'contact@spicegardens.lk';
    $vendor->phone = '+94771234567';
    $vendor->address = '123 Kandy Road, Kandy, Sri Lanka';
    $vendor->city = 'Kandy';
    $vendor->country = 'Sri Lanka';
    $vendor->status = 'active';
    $vendor->contact_person = 'Rajesh Silva';
    $vendor->business_type = 'Spice Supplier';
    $vendor->tax_number = 'VAT123456789';
    $vendor->save();
    echo "Vendor created: {$vendor->name}\n";

    // Create a simple customer
    $customer = new Customer();
    $customer->name = 'John Doe';
    $customer->email = 'john.doe@example.com';
    $customer->phone = '+1234567890';
    $customer->address = '123 Main St, New York, NY 10001';
    $customer->city = 'New York';
    $customer->country = 'USA';
    $customer->status = 'active';
    $customer->save();
    echo "Customer created: {$customer->name}\n";

    // Create a simple order
    $order = new Order();
    $order->order_number = 'ORD-001';
    $order->customer_id = $customer->id;
    $order->order_date = now()->subDays(2);
    $order->status = 'completed';
    $order->total_amount = 125.50;
    $order->shipping_address = '123 Main St, New York, NY 10001';
    $order->billing_address = '123 Main St, New York, NY 10001';
    $order->payment_method = 'credit_card';
    $order->payment_status = 'paid';
    $order->notes = 'Test order';
    $order->save();
    echo "Order created: {$order->order_number}\n";

    echo "\nTest data created successfully!\n";
    echo "You can now test the admin dashboard at: http://127.0.0.1:8000/dashboard\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
