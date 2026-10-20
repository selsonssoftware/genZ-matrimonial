<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@500;700&display=swap" rel="stylesheet">
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

        .box {
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
        }

        .btn {
            width: 100%;
            padding: 13px;
            background: #501729;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            cursor: pointer;
        }

        .input {
            width: 100%;
            padding: 12px;
            margin: 8px 0 16px;
            border: 1px solid #ebdcd5;
            border-radius: 8px;
            outline: none;
        }
    </style>
</head>

<body>

    <div class="box">
        <h2 style="color: #37101e; margin-bottom: 12px;">Create New Password</h2>

        @if ($errors->any())
            <div
                style="background: #fee2e2; color: #991b1b; padding: 10px; border-radius: 8px; font-size: 13px; margin-bottom: 15px;">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <label style="font-size: 12px; font-weight: 700; color: #37101e;">Email</label>
            <input type="email" name="email" value="{{ $email ?? old('email') }}" class="input" required readonly>

            <label style="font-size: 12px; font-weight: 700; color: #37101e;">New Password</label>
            <input type="password" name="password" class="input" placeholder="New password" required>

            <label style="font-size: 12px; font-weight: 700; color: #37101e;">Confirm Password</label>
            <input type="password" name="password_confirmation" class="input" placeholder="Confirm password" required>

            <button type="submit" class="btn">Update Password</button>
        </form>
    </div>

</body>

</html>