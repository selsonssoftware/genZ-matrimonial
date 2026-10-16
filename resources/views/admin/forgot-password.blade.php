<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Forgot Password</title>
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

        .btn:hover {
            background: #37101e;
        }

        .input {
            width: 100%;
            padding: 12px;
            margin: 8px 0 18px;
            border: 1px solid #ebdcd5;
            border-radius: 8px;
            outline: none;
        }

        .msg {
            padding: 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-bottom: 15px;
            word-break: break-all;
        }
    </style>
</head>

<body>

    <div class="box">
        <h2 style="color: #37101e; margin-bottom: 8px;">Forgot Password</h2>
        <p style="font-size: 13px; color: #666; margin-bottom: 20px;">Enter your Registered Email</p>

        @if (session('status'))
            <div class="msg" style="background: #e0f2fe; color: #0369a1;">
                {{ session('status') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="msg" style="background: #fee2e2; color: #991b1b;">
                {{ $errors->first() }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <label style="font-size: 12px; font-weight: 700; color: #37101e;">Admin Email</label>
            <input type="email" name="email" class="input" placeholder="Enter your registered email"
                value="{{ old('email') }}" required>
            <button type="submit" class="btn">Send Reset Link</button>
        </form>

        <p style="text-align: center; margin-top: 18px;">
            <a href="{{ route('login') }}"
                style="color: #8a1f3d; text-decoration: none; font-size: 13px; font-weight: 600;">← Back to Login</a>
        </p>
    </div>

</body>

</html>