<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

echo "=== CHECKING VENDOR DATA ===\n";

$vendor = User::where('email', 'testvendor@example.com')->first();

if ($vendor) {
    echo "Vendor found:\n";
    echo "ID: " . $vendor->id . "\n";
    echo "Name: " . $vendor->name . "\n";
    echo "Email: " . $vendor->email . "\n";
    echo "Role: " . $vendor->role . "\n";
    echo "Created: " . $vendor->created_at . "\n";
    echo "Updated: " . $vendor->updated_at . "\n";
    
    echo "\nJSON representation:\n";
    echo json_encode($vendor->toArray(), JSON_PRETTY_PRINT) . "\n";
    
    echo "\nRole methods:\n";
    echo "isVendor(): " . ($vendor->isVendor() ? 'true' : 'false') . "\n";
    echo "isCustomer(): " . ($vendor->isCustomer() ? 'true' : 'false') . "\n";
    echo "isAdmin(): " . ($vendor->isAdmin() ? 'true' : 'false') . "\n";
} else {
    echo "Vendor not found!\n";
}

echo "\nAll vendors in system:\n";
$vendors = User::where('role', 'vendor')->get();
foreach ($vendors as $v) {
    echo "- {$v->name} ({$v->email}) - Role: {$v->role}\n";
}
