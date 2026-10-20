<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Login - Thirumana</title>
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

        .card-container {
            display: flex;
            max-width: 960px;
            width: 100%;
            min-height: 540px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 16px 45px rgba(55, 16, 30, 0.08);
            background: #fff;
        }

        .left-panel {
            flex: 1.1;
            background: #37101e;
            padding: 50px;
            color: #fff;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            position: relative;
            overflow: hidden;
        }

        .left-panel::after {
            content: "";
            position: absolute;
            top: -60px;
            right: -60px;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.04);
        }

        .gold-badge {
            width: 40px;
            height: 40px;
            background: #cfa860;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #37101e;
            margin-bottom: 24px;
            font-size: 18px;
        }

        .brand-subtitle {
            font-size: 11px;
            letter-spacing: 2.5px;
            font-weight: 800;
            color: #d6b26d;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .brand-title {
            font-size: 30px;
            line-height: 1.25;
            font-weight: 800;
            margin-bottom: 16px;
        }

        .brand-desc {
            font-size: 13.5px;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
        }

        .console-card {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            border-radius: 16px;
            padding: 20px 24px;
            margin-top: 30px;
            position: relative;
            z-index: 2;
        }

        .console-title {
            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            margin-bottom: 4px;
            color: #fff;
        }

        .console-desc {
            font-size: 11.5px;
            color: rgba(255, 255, 255, 0.65);
        }

        .right-panel {
            flex: 1.2;
            padding: 55px 50px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .login-heading {
            font-size: 26px;
            font-weight: 800;
            color: #37101e;
            margin-bottom: 6px;
        }

        .login-sub {
            font-size: 13.5px;
            color: #7a7175;
            margin-bottom: 26px;
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
        }

        .form-input {
            width: 100%;
            padding: 12px 14px;
            background: #f8f6f5;
            border: 1px solid #ebdcd5;
            border-radius: 10px;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        .form-input:focus {
            border-color: #37101e;
            background: #fff;
        }

        .row-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            font-size: 12.5px;
        }

        .forgot-link {
            color: #8a1f3d;
            text-decoration: none;
            font-weight: 600;
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
            transition: 0.2s;
        }

        .btn-submit:hover {
            background: #37101e;
        }

        .alert-error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 8px;
            font-size: 12.5px;
            margin-bottom: 18px;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
            padding: 12px;
            border-radius: 8px;
            font-size: 12.5px;
            margin-bottom: 18px;
        }

        .footer-note {
            font-size: 11px;
            text-align: center;
            color: #a19a9d;
            margin-top: 24px;
        }

        @media(max-width: 820px) {
            .card-container {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

    <div class="card-container">
        <div class="left-panel">
            <div>
                <div class="gold-badge">❤</div>
                <div class="brand-subtitle">THIRUMANA</div>
                <h1 class="brand-title">Thoughtful matches.<br>Trusted profiles.</h1>
                <p class="brand-desc">A secure workspace for managing members, vendors and matrimonial services.</p>
            </div>
            <div class="console-card">
                <div style="color: #d6b26d; font-size: 15px; margin-bottom: 6px;">❤</div>
                <div class="console-title">ADMIN CONSOLE</div>
                <div class="console-desc">One platform. Three connected experiences.</div>
            </div>
        </div>

        <div class="right-panel">
            <h2 class="login-heading">Welcome back</h2>
            <p class="login-sub">Sign in to your admin account</p>

            <?php if($errors->any()): ?>
                <div class="alert-error"><?php echo e($errors->first()); ?></div>
            <?php endif; ?>

            <?php if(session('success')): ?>
                <div class="alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('login.submit')); ?>">
                <?php echo csrf_field(); ?>
                <div class="form-group">
                    <label class="form-label">Enter Name or Email</label>
                    <input type="text" name="login" value="<?php echo e(old('login')); ?>" class="form-input"
                        placeholder="Enter your name or email" required autofocus>
                </div>

                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-input" placeholder="Enter your password"
                        required>
                </div>

                <div class="row-actions">
                    <label><input type="checkbox" name="remember"> Remember me</label>
                    <a href="<?php echo e(route('password.request')); ?>" class="forgot-link">Forgot password?</a>
                </div>

                <button type="submit" class="btn-submit">Sign in securely →</button>
            </form>

            <div class="footer-note">Authorized administrators only</div>
        </div>
    </div>

</body>

</html><?php /**PATH C:\xampp\htdocs\genZ-matrimonial\backend\resources\views\admin\login.blade.php ENDPATH**/ ?>