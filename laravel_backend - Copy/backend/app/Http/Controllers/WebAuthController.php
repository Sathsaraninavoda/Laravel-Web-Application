<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Customer;
use App\Models\User;

class WebAuthController extends Controller
{
    /**
     * Handle web-based login
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $request->session()->regenerate();

            return redirect()
                ->intended($this->redirectPathFor(Auth::user()))
                ->with('success', 'Login successful!');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    /**
     * Handle web-based registration
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'city' => 'nullable|string|max:100',
            'address' => 'nullable|string|max:500',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'accepted',
        ]);

        $name = trim($validated['first_name'] . ' ' . $validated['last_name']);

        $user = User::create([
            'name' => $name,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'customer',
        ]);

        $customer = Customer::firstOrNew(['email' => $validated['email']]);
        if (!$customer->exists) {
            $customer->customer_number = Customer::generateCustomerNumber();
        }
        $customer->fill([
            'name' => $name,
            'phone' => $validated['phone'] ?? null,
            'city' => $validated['city'] ?? null,
            'address' => $validated['address'] ?? null,
            'country' => 'Sri Lanka',
            'status' => 'active',
        ])->save();

        Auth::login($user);
        $request->session()->regenerate();

        return redirect($this->redirectPathFor($user))
            ->with('success', 'Registration successful! Welcome to Thambapanni Sobha.');
    }

    /**
     * Determine where a user should land after authentication.
     */
    private function redirectPathFor(User $user): string
    {
        return in_array($user->role, ['admin', 'vendor'], true)
            ? route('dashboard')
            : route('home');
    }

    /**
     * Handle web-based logout
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully!');
    }
}
