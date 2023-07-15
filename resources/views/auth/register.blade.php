<!doctype html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>HTML Sample</title>
    <link rel="stylesheet" href="./css/auth/style.css">
    <meta id="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <!-- register.blade.php -->
    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf

        <div class="auth-form__field">
            <input type="text" name="name" required autofocus placeholder="Name">
        </div>

        <div class="auth-form__field">
            <input type="email" name="email" required placeholder="Email Address">
        </div>

        <div class="auth-form__field">
            <input type="password" name="password" required autocomplete="new-password" placeholder="Password">
        </div>

        <div class="auth-form__field">
            <input type="password" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
        </div>

        <button type="submit" class="auth-form__submit-btn">
            Register
        </button>
    </form>
</body>
