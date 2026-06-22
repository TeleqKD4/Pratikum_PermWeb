<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – Universitas Pelita Bangsa</title>
    <link rel="stylesheet" href="<?= base_url('style.css'); ?>">
    <style>
        body {
            background: linear-gradient(135deg, #1a73e8, #0d47a1);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
        }

        #login-wrapper {
            background: #fff;
            padding: 40px 36px;
            border-radius: 10px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            width: 100%;
            max-width: 380px;
        }

        #login-wrapper .logo {
            text-align: center;
            margin-bottom: 24px;
        }

        #login-wrapper .logo h1 {
            font-size: 1.5rem;
            color: #1a73e8;
            margin: 0;
        }

        #login-wrapper .logo p {
            font-size: 0.82rem;
            color: #888;
            margin: 4px 0 0;
        }

        .form-label {
            display: block;
            font-size: 0.88rem;
            font-weight: 600;
            color: #444;
            margin-bottom: 5px;
        }

        .form-control {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 0.95rem;
            box-sizing: border-box;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            outline: none;
            border-color: #1a73e8;
            box-shadow: 0 0 0 3px rgba(26,115,232,0.15);
        }

        .mb-3 { margin-bottom: 16px; }

        .btn-primary {
            width: 100%;
            padding: 11px;
            background: #1a73e8;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.2s;
            margin-top: 4px;
        }

        .btn-primary:hover { background: #155ab0; }

        .alert-danger {
            background: #fdecea;
            color: #c0392b;
            border: 1px solid #f5c6cb;
            border-radius: 5px;
            padding: 10px 14px;
            margin-bottom: 16px;
            font-size: 0.88rem;
        }

        .login-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.8rem;
            color: #aaa;
        }
    </style>
</head>
<body>

<div id="login-wrapper">
    <div class="logo">
        <h1>🎓 Sign In</h1>
        <p>Universitas Pelita Bangsa</p>
    </div>

    <?php if (session()->getFlashdata('flash_msg')): ?>
        <div class="alert-danger">
            ⚠️ <?= session()->getFlashdata('flash_msg') ?>
        </div>
    <?php endif; ?>

    <form action="" method="post">
        <?= csrf_field() ?>

        <div class="mb-3">
            <label for="InputForEmail" class="form-label">Email Address</label>
            <input type="email"
                   name="email"
                   class="form-control"
                   id="InputForEmail"
                   placeholder="contoh@email.com"
                   value="<?= set_value('email') ?>"
                   required>
        </div>

        <div class="mb-3">
            <label for="InputForPassword" class="form-label">Password</label>
            <input type="password"
                   name="password"
                   class="form-control"
                   id="InputForPassword"
                   placeholder="••••••••"
                   required>
        </div>

        <button type="submit" class="btn-primary">Login</button>
    </form>

    <div class="login-footer">
        &copy; <?= date('Y') ?> Universitas Pelita Bangsa
    </div>
</div>

</body>
</html>