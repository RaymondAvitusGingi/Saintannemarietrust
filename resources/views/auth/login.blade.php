@extends('layouts.app')

@section('title', 'Admin Login - St. Anne Marie Academy Schools')

@section('styles')
<style>
    .login-page {
        min-height: 70vh;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #1e5128 0%, #14361b 100%);
        padding: 2rem 1rem;
    }

    .login-card {
        background: white;
        border-radius: 1.5rem;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        width: 100%;
        max-width: 420px;
        overflow: hidden;
    }

    .login-header {
        background: white;
        padding: 2.5rem 2rem 2rem;
        text-align: center;
        border-bottom: 1px solid #f3f4f6;
    }

    .login-logo {
        width: 5rem;
        height: 5rem;
        border-radius: 50%;
        margin: 0 auto 1rem;
        border: 3px solid var(--school-primary, #1e5128);
        padding: 0.25rem;
        background: white;
    }

    .login-logo img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 50%;
    }

    .login-header h1 {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--school-primary, #1e5128);
        margin-bottom: 0.25rem;
    }

    .login-header p {
        color: #6b7280;
        font-size: 0.875rem;
    }

    .login-body {
        padding: 2rem;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        font-weight: 600;
        color: #374151;
        margin-bottom: 0.5rem;
        font-size: 0.875rem;
    }

    .form-input {
        width: 100%;
        padding: 0.875rem 1rem;
        border: 2px solid #e5e7eb;
        border-radius: 0.75rem;
        font-size: 1rem;
        transition: all 0.3s;
    }

    .form-input:focus {
        outline: none;
        border-color: var(--school-primary, #1e5128);
        box-shadow: 0 0 0 3px rgba(30, 81, 40, 0.1);
    }

    .form-check {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
    }

    .form-check input {
        width: 1.125rem;
        height: 1.125rem;
        accent-color: var(--school-primary, #1e5128);
    }

    .form-check label {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .login-btn {
        width: 100%;
        padding: 1rem;
        background: var(--school-primary, #1e5128);
        color: white;
        border: none;
        border-radius: 0.75rem;
        font-size: 1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s;
    }

    .login-btn:hover {
        background: #14361b;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }

    .error-message {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #dc2626;
        padding: 0.75rem 1rem;
        border-radius: 0.5rem;
        margin-bottom: 1.5rem;
        font-size: 0.875rem;
    }

    .back-link {
        text-align: center;
        margin-top: 1.5rem;
    }

    .back-link a {
        color: #6b7280;
        font-size: 0.875rem;
        text-decoration: none;
    }

    .back-link a:hover {
        color: var(--school-primary, #1e5128);
    }
</style>
@endsection

@section('content')
<div class="login-page">
    <div class="login-card">
        <div class="login-header">
            <div class="login-logo">
                <img src="/images/school/logo_st_anne.jpg" alt="St. Anne Marie Logo">
            </div>
            <h1>Admin Portal</h1>
            <p>Enter your credentials to access the dashboard</p>
        </div>

        <div class="login-body">
            @if ($errors->any())
                <div class="error-message">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email" id="email" name="email" class="form-input" value="{{ old('email') }}" required autofocus>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" id="password" name="password" class="form-input" required>
                </div>

                <div class="form-check">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember me</label>
                </div>

                <button type="submit" class="login-btn">Sign In</button>
            </form>

            <div class="back-link">
                <a href="{{ url('/') }}">← Back to Website</a>
            </div>
        </div>
    </div>
</div>
@endsection
