<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Thambapanni Sobha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to right, #3498db, #cfdef3);
            font-family: 'Segoe UI', sans-serif;
        }
        .login-box {
            background-color: #fafcfaff; /* ඔබේ code එකේ හරිත පාටයි, කලින් screenshot එකේ සුදුයි */
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }
        .brand-text {
            font-size: 28px;
            font-weight: bold;
            color: #4d0dfd;
            text-align: center;
            margin-bottom: 20px;
        }
        .btn-primary {
            background-color: #3541e6;
            border: none;
        }
        .btn-primary:hover {
            background-color: #0beb43;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="login-box w-100" style="max-width: 400px;">
            <div class="brand-text">Thambapanni Sobha</div>

            {{-- Login Form --}}
            <form id="loginForm" action="{{ route('login.submit') }}" method="POST">
                {{-- CSRF Token for security --}}
                @csrf
                <meta name="csrf-token" content="{{ csrf_token() }}">
                
                {{-- Display any session messages --}}
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" 
                           placeholder="Enter your email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Enter your password" required>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
                
                <div class="text-center mt-3">
                    <small>Don't have an account? <a href="{{ route('register') }}">Create account</a></small>
                </div>
            </form>
        </div>
    </div>

    {{-- Simple form validation without API calls --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('loginForm');
            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    const email = document.getElementById('email').value;
                    const password = document.getElementById('password').value;
                    
                    if (!email || !password) {
                        e.preventDefault();
                        alert('Please fill in all fields');
                        return false;
                    }
                    
                    // Let the form submit normally to the web route
                    // No e.preventDefault() - allow normal form submission
                });
            }
        });
    </script>
</body>
</html>