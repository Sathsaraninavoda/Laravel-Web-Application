<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;

echo "Current Users and Their Roles:\n";
echo "==============================\n";

$users = User::all(['id', 'name', 'email', 'role']);

foreach ($users as $user) {
    echo "ID: {$user->id} | Name: {$user->name} | Email: {$user->email} | Role: {$user->role}\n";
}

echo "\nTotal users: " . $users->count() . "\n";
echo "Vendors: " . User::where('role', 'vendor')->count() . "\n";
echo "Customers: " . User::where('role', 'customer')->count() . "\n";
echo "Admins: " . User::where('role', 'admin')->count() . "\n";
