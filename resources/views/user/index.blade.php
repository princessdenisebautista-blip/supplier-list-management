@extends('layouts.main')

@section('content')

<style>

html,body{
    margin:0 !important;
    padding:0 !important;
    width:100%;
    overflow-x:hidden;
}

*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

/* PAGE BACKGROUND */
body{
    background:linear-gradient(
    135deg,
    #0f172a,
    #1e293b,
    #0b1220
    );
}

/* remove Laravel spacing */
.container,
.container-fluid,
.content,
main{
    margin:0 !important;
    padding:0 !important;
    width:100%;
}

/* NAVBAR */
.navbar{
    position:sticky;
    top:0;

    width:100%;
    height:75px;

    display:flex;
    justify-content:space-between;
    align-items:center;

    padding:0 30px;

    background:rgba(255,255,255,0.08);
    backdrop-filter:blur(12px);

    border-bottom:1px solid rgba(255,255,255,.1);

    z-index:999;
}

.company-name{
    color:white;
    font-size:22px;
    font-weight:700;
}

.logout-btn{
    background:linear-gradient(
    135deg,
    #ef4444,
    #dc2626
    );

    color:white;
    padding:10px 18px;

    border-radius:10px;
    text-decoration:none;

    transition:.3s;
}

.logout-btn:hover{
    transform:translateY(-2px);
}

/* DASHBOARD */
.dashboard-container{
    width:100%;
    padding:30px;

    display:flex;
    flex-direction:column;
    align-items:center;
}

.dashboard-container h3{
    width:100%;
    max-width:1200px;

    color:white;
    margin-bottom:20px;
}

/* TABLE CARD */
.table-box{
    width:100%;
    max-width:1200px;

    padding:25px;
    border-radius:16px;

    background:rgba(255,255,255,.08);
    backdrop-filter:blur(12px);

    border:1px solid rgba(255,255,255,.15);

    box-shadow:
    0 15px 35px rgba(0,0,0,.3),
    inset 0 1px 0 rgba(255,255,255,.15);

    color:white;

    overflow-x:auto;
}

.table-box h3{
    color:white;
    margin-bottom:15px;
}

/* SEARCH */
.search-box{
    margin-bottom:20px;
}

.search-box input{
    width:250px;
    padding:10px 15px;

    border:none;
    border-radius:10px;

    background:rgba(255,255,255,.08);

    color:white;

    outline:none;
}

.search-box input::placeholder{
    color:rgba(255,255,255,.6);
}

.search-box input:focus{
    box-shadow:
    0 0 0 2px rgba(52,152,219,.4);
}

/* TABLE */
table{
    width:100%;
    min-width:850px;

    border-collapse:separate;
    border-spacing:0 10px;

    background:transparent;
}

/* HEADER */
th{
    padding:14px;

    background:rgba(255,255,255,.1);

    color:rgba(255,255,255,.9);

    border:none;
}

/* ROWS */
tr{
    background:rgba(255,255,255,.06);

    backdrop-filter:blur(8px);

    box-shadow:
    0 6px 15px rgba(0,0,0,.2);

    transition:.25s;
}

tr:hover{
    transform:translateY(-3px);

    background:rgba(255,255,255,.1);
}

/* CELLS */
td{
    padding:14px;
    border:none;
    color:white;
}

tr td:first-child{
    border-top-left-radius:10px;
    border-bottom-left-radius:10px;
}

tr td:last-child{
    border-top-right-radius:10px;
    border-bottom-right-radius:10px;
}

/* STATUS */
.status-badge{
    display:inline-block;

    padding:8px 16px;

    border-radius:999px;

    color:white;
    font-size:13px;
    font-weight:600;
}

.status-badge.active{
    background:
    linear-gradient(
    135deg,
    #22c55e,
    #16a34a
    );
}

.status-badge.inactive{
    background:
    linear-gradient(
    135deg,
    #ef4444,
    #dc2626
    );
}

/* MOBILE */
@media(max-width:768px){

.dashboard-container{
    padding:15px;
}

.navbar{
    padding:0 15px;
}

.company-name{
    font-size:18px;
}

.search-box input{
    width:100%;
}

table{
    min-width:800px;
}
}

.nav-right{
    display:flex;
    align-items:center;
    gap:12px;
}

.profile-btn{
    background:#3498db;
    color:white;
    padding:10px 18px;
    border-radius:8px;
    text-decoration:none;
    transition:.3s;
}

.profile-btn:hover{
    background:#2980b9;
}

.logout-btn{
    background:#e74c3c;
    color:white;
    padding:10px 18px;
    border-radius:8px;
    text-decoration:none;
    transition:.3s;
}

.logout-btn:hover{
    background:#c0392b;
}

</style>

<!-- NAVBAR -->
<div class="navbar">

    <div class="company-name">
        SupplierLink
    </div>

     <div class="nav-right">

        <a href="{{ route('profile') }}"
           class="profile-btn">

           Profile
        </a>

    <a href="{{ route('logout') }}"
       class="logout-btn">

       Logout

    </a>

     </div>

</div>


<!-- DASHBOARD -->
<div class="dashboard-container">


<h3>Welcome, {{ Auth::user()->name }}</h3>


<!-- TABLE -->
<div class="table-box">

<h3>Supplier List</h3>

<div class="search-box">
<input type="text"
id="searchInput"
placeholder=" Search supplier..."
onkeyup="searchSupplier()">
</div>

<table>

<tr>
<th>#</th>
<th>Supplier Name</th>
<th>Category</th>
<th>Contact</th>
<th>Phone</th>
<th>Email</th>
<th>Rating</th>
<th>Status</th>
</tr>

@foreach($suppliers as $supplier)

<tr>

<td>{{ $loop->iteration }}</td>
<td>{{ $supplier->name }}</td>
<td>{{ $supplier->category }}</td>
<td>{{ $supplier->primary_contact }}</td>
<td>{{ $supplier->phone }}</td>
<td>{{ $supplier->email }}</td>

<!-- Rating -->
<td>

<div class="rating-stars">

@for($i=1; $i<=5; $i++)

@if($i <= $supplier->rating)
⭐
@else
☆
@endif

@endfor

</div>

<small>{{ $supplier->rating }}/5</small>

</td>

<!-- Status -->
<td>
<span class="status-badge {{ $supplier->status }}">
{{ ucfirst($supplier->status) }}
</span>
</td>

</tr>

@endforeach

</table>

</div>
</div>
      

<script>
function searchSupplier(){

let input =
document.getElementById("searchInput")
.value.toLowerCase();

let rows =
document.querySelectorAll("table tr");

rows.forEach((row,index)=>{

if(index===0) return;

let text=row.innerText.toLowerCase();

row.style.display=
text.includes(input)
? ""
: "none";

});

}
</script>

@endsection