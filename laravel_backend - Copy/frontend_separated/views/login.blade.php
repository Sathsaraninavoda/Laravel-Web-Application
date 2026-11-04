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
            <form action="{{ route('login') }}" method="POST">
                {{-- CSRF Token for security --}}
                @csrf

                <div class="mb-3">
                    <label for="username" class="form-label">Username or Email</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" value="{{ old('username') }}" required>
                    @error('username')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
<a href="{{ url('/dashboard') }}" class="btn btn-primary w-100">Login</a>
                <div class="text-center mt-3">
                    <small>Don't have an account? <a href="{{ route('register') }}">Create account</a></small>
                </div>
            </form>
        </div>
    </div>
</body>
</html>