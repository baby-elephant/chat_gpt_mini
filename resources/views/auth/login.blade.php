<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>HTML Sample</title>
    <link rel="stylesheet" href="./css/auth/style.css">
    <meta id="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- login.blade.php -->
    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <div class="auth-form__field">
            <input type="email" name="email" required placeholder="Email Address">
        </div>

        <div class="auth-form__field">
            <input type="password" name="password" required autocomplete="current-password" placeholder="Password">
        </div>

        <button type="submit" class="auth-form__submit-btn">
            Login
        </button>
    </form>
    <div class="register-link">
        <p>新規ユーザーですか？<a href="{{ route('register') }}">ここで登録</a></p>
    </div>
</body>
