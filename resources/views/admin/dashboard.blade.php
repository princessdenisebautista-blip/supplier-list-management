@extends('layouts.admin')

@section('content')

<style>

body {
    overflow-x: hidden;
}
/* HEADER */
.header-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}

.header-bar h2 {
    margin: 0;
}

/* ADD BUTTON */
.add-btn {
    padding: 10px 15px;
    background: #3498db;
    color: white;
    border: none;
    border-radius: 8px;
    cursor: pointer;
}

.add-btn:hover {
    background: #2980b9;
}

/* TABLE */
table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 10px;
    background: transparent;
}

/* HEADER */
th {
    background: rgba(255,255,255,0.1);
    color: rgba(255,255,255,0.8);
    padding: 12px;
    text-align: left;
    border: none;
}

/* ROW STYLE (FLOATING CARDS) */
tr {
    background: rgba(255,255,255,0.06);
    backdrop-filter: blur(8px);

    box-shadow:
        0 6px 15px rgba(0,0,0,0.2),
        inset 0 1px 0 rgba(255,255,255,0.15);

    transition: 0.2s ease;
}

/* CELLS */
td {
    padding: 14px;
    border: none;
    color: white;
}

/* ROUND ROW */
tr td:first-child {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}

tr td:last-child {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
}

/* HOVER LIFT */
tr:hover {
    transform: translateY(-3px);
    background: rgba(255,255,255,0.1);

    box-shadow:
        0 12px 25px rgba(0,0,0,0.3);
}

.table-box {
    width: 90%;
    max-width: 1000px;
    margin: 40px auto;

    padding: 25px;
    border-radius: 16px;

    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(12px);

    border: 1px solid rgba(255,255,255,0.15);

    box-shadow:
        0 15px 35px rgba(0,0,0,0.3),
        inset 0 1px 0 rgba(255,255,255,0.2);

    color: white;
}

.content {
    margin-left: 220px;
    min-height: 100vh;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    padding-top: 30px;
    background: linear-gradient(135deg, #0f172a, #1e293b, #0b1220);
}
/* HEADER ROW */
th {
    background: #2c3e50;
    color: white;
    padding: 12px;
}

/* CELLS */
td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

/* ROW HOVER */
tr:hover {
    background: #f5f5f5;
}

/* ACTION BUTTONS */
.add-btn,
.btn-edit {
    background: linear-gradient(135deg, #3b82f6, #2563eb);
    color: white;
    border: none;
    border-radius: 8px;
    padding: 8px 12px;

    cursor: pointer;
    transition: 0.2s;

    box-shadow: 0 6px 15px rgba(37,99,235,0.4);
}

.add-btn:hover,
.btn-edit:hover {
    transform: translateY(-2px);
}

.btn-delete {
    background: linear-gradient(135deg, #ef4444, #dc2626);
    color: white;
    border-radius: 8px;
    padding: 8px 12px;

    box-shadow: 0 6px 15px rgba(220,38,38,0.4);
}

/* MODAL OVERLAY */
.modal {
    display: none;
    position: fixed;
    inset: 0;
    z-index: 9999;

    background: rgba(0,0,0,0.5);

    justify-content: center;
    align-items: center;
}

.modal.show {
    display: flex;
}

/* MODAL BOX */
.modal-content {
    background: rgba(30,41,59,0.95);
    backdrop-filter: blur(15px);
     width: 300px; 
     max-width: 90%;

    padding: 20px;

    padding: 25px;
    border-radius: 16px;

    border: 1px solid rgba(255,255,255,0.15);

    box-shadow:
        0 20px 40px rgba(0,0,0,0.5),
        inset 0 1px 0 rgba(255,255,255,0.1);

    color: white;
}

.modal-content input::placeholder {
    color: rgba(255,255,255,0.8); /* 👈 white placeholder */
}

.modal-content input,
.modal-content select {
    margin-bottom: 10px;
    font-size: 13px;
}

.modal-content label {
    display: block;
    margin-top: 10px;
    font-size: 13px;
    font-weight: 600;
    color: #ffffff;
}

.modal-content input,
.modal-content select {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: none;

    background: rgba(255,255,255,0.08);
    color: white;

    margin-top: 5px;

    box-shadow: inset 0 2px 6px rgba(0,0,0,0.5);
}

.modal-content input:focus,
.modal-content select:focus {
    background: rgba(255,255,255,0.15);
    outline: none;
}

.modal-content button {
    padding: 10px 12px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    margin-top: 15px;
    font-weight: 600;
}

/* PRIMARY BUTTON (SAVE / UPDATE) */
.modal-content button[type="submit"] {
    background: #3498db;
    color: white;
    width: 100%;
}

.modal-content button[type="submit"]:hover {
    background: #2980b9;
}

/* CANCEL BUTTON */
.modal-content button[type="button"] {
    background: #e74c3c;
    color: white;
    width: 100%;
    margin-top: 8px;
}

.modal-content button[type="button"]:hover {
    background: #c0392b;
}

/* OPTIONAL ANIMATION */
@keyframes pop {
    from {
        transform: scale(0.9);
        opacity: 0;
    }
    to {
        transform: scale(1);
        opacity: 1;
    }
}

/* TOAST CONTAINER */
#toast {
    visibility: hidden;
    min-width: 250px;
    background-color: rgb(81, 220, 244);
    color: #fff;
    text-align: center;
    border-radius: 8px;
    padding: 12px;
    position: fixed;
    z-index: 3000;
    top: 20px;      /* 👈 move to top */
    right: 20px;    /* 👈 keep right */

    font-size: 14px;
}

/* SHOW TOAST */
#toast.show {
    visibility: visible;
    animation: fadeInOut 3s ease;
}

/* SUCCESS */
.toast-success {
    background-color: #2ecc71;
}

/* ERROR */
.toast-error {
    background-color: #e74c3c;
}

/* ANIMATION */
@keyframes fadeInOut {
    0% { opacity: 0; transform: translateY(20px); }
    10% { opacity: 1; transform: translateY(0); }
    90% { opacity: 1; }
    100% { opacity: 0; transform: translateY(20px); }
}
</style>


<div class="table-box">
<div class="header-bar">
    <h1>Users CRUD (Admin)</h1>
    <button class="add-btn" onclick="openAddModal()">➕ Add User</button>
</div>

<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>

    @foreach($users as $user)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->role }}</td>

        <td>
            <!-- EDIT -->
            <button type="button"
            class="btn-edit"
                onclick="openEditModal(this)"
                data-id="{{ $user->id }}"
                data-name="{{ $user->name }}"
                data-role="{{ $user->role }}">
                Edit
            </button>

            <!-- DELETE -->
            <form method="POST" action="{{ route('user.delete', $user->id) }}" style="display:inline;">
                @csrf
                @method('DELETE')

                <button type="button" 
                class="btn-delete"
                onclick="openDeleteModal({{ $user->id }})">
                    Delete
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

