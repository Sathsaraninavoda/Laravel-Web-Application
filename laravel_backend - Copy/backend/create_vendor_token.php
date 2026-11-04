<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Illuminate\Support\Facades\Hash;

echo "=== DIRECT VENDOR TOKEN CREATION ===\n";
echo "This will create a valid auth token for the vendor user\n\n";

// Find or create the test vendor
$vendor = User::where('email', 'testvendor@example.com')->first();

if (!$vendor) {
    echo "Creating test vendor user...\n";
    $vendor = User::create([
        'name' => 'Test Vendor',
        'email' => 'testvendor@example.com',
        'password' => Hash::make('password123'),
        'role' => 'vendor'
    ]);
    echo "✅ Test vendor created\n";
} else {
    echo "✅ Test vendor found: {$vendor->name}\n";
}

// Verify password
if (!Hash::check('password123', $vendor->password)) {
    echo "❌ Password mismatch! Updating password...\n";
    $vendor->update(['password' => Hash::make('password123')]);
    echo "✅ Password updated\n";
}

// Create a fresh token
echo "\nCreating authentication token...\n";
$token = $vendor->createToken('vendor_dashboard_token')->plainTextToken;

echo "✅ Token created successfully!\n\n";

// Output the authentication data in the format needed by frontend
$authData = [
    'success' => true,
    'message' => 'Login successful',
    'user' => [
        'id' => $vendor->id,
        'name' => $vendor->name,
        'email' => $vendor->email,
        'role' => $vendor->role,
        'created_at' => $vendor->created_at->toISOString(),
        'updated_at' => $vendor->updated_at->toISOString()
    ],
    'token' => $token
];

echo "=== AUTHENTICATION DATA ===\n";
echo json_encode($authData, JSON_PRETTY_PRINT) . "\n\n";

echo "=== FRONTEND JAVASCRIPT CODE ===\n";
echo "Copy and paste this into your browser console to fix the auth token:\n\n";

echo "// Clear existing auth data\n";
echo "localStorage.clear();\n\n";

echo "// Set the authentication data\n";
echo "const authData = " . json_encode($authData, JSON_PRETTY_PRINT) . ";\n\n";

echo "// Store in localStorage\n";
echo "localStorage.setItem('auth_token', authData.token);\n";
echo "localStorage.setItem('user', JSON.stringify(authData.user));\n";
echo "localStorage.setItem('user_role', authData.user.role);\n";
echo "localStorage.setItem('session_active', 'true');\n";
echo "localStorage.setItem('login_time', new Date().toISOString());\n\n";

echo "// Verify storage\n";
echo "console.log('Auth token stored:', localStorage.getItem('auth_token'));\n";
echo "console.log('User data stored:', JSON.parse(localStorage.getItem('user')));\n";
echo "console.log('Role stored:', localStorage.getItem('user_role'));\n\n";

echo "// Redirect to dashboard\n";
echo "window.location.href = '/dashboard.html';\n\n";

echo "=== INSTRUCTIONS ===\n";
echo "1. Copy the JavaScript code above\n";
echo "2. Open your browser's Developer Console (F12)\n";
echo "3. Paste and run the JavaScript code\n";
echo "4. Your vendor dashboard should now work!\n\n";

echo "Token: {$token}\n";
echo "User ID: {$vendor->id}\n";
echo "Role: {$vendor->role}\n";
echo "Email: {$vendor->email}\n\n";

echo "✅ Vendor authentication token created successfully!\n";
