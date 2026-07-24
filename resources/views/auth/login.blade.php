<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login — EVRI Admin</title>
    <style>
        * { box-sizing: border-box; }
        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            margin: 0;
            background: #f4f6f8;
            color: #1a1a1a;
            line-height: 1.5;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 2rem;
        }
        .login-card {
            background: #fff;
            border: 1px solid #dde3ea;
            border-radius: 8px;
            padding: 2rem;
        }
        .login-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .login-header h1 {
            margin: 0;
            font-size: 1.5rem;
            font-weight: 600;
            color: #007a53;
        }
        .form-group { margin-bottom: 1.25rem; }
        label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.35rem;
            color: #1a1a1a;
        }
        input {
            width: 100%;
            padding: 0.65rem 0.75rem;
            border: 1px solid #ccd4dc;
            border-radius: 6px;
            font: inherit;
            font-size: 1rem;
        }
        input:focus {
            outline: none;
            border-color: #007a53;
            box-shadow: 0 0 0 3px rgba(0, 122, 83, 0.1);
        }
        .btn {
            display: inline-block;
            width: 100%;
            padding: 0.65rem 1rem;
            border-radius: 6px;
            border: 1px solid transparent;
            text-decoration: none;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            text-align: center;
        }
        .btn-primary {
            background: #007a53;
            color: #fff;
        }
        .btn-primary:hover {
            background: #006344;
        }
        .alert {
            padding: 0.75rem 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: 0.95rem;
        }
        .alert-danger {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
        }
        .error-text {
            color: #b42318;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-card">
            <div class="login-header">
                <h1>EVRI Admin</h1>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger">
                    {{ $errors->first() }}
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                <div class="form-group">
                    <label for="username">Username</label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        value="{{ old('username') }}" 
                        required 
                        autofocus
                        autocomplete="username"
                    >
                    @if ($errors->has('username'))
                        <div class="error-text">{{ $errors->first('username') }}</div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input 
                        type="password" 
                        id="password" 
                        name="password" 
                        required 
                        autocomplete="current-password"
                    >
                </div>

                <button type="submit" class="btn btn-primary">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>
