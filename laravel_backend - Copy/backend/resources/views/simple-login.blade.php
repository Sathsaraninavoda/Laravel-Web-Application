<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Simple Login | Thambapanni Sobha</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #3498db, #cfdef3);
            font-family: 'Segoe UI', sans-serif;
        }
        .login-box {
            background-color: #fafcfaff;
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

            {{-- Display any session messages --}}
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif

            {{-- Simple Login Form (No JavaScript) --}}
            <form action="{{ route('login.submit') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" value="{{ old('email') }}" required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Login (Traditional)</button>
                
                <div class="text-center mt-3">
                    <small>Don't have an account? <a href="{{ route('register') }}">Create account</a></small>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