<!-- EDIT MODAL -->
<div id="editModal" class="modal">
  <div class="modal-content">
    <form method="POST" id="editForm">
      @csrf
      @method('PUT')

      <input type="hidden" name="id" id="edit_id">

      <label>Name</label>
      <input type="text" name="name" id="edit_name">

      <label>Role</label>
      <select name="role" id="edit_role">
          <option value="user">User</option>
          <option value="admin">Admin</option>
      </select>

      <button type="submit">Save Changes</button>
      <button type="button" onclick="closeEditModal()">Cancel</button>
    </form>
  </div>
</div>

<!-- DELETE MODAL -->
<div id="deleteModal" class="modal">
  <div class="modal-content">
    <p>Are you sure you want to delete this user?</p>

    <form method="POST" id="deleteForm">
        @csrf
        @method('DELETE')

        <button type="submit">Yes, Delete</button>
        <button type="button" onclick="closeDeleteModal()">Cancel</button>
    </form>
  </div>
</div>

<!-- ADD USER MODAL -->
<div id="addModal" class="modal">
  <div class="modal-content">

    <form method="POST" action="{{ route('user.add') }}">
      @csrf

      <label></label>
<input type="text" name="name" required placeholder="Full Name">

<label></label>
<input type="email" name="email" required placeholder="Email Address">

<label></label>
<input type="password" name="password" required placeholder="Password">
<br></br>

<label>Select user role</label>
<select name="role">
    <option value="user">User</option>
    <option value="admin">Administrator</option>
</select>

      <button type="submit">Add User</button>
      <button type="button" onclick="closeAddModal()">Cancel</button>

    </form>

  </div>
</div>

<div id="toast"></div>

<script>
function openAddModal() {
    document.getElementById("addModal").classList.add("show");
}

function closeAddModal() {
    document.getElementById("addModal").classList.remove("show");
}

function openEditModal(btn) {
    document.getElementById("editModal").classList.add("show");

    document.getElementById("edit_id").value = btn.dataset.id;
    document.getElementById("edit_name").value = btn.dataset.name;
    document.getElementById("edit_role").value = btn.dataset.role;

    document.getElementById("editForm").action = "/user/" + btn.dataset.id;
}

function closeEditModal() {
    document.getElementById("editModal").classList.remove("show");
}

function openDeleteModal(id) {
    document.getElementById("deleteModal").classList.add("show");
    document.getElementById("deleteForm").action = "/user/" + id;
}

function closeDeleteModal() {
    document.getElementById("deleteModal").classList.remove("show");
}





function showToast(message, type = "success") {
    let toast = document.getElementById("toast");

    toast.className = "show toast-" + type;
    toast.innerText = message;

    setTimeout(() => {
        toast.className = toast.className.replace("show", "");
    }, 3000);
}
</script>

@if(session('success'))
<script>
    showToast("{{ session('success') }}", "success");
</script>
@endif

@if(session('error'))
<script>
    showToast("{{ session('error') }}", "error");
</script>
@endif


@endsection