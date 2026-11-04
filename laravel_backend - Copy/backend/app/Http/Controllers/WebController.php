<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    /**
     * Show the home page
     */
    public function index()
    {
        return view('index');
    }

    /**
     * Show the login page
     */
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect($this->redirectPathFor(Auth::user()));
        }
        return view('login');
    }

    /**
     * Show the registration page
     */
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect($this->redirectPathFor(Auth::user()));
        }
        return view('create_account');
    }

    /**
     * Show the dashboard page (protected)
     */
    public function dashboard()
    {
        return view('dashboard');
    }

    /**
     * Show the products page
     */
    public function products()
    {
        return view('products');
    }

    /**
     * Show the cart page
     */
    public function cart()
    {
        return view('cart');
    }

    /**
     * Show the contact page
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Show category pages
     */
    public function spices()
    {
        return view('spices');
    }

    public function ayurvedic()
    {
        return view('ayurvedic');
    }

    public function handicraft()
    {
        return view('handicraft');
    }

    /**
     * Determine where an authenticated user belongs.
     */
    private function redirectPathFor(User $user): string
    {
        return in_array($user->role, ['admin', 'vendor'], true)
            ? route('dashboard')
            : route('home');
    }
}
