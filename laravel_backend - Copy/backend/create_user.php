<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

try {
    // Try to find existing user first
    $existingUser = User::where('email', 'test@example.com')->first();
    
    if ($existingUser) {
        // Update existing user's password
        $existingUser->update([
            'password' => Hash::make('password123')
        ]);
        echo "Existing user password updated!\n";
        echo "Email: test@example.com\n";
        echo "Password: password123\n";
    } else {
        // Create new user
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('password123'),
        ]);
        echo "New user created!\n";
        echo "Email: test@example.com\n";
        echo "Password: password123\n";
    }
    
    // Also create an admin user
    $adminUser = User::where('email', 'admin@example.com')->first();
    if (!$adminUser) {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
        ]);
        echo "Admin user created!\n";
        echo "Email: admin@example.com\n";
        echo "Password: admin123\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
