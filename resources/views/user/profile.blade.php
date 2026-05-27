@extends('layouts.main')

@section('content')

<style>

body{
    overflow:hidden;
}

/* PAGE */
.profile-wrapper{

    min-height:100vh;

    display:flex;
    justify-content:center;
    align-items:center;

    background: linear-gradient(
        135deg,
        #0f172a,
        #1e293b,
        #0b1220
    );

    padding:30px;
}


/* CARD */
.profile-card{

    width:500px;
    padding:35px;

    border-radius:20px;

    background: rgba(255,255,255,0.08);

    backdrop-filter:blur(12px);

    border:1px solid rgba(255,255,255,.15);

    box-shadow:
    0 15px 35px rgba(0,0,0,.35),
    inset 0 1px 0 rgba(255,255,255,.15);

    color:white;

    text-align:center;
}


/* IMAGE */
.profile-image{

    width:130px;
    height:130px;

    border-radius:50%;

    object-fit:cover;

    border:4px solid #3498db;

    margin-bottom:20px;

    box-shadow:
    0 10px 25px rgba(52,152,219,.35);
}


/* INPUTS */
.profile-card input{

    width:100%;

    padding:13px;

    margin-top:10px;
    margin-bottom:15px;

    border:none;

    border-radius:10px;

    outline:none;

    background:rgba(255,255,255,.08);

    color:white;

    box-sizing:border-box;
}

.profile-card input:focus{

    box-shadow:
    0 0 0 2px rgba(52,152,219,.4);
}

.profile-card input::placeholder{

    color:rgba(255,255,255,.5);
}


/* BUTTONS */
.button-group{

display:flex;
gap:10px;
margin-top:20px;
}


.save-btn{

flex:1;

padding:13px;

border:none;

border-radius:10px;

background:linear-gradient(
135deg,
#3498db,
#2563eb
);

color:white;

cursor:pointer;

font-weight:600;
}

.save-btn:hover{

transform:translateY(-2px);
}


.back-btn{

flex:1;

padding:13px;

border-radius:10px;

background:linear-gradient(
135deg,
#ef4444,
#dc2626
);

color:white;

text-decoration:none;

display:flex;
justify-content:center;
align-items:center;

font-weight:600;
}

.back-btn:hover{

transform:translateY(-2px);
}

</style>

<div class="profile-wrapper">

<div class="profile-card">

<h2>My Profile</h2>

<form
method="POST"
action="{{ route('profile.update') }}"
enctype="multipart/form-data">

@csrf


<img

class="profile-image"

src="{{ Auth::user()->profile_picture
? asset('storage/'.Auth::user()->profile_picture)
: asset('images/default-user.png') }}">

<input
type="file"
name="profile_picture">


<input
type="text"
name="name"
value="{{ Auth::user()->name }}">

<input
type="email"
name="email"
value="{{ Auth::user()->email }}">


<div class="button-group">

<button
type="submit"
class="save-btn">

Save Changes

</button>

<a
href="{{ route('user.dashboard') }}"
class="back-btn">

Back

</a>

</div>

</form>

</div>

</div>

@endsection