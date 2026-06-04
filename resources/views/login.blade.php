@extends('layouts.main')

@section('content')
<style>
html, body {
    height: 100%;
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #0f172a, #1e293b, #0b1220);
    overflow: hidden;
}


body::before {
    content: "";
    position: absolute;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(59,130,246,0.25), transparent 70%);
    top: -120px;
    left: -120px;
    filter: blur(30px);
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

/* CENTER WRAPPER */
.login-wrapper {
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    z-index: 1;
}

/* CARD (NO MORE TILT) */
.card {
    width: 380px;
    border-radius: 18px;

    background: rgba(255,255,255,0.12); 
    backdrop-filter: blur(10px); 
    
    border: 1px solid rgba(255,255,255,0.25);

    box-shadow:
        0 20px 40px rgba(0,0,0,0.4),
        inset 0 1px 0 rgba(255,255,255,0.1);

    transition: 0.3s ease;
}


.card:hover {
    transform: scale(1.02);
}

/* HEADER */
.card-header {
    background: rgba(59,130,246,0.9);
    color: white;
    font-weight: bold;
    padding: 18px;
    border-top-left-radius: 18px;
    border-top-right-radius: 18px;
    text-align: center;
    letter-spacing: 1px;
    text-transform: uppercase;
}

/* BODY */
.card-body {
    padding: 25px;
    color: white;
}

/* INPUTS */
.form-control {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: none;
    margin-top: 6px;
    margin-bottom: 15px;

    background: rgba(255,255,255,0.15);
    color: white;
    outline: none;

    box-shadow: inset 0 0 6px rgba(0,0,0,0.2);
}

.form-control::placeholder {
    color: rgba(255, 255, 255, 0.7);
}

/* LABEL */
label {
    font-size: 13px;
    color: rgba(155, 228, 255, 0.85);
}

/* BUTTON */
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



<div class="login-wrapper">

    <div class="card">
        <div class="card-header text-center">Login</div>

        <div class="card-body">

        @if(session('success'))
<div class="toast-container">
    <div class="toast toast-success" id="successToast">
        {{ session('success') }}
    </div>
</div>
@endif

            <form method="POST" action="{{ route('login') }}">
                @csrf 

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" placeholder="Enter your email">
                </div>

                <div class="mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Enter your password">
                </div>

                <button type="submit" class="btn btn-primary w-100">Login</button>
            </form>

            <div class="mt-3 text-center">
                <a href="{{ route('register') }}">Don't have an account? Register here.</a>
            </div>

        </div>
    </div>

</div>

<script>
const toast = document.getElementById('successToast');

if(toast){
    setTimeout(() => {
        toast.style.opacity = '0';

        setTimeout(() => {
            toast.remove();
        }, 500);

    }, 3000);
}
</script>

@endsection