<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>

<style>
body {
    margin: 0;
    font-family: Arial;
    overflow-x: hidden; /* prevent horizontal scroll */
}

/* SIDEBAR */
.sidebar {
    width: 220px;
    height: 100vh;
    background: #2c3e50;
    color: white;
    padding-top: 20px;
    position: fixed;
    left: 0;
    top: 0;
}

/* CONTENT AREA */
.content{
    margin-left:220px;
    min-height:100vh;
    padding:30px;
    background:#f5f5f5;

    display:block;

    position:relative;

    overflow:visible !important;
}
.title {
    text-align: center;
    margin: 20px 0;
    font-weight: bold;
}

/* TABLE WRAPPER */
.table-box {
    width: 90%;
    max-width: 1000px;
    background: white;
    padding: 20px;
    border-radius: 10px;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: collapse;
    text-align: center;
}

th, td,{
    padding: 10px;
}

/* BUTTON STYLE */
.sidebar-btn {
    display: block;
    padding: 12px 20px;
    margin: 5px 10px;
    color: white;
    text-decoration: none;
    border-radius: 6px;
    background: transparent;
    transition: 0.3s;
}

/* HOVER EFFECT */
.sidebar-btn:hover {
    background: #34495e;
    transform: translateX(5px);
}

/* ACTIVE STYLE (optional manual use) */
.sidebar-btn.active {
    background: #1abc9c;
}

.sidebar {
    display: flex;
    flex-direction: column;
}

.logout-form {
    margin-top: auto;
    padding: 20px;
}

.logout-btn {
    width: 100%;
    padding: 10px;
    background: #e74c3c;
    border: none;
    color: white;
    border-radius: 8px;
    cursor: pointer;
}

.logout-btn:hover {
    background: #c0392b;
}



</style>

</head>
<body>

    <!-- SIDEBAR -->
   <div class="sidebar">
    <h3 class="title">ADMIN PANEL</h3>

    <a href="{{ route('statistics') }}" class="sidebar-btn">
        📊 Statistical Dashboard
    </a>

    <a href="{{ route('users.index') }}" class="sidebar-btn">
        👥 Users CRUD
    </a>

<a href="{{ route('suppliers') }}" class="sidebar-btn">
        📦 Supplier List
    </a>

 <a href="{{ route('logout') }}" class="sidebar-btn">
        Logout
    </a>
</div>


<div class="content">
    @yield('content')
</div>


</body>
</html>