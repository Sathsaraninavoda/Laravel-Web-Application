@extends('layouts.app')

@section('title', 'Create Account - Thambapanni Sobha')

@section('content')
<div class="page-header">
    <h1 class="page-title">Create Your Account</h1>
</div>

<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="registration-card">
            <div class="profile-section">
                <div class="profile-placeholder">
                    <i class="fas fa-user-plus"></i>
                </div>
                <h4 class="mb-1">New Customer</h4>
                <p class="text-muted mb-0">Join Thambapanni Sobha Community</p>
                <span class="role-badge">Customer</span>
            </div>

            <div class="card-body">
                {{-- Success Message --}}
                @if (session('status'))
                    <div class="success-alert" style="display: block;">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('status') }}
                    </div>
                @endif

                <form id="registerForm" method="POST" action="{{ route('register') }}" novalidate>
                    @csrf {{-- CSRF protection token --}}

                    {{-- Personal Information --}}
                    <div class="form-section-title">Personal Information</div>
                    
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label">First Name</label>
                            <input type="text" class="form-control @error('first_name') is-invalid @enderror" id="firstName" name="first_name" value="{{ old('first_name') }}" required>
                            @error('first_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror" id="lastName" name="last_name" value="{{ old('last_name') }}" required>
                             @error('last_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Other fields can be similarly converted --}}
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" placeholder="+94 77 123 4567">
                             @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="city" class="form-label">City</label>
                            <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" placeholder="Colombo">
                            @error('city')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="address" class="form-label">Address</label>
                        <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" placeholder="123 Main Street, Colombo 03, Sri Lanka">{{ old('address') }}</textarea>
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Account Security --}}
                    <div class="form-section-title">Account Security</div>
                    
                    <div class="mb-3 position-relative">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                        <span class="password-toggle" onclick="togglePassword('password')"><i class="fas fa-eye" id="passwordToggleIcon"></i></span>
                        <div class="strength-meter"><div class="strength-meter-fill" id="strengthMeter"></div></div>
                        <small class="text-muted">Password must be at least 8 characters with uppercase, lowercase, number, and special character</small>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 position-relative">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                        <span class="password-toggle" onclick="togglePassword('password_confirmation')"><i class="fas fa-eye" id="password_confirmationToggleIcon"></i></span>
                    </div>

                    {{-- Preferences --}}
                    <div class="form-section-title">Preferences</div>
                    
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input @error('terms') is-invalid @enderror" type="checkbox" id="terms" name="terms" required>
                            <label class="form-check-label" for="terms">
                                I agree to the <a href="#" class="text-decoration-none">Terms of Service</a> and <a href="#" class="text-decoration-none">Privacy Policy</a>
                            </label>
                            @error('terms')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="newsletter" name="newsletter" {{ old('newsletter') ? 'checked' : '' }}>
                            <label class="form-check-label" for="newsletter">
                                Subscribe to our newsletter for updates
                            </label>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-primary">
                            <span class="loading-spinner spinner-border spinner-border-sm me-2" role="status"></span>
                            <span class="btn-text">Create Account</span>
                        </button>
                        <button type="button" class="btn btn-outline-secondary" onclick="resetForm()">Cancel</button>
                    </div>
                </form>
            </div>

            <div class="login-link">
                <p class="mb-0">Already have an account? <a href="{{ route('login') }}">Sign in here</a></p>
            </div>
        </div>
    </div>
</div>
@endsection