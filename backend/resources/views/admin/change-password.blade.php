<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Change Password - Admin Console</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: #f6f3ee;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .card-box {
            background: #ffffff;
            max-width: 480px;
            width: 100%;
            border-radius: 20px;
            padding: 40px;
            box-shadow: 0 14px 40px rgba(55, 16, 30, 0.08);
            border: 1px solid rgba(55, 16, 30, 0.05);
        }

        .badge {
            width: 38px;
            height: 38px;
            background: #cfa860;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #37101e;
            font-size: 16px;
            margin-bottom: 16px;
        }

        .title {
            font-size: 24px;
            font-weight: 800;
            color: #37101e;
            margin-bottom: 6px;
        }

        .subtitle {
            font-size: 13px;
            color: #7a7175;
            margin-bottom: 25px;
            line-height: 1.5;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-label {
            display: block;
            font-size: 12px;
            font-weight: 700;
            color: #37101e;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-input {
            width: 100%;
            padding: 12px 14px;
            background: #f8f6f5;
            border: 1px solid #ebdcd5;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            transition: all 0.2s;
        }

        .form-input:focus {
            border-color: #37101e;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(55, 16, 30, 0.08);
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: #501729;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-weight: 700;
            font-size: 14px;
            cursor: pointer;
            margin-top: 10px;
            transition: background 0.2s;
        }

        .btn-submit:hover {
            background: #37101e;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 18px;
            border-left: 4px solid #ef4444;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 18px;
            border-left: 4px solid #22c55e;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 13px;
            color: #8a1f3d;
            text-decoration: none;
            font-weight: 600;
        }
    </style>
</head>

<body>

    <div class="card-box">
        <div class="badge">🔒</div>
        <h2 class="title">Change Password</h2>
        <p class="subtitle">Admin Dashboard</p>

        @if (session('success'))
            <div class="alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert-error">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('change.password.update') }}">
            @csrf

            <div class="form-group">
                <label class="form-label">New Password</label>
                <input type="password" name="new_password" class="form-input" placeholder="Enter new password"
                    autocomplete="new-password" required>
            </div>

            <div class="form-group">
                <label class="form-label">Confirm New Password</label>
                <input type="password" name="new_password_confirmation" class="form-input"
                    placeholder="Confirm new password" autocomplete="new-password" required>
            </div>

            <button type="submit" class="btn-submit">Update Password →</button>
        </form>

        <a href="{{ route('dashboard') }}" class="back-link">← Back to Dashboard</a>
    </div>

</body>

</html>