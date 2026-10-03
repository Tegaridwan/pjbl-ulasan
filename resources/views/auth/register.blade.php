<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Penjual</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        body {
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .card {
            border: 1px solid #e5e7eb;
            border-radius: 40px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            text-align: center;
        }

        .icon-container {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            width: 24px;
            height: 24px;
            border: 2px solid #2563eb;
            border-radius: 4px;
            margin-bottom: 24px;
        }

        .icon-inner {
            width: 10px;
            height: 10px;
            background-color: #2563eb;
            border-radius: 1px;
        }

        h2 {
            color: #1e293b;
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #64748b;
            font-size: 13px;
            margin-bottom: 32px;
        }

        form {
            text-align: left;
        }

        .form-group {
            margin-bottom: 16px;
        }

        label {
            display: block;
            color: #334155;
            font-size: 12px;
            font-weight: 700;
            margin-bottom: 8px;
        }

        input[type="email"],
        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            font-size: 13px;
            color: #1e293b;
            outline: none;
            transition: border-color 0.2s;
        }

        input:focus {
            border-color: #2563eb;
        }

        input::placeholder {
            color: #94a3b8;
        }

        .btn-primary {
            background-color: #2563eb;
            color: white;
            border: none;
            border-radius: 8px;
            padding: 14px;
            width: 100%;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s;
            margin-top: 12px;
        }

        .btn-primary:hover {
            background-color: #1d4ed8;
        }

        .links {
            margin-top: 24px;
            font-size: 13px;
            color: #64748b;
        }

        .links p {
            margin-bottom: 8px;
        }

        .links a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .alert {
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 13px;
            text-align: left;
        }
        
        .alert-error {
            background-color: #fef2f2;
            color: #b91c1c;
            border: 1px solid #f87171;
        }

        .alert-error ul {
            margin-left: 20px;
            margin-top: 4px;
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon-container">
            <div class="icon-inner"></div>
        </div>
        
        <h2>Register Penjual</h2>
        <div class="subtitle">Daftar akun penjual kamu</div>

        @if ($errors->any())
            <div class="alert alert-error">
                <strong>Oops! Ada yang salah:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Buat password" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi password" required>
            </div>
            <button type="submit" class="btn-primary">Daftar</button>
        </form>

        <div class="links">
            <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a></p>
            <p><a href="{{ route('dashboard') }}">Kembali ke Beranda</a></p>
        </div>
    </div>
</body>
</html>