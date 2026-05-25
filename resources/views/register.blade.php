
<style>
/* BACKGROUND (same as login) */
html, body {
    height: 100%;
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #0f172a, #1e293b, #0b1220);
    overflow: hidden;
}

/* SOFT GLOW */
body::before {
    content: "";
    position: absolute;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(59,130,246,0.25), transparent 70%);
    top: -120px;
    left: -120px;
    filter: blur(30px); /* reduced from 60px */
}

body::after {
    content: "";
    position: absolute;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(16,185,129,0.2), transparent 70%);
    bottom: -120px;
    right: -120px;
    filter: blur(30px);
}

/* TOAST */
.toast-container {
    position: fixed;
    top: 20px;
    right: 20px;
    z-index: 9999;
}

.toast {
    padding: 12px 15px;
    border-radius: 8px;
    margin-bottom: 10px;
    color: white;
    font-size: 14px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    animation: slideIn 0.3s ease;
}

.toast-success { background: #2ecc71; }
.toast-danger { background: #e74c3c; }

@keyframes slideIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* CENTER */
.register-wrapper {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    z-index: 1;
}

.card {
    width: 400px;
    border-radius: 18px !important;

    background: rgba(30, 41, 59, 0.95) !important; /* DARK like login */
    backdrop-filter: blur(10px);

    border: 1px solid rgba(255,255,255,0.15) !important;

    box-shadow:
        0 20px 40px rgba(0,0,0,0.5),
        inset 0 1px 0 rgba(255,255,255,0.05);

    color: white !important;
}

.card:hover {
    transform: scale(1.02);
}

/* HEADER */
.card-header {
    background: linear-gradient(135deg, #3b82f6, #2563eb) !important;
    color: white;
    font-weight: bold;
    padding: 18px;
    border-top-left-radius: 18px;
    border-top-right-radius: 18px;
    text-align: center;
    letter-spacing: 1px;
}

/* BODY */
.card-body {
    background: transparent !important;
    color: white !important;
}
/* INPUT */

.form-control {
    background: #4b5563 !important; /* GREY (same feel as login) */
    color: white !important;
    border: none !important;
    border-radius: 10px;
    padding: 12px;
    outline: none;

   box-shadow: inset 0 0 6px rgba(0,0,0,0.2);
    transition: 0.2s ease;
}

/* placeholder */
.form-control::placeholder {
    color: rgba(255, 255, 255, 0.75);
}

/* WHEN CLICKED → WHITE */
.form-control:focus {
    background: #ffffff !important;
    color: black !important;

    box-shadow: 0 0 0 2px rgba(59,130,246,0.5);
}

/* LABEL */
label {
    font-size: 13px;
    color: rgba(155, 228, 255, 0.85);
}

/* BUTTON (same feel as login) */
.btn-primary {
    width: 100%;
    padding: 12px;
    border: none;
    border-radius: 10px;

    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    font-weight: bold;

    cursor: pointer;
    transition: 0.3s ease;

    box-shadow: 0 8px 16px rgba(37,99,235,0.4);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 20px rgba(37,99,235,0.5);
}

/* LINK */
a {
    color: #93c5fd;
    text-decoration: none;
    font-size: 13px;
}

a:hover {
    text-decoration: underline;
}

</style>



@if ($errors->any())
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
        @foreach ($errors->all() as $error)
            <div class="toast toast-danger">
                <div class="toast-body">{{ $error }}</div>
            </div>
        @endforeach
    </div>
@endif


@extends('layouts.main')

@section('content')

<div class="register-wrapper">

    <div class="card">
        <div class="card-header">Register</div>

        <div class="card-body">

            <form method="POST" action="{{ route('register') }}">
                @csrf 

                <div class="mb-3">
                    <label>Name</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" placeholder="Enter your name" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="Enter your email" required>
                </div>


                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
                </div>

                <div class="mb-3">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 mt-2">
    Create Account
</button>

                <div class="mt-3 text-center">
                    <a href="{{ route('login') }}">Already have an account? Login here.</a>
                </div>

            </form>

        </div>
    </div>

</div>

@endsection