<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use Laravel\Sanctum\PersonalAccessToken;

try {
    echo "Testing API authentication and endpoints...\n";

    // Find or create a test user
    $user = User::where('email', 'test@example.com')->first();
    if (!$user) {
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password123')
        ]);
        echo "Test user created\n";
    }

    // Create a test token
    $token = $user->createToken('test-token')->plainTextToken;
    echo "Test token created: " . substr($token, 0, 20) . "...\n";

    // Test the stats endpoint directly
    $request = \Illuminate\Http\Request::create('/api/admin/stats', 'GET');
    $request->headers->set('Authorization', 'Bearer ' . $token);
    
    // Simulate the API call
    $controller = new \App\Http\Controllers\AdminApiController();
    
    try {
        $response = $controller->getDashboardStats();
        echo "API Response: " . $response->getContent() . "\n";
    } catch (Exception $e) {
        echo "API Error: " . $e->getMessage() . "\n";
        echo "Stack trace: " . $e->getTraceAsString() . "\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace: " . $e->getTraceAsString() . "\n";
}
