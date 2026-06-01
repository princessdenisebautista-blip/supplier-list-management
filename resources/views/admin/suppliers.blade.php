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

/* TABLE CONTAINER */
.table-box{
    width:calc(100% - 60px);
    margin:15px auto;

    padding:20px;
    border-radius:16px;

    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(12px);

    border: 1px solid rgba(255,255,255,0.15);

    box-shadow:
        0 15px 35px rgba(0,0,0,0.3),
        inset 0 1px 0 rgba(255,255,255,0.2);

    color:white;

    overflow-x:auto;
}

/* CONTENT */
.content{
    margin-left:220px;
    min-height:100vh;
    padding:20px;
    background: linear-gradient(135deg, #0f172a, #1e293b, #0b1220);
}

.header-container{
    width: calc(100% - 20px);
    margin:30px auto 0;
}

.header-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;

    padding:15px 20px;
    border-radius:12px;

    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(10px);

    border:1px solid rgba(255,255,255,0.15);

    box-shadow:0 10px 25px rgba(0,0,0,0.3);
}

/* TABLE */
table{
    width:max-content;
    min-width:100%;
    background:transparent;

    border-collapse: separate;
    border-spacing: 0 10px;

    white-space:nowrap;
}

th{
    background: rgba(255,255,255,0.1);
    color: rgba(255,255,255,0.85);
    padding: 12px;
    border: none;
}

td{
    padding:14px;
    color:white;
    border:none;
}

/* ROW */
tr{
    background: rgba(255,255,255,0.06);
    backdrop-filter: blur(8px);

    box-shadow:
        0 6px 15px rgba(0,0,0,0.2),
        inset 0 1px 0 rgba(255,255,255,0.15);

    transition: 0.2s ease;
}

/* ROUND EDGES */
tr td:first-child{
    border-top-left-radius:10px;
    border-bottom-left-radius:10px;
}

tr td:last-child{
    border-top-right-radius:10px;
    border-bottom-right-radius:10px;
}

/* HOVER */
tr:hover{
    transform: translateY(-3px);
    background: rgba(255,255,255,0.1);
}


.btn-edit{
    background:linear-gradient(135deg,#3b82f6,#2563eb);
    color:white;

    border:none;
    border-radius:8px;

    padding:8px 12px;
    cursor:pointer;

    transition:.2s;

    box-shadow:
    0 6px 15px rgba(37,99,235,.4);

    margin-right:6px;
}

.btn-edit:hover{
    transform:translateY(-2px);
}

/* DELETE BUTTON */

.btn-delete{
    background:linear-gradient(135deg,#ef4444,#dc2626);

    color:white;
    border:none;

    border-radius:8px;

    padding:8px 12px;

    cursor:pointer;

    transition:.2s;

    box-shadow:
    0 6px 15px rgba(220,38,38,.4);
}

.btn-delete:hover{
    transform:translateY(-2px);
}

/* MODAL OVERLAY */
.modal{
    position:fixed;
    top:0;
    left:0;

    width:100vw;
    height:100vh;

    display:none;
    justify-content:center;
    align-items:center;

    background:rgba(0,0,0,.75);

    z-index:999999;

    overflow:hidden;
}

/* show modal */
.modal.show{
    display:flex;
}

/* MODAL CARD */
.modal-content{
    width:600px;
    max-width:90vw;

    max-height:90vh;
    overflow-y:auto;

    padding:25px;

    border-radius:20px;

    background:#0f172a;

    box-shadow:
    0 25px 50px rgba(0,0,0,.5);

    position:relative;
}

/* TITLE */
.modal-content h3{
    margin:0 0 20px;
    font-size:22px;
    font-weight:700;
    color:white;
    text-align:center;
}

/* LABEL */
.modal-content label{
    display:block;
    margin:14px 0 8px;
    font-size:13px;
    font-weight:600;
    color:rgba(255,255,255,.8);
}

/* INPUTS */
.modal-content input,
.modal-content select{
    width:100%;
    box-sizing:border-box;

    padding:13px 14px;

    border:none;
    border-radius:12px;

    background:rgba(255,255,255,.08);
    color:white;

    outline:none;

    transition:.25s ease;

    box-shadow:
        inset 0 2px 8px rgba(0,0,0,.35);
}

.modal-content input::placeholder{
    color:rgba(255,255,255,.45);
}

.modal-content input:focus,
.modal-content select:focus{
    background:rgba(255,255,255,.14);

    box-shadow:
        0 0 0 2px rgba(52,152,219,.45);
}

.modal-content::-webkit-scrollbar{
    width:8px;
}

.modal-content::-webkit-scrollbar-thumb{
    background:#3498db;
    border-radius:10px;
}

/* BUTTON WRAPPER */
.button-group{
    display:flex;
    gap:12px;
    margin-top:22px;
}

/* BUTTONS */
.modal-content button{
    flex:1;
    padding:14px;

    border:none;
    border-radius:12px;

    font-weight:600;
    cursor:pointer;

    transition:.25s ease;
}

/* SAVE / UPDATE */
.modal-content button[type="submit"]{
    background:linear-gradient(135deg,#3498db,#2563eb);
    color:white;
}

.modal-content button[type="submit"]:hover{
    transform:translateY(-2px);
    box-shadow:0 10px 20px rgba(52,152,219,.35);
}

/* CANCEL */
.modal-content button[type="button"]{
    background:linear-gradient(135deg,#ef4444,#dc2626);
    color:white;
}

.modal-content button[type="button"]:hover{
    transform:translateY(-2px);
}

/* SCROLLBAR */
.modal-content::-webkit-scrollbar{
    width:8px;
}

.modal-content::-webkit-scrollbar-thumb{
    background:#3498db;
    border-radius:20px;
}

/* ANIMATIONS */
@keyframes pop{
    from{
        transform:scale(.85);
        opacity:0;
    }
    to{
        transform:scale(1);
        opacity:1;
    }
}

@keyframes fadeIn{
    from{opacity:0;}
    to{opacity:1;}
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
    top: 20px;     
    right: 20px;    

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

.status-badge {
    padding: 6px 12px;
    border-radius: 20px; 
    font-size: 12px;
    font-weight: 600;
    color: white;
    display: inline-block;
    text-transform: capitalize;
}

/* ACTIVE = GREEN */
.status-badge.active {
    background: linear-gradient(135deg, #22c55e, #16a34a);
}

.status-badge.inactive {
    background: linear-gradient(135deg, #ef4444, #dc2626);
}

.header-actions{
    display:flex;
    align-items:center;
    gap:10px;
}

#searchInput{
    padding:10px 15px;
    width:250px;
    border:1px solid #ddd;
    border-radius:8px;
    outline:none;
    font-size:14px;
}

#searchInput:focus{
    border-color:#3498db;
    box-shadow:0 0 5px rgba(52,152,219,.3);
}

/* PAGINATION */
.pagination-box{
    margin-top:25px;
    display:flex;
    justify-content:center;
}

.pagination-box nav{
    width:100%;
}

.pagination-box nav > div:first-child{
    display:none;
}

.pagination-box nav > div:last-child{
    display:flex;
    justify-content:center;
}

.pagination-box ul{
    display:flex;
    gap:8px;
    list-style:none;
    padding:0;
    margin:0;
}

.pagination-box li{
    display:inline-flex;
}

.pagination-box a,
.pagination-box span{
    min-width:40px;
    height:40px;
    padding:0 14px;

    display:flex;
    align-items:center;
    justify-content:center;

    border:1px solid #ddd;
    border-radius:8px;
    background:white;
    text-decoration:none;
    color:#333;
}

.pagination-box a:hover{
    background:#3498db;
    color:white;
}

.pagination-box .active span{
    background:#3498db;
    color:white;
    border-color:#3498db;
}

.pagination-box .disabled span{
    opacity:.5;
}

.pagination-box svg{
    width:16px;
    height:16px;
}

.table-box table {
    background: transparent !important;
}

.table-box th {
    background: rgba(255,255,255,0.1) !important;
    color: rgba(255,255,255,0.85) !important;
    border: none !important;
}

.table-box tr {
    background: rgba(255,255,255,0.06) !important;
}

.table-box td {
    color: white !important;
    border: none !important;
}

.table-box tr:hover {
    background: rgba(255,255,255,0.12) !important;
}

.table-box table {
    border-collapse: separate !important;
    border-spacing: 0 10px !important;
}

.table-box tr {
    box-shadow:
        0 6px 15px rgba(0,0,0,0.25),
        inset 0 1px 0 rgba(255,255,255,0.15);
    transition: 0.2s ease;
}

.table-box tr:hover {
    transform: translateY(-3px);
}
</style>

<div class="table-box">

<div class="header-container">
    <div class="header-bar">

        <h2>Supplier Management</h2>

        <div class="header-actions">

            <input type="text"
                   id="searchInput"
                   placeholder="Search supplier..."
                   onkeyup="searchSupplier()">

            <button class="add-btn" onclick="openAddModal()">
                ➕ Add Supplier
            </button>

        </div>

    </div>
</div>


<!-- TABLE -->
<div class="table-box">

    <table>

        <tr>
            <th>ID</th>
            <th>Supplier Name</th>
            <th>Category</th>
            <th>Product/Service</th>
            <th>Rating</th>
            <th>Status</th>
            <th>Payment Terms</th>
            <th>Payment Method</th>
            <th>Contact</th>
            <th>Phone</th>
            <th>Email</th>
            <th>Contract Start</th>
            <th>Contract End</th>
            <th>Actions</th>
        </tr>

        @foreach($suppliers as $supplier)

        <tr>
            <td>{{ $suppliers->firstItem() + $loop->index }}</td>
            <td>{{ $supplier->name }}</td>
            <td>{{ $supplier->category }}</td>
            <td>{{ $supplier->product_service }}</td>
            <td>{{ $supplier->rating }}</td>

            <td>
                <span class="status-badge {{ $supplier->status }}">
                    {{ ucfirst($supplier->status) }}
                </span>
            </td>

            <td>{{ $supplier->payment_terms }}</td>
            <td>{{ $supplier->payment_method }}</td>
            <td>{{ $supplier->primary_contact }}</td>
            <td>{{ $supplier->phone }}</td>
            <td>{{ $supplier->email }}</td>
            <td>{{ $supplier->contract_start }}</td>
            <td>{{ $supplier->contract_end }}</td>

            <td>

          <button class="btn-edit"
onclick="openEditModal(this)"

data-id="{{ $supplier->id }}"
data-name="{{ $supplier->name }}"
data-category="{{ $supplier->category }}"
data-product-service="{{ $supplier->product_service }}"
data-rating="{{ $supplier->rating }}"
data-primary-contact="{{ $supplier->primary_contact }}"
data-phone="{{ $supplier->phone }}"
data-email="{{ $supplier->email }}"
data-address="{{ $supplier->address }}"
data-payment-terms="{{ $supplier->payment_terms }}"
data-payment-method="{{ $supplier->payment_method }}"
data-status="{{ $supplier->status }}"
data-contract-start="{{ $supplier->contract_start }}"
data-contract-end="{{ $supplier->contract_end }}">

Edit
</button>

                <button class="btn-delete"
                        onclick="openDeleteModal({{ $supplier->id }})">
                    Delete
                </button>

            </td>
        </tr>

        @endforeach

    </table>

    <div class="pagination-box">
        {{ $suppliers->onEachSide(1)->links('pagination::simple-bootstrap-5') }}
    </div>

</div>
</div>  


<!-- ADD MODAL -->
<div id="addModal" class="modal">
    <div class="modal-content">

        <form method="POST" action="{{ route('supplier.add') }}">
            @csrf

            <h3>Add Supplier</h3>

            <label>Supplier Name</label>
            <input type="text" name="name" required>

            <label>Category</label>
            <input type="text" name="category">

            <label>Product / Service</label>
            <input type="text" name="product_service">

            <label>Rating</label>
            <input type="number" min="1" max="5" name="rating">

            <label>Primary Contact</label>
            <input type="text" name="primary_contact">

            <label>Phone</label>
            <input type="text" name="phone" maxlength="11">

            <label>Email</label>
            <input type="email" name="email">

            <label>Address</label>
            <input type="text" name="address">

            <label>Payment Terms</label>
            <input type="text" name="payment_terms">

            <label>Payment Method</label>
            <input type="text" name="payment_method">

            <label>Status</label>
            <select name="status">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>

            <label>Contract Start</label>
            <input type="date" name="contract_start">

            <label>Contract End</label>
            <input type="date" name="contract_end">

            <div class="button-group">
                <button type="submit">Save</button>
                <button type="button" onclick="closeAddModal()">Cancel</button>
            </div>

        </form>

    </div>
</div>


<!-- EDIT MODAL -->
<div id="editModal" class="modal">
    <div class="modal-content">

        <form method="POST" id="editForm">
            @csrf
            @method('PUT')

            <h3>Edit Supplier</h3>

            <input type="hidden" name="id" id="edit_id">

            <label>Name</label>
            <input type="text" name="name" id="edit_name">

            <label>Category</label>
            <input type="text" name="category" id="edit_category">

            <label>Product / Service</label>
            <input type="text" name="product_service" id="edit_product_service">

            <label>Rating</label>
            <input type="number" name="rating" id="edit_rating">

            <label>Primary Contact</label>
            <input type="text" name="primary_contact" id="edit_primary_contact">

            <label>Phone</label>
            <input type="text" name="phone" id="edit_phone">

            <label>Email</label>
            <input type="email" name="email" id="edit_email">

            <label>Payment Terms</label>
            <input type="text" name="payment_terms" id="edit_payment_terms">

            <label>Payment Method</label>
            <input type="text" name="payment_method" id="edit_payment_method">

            <label>Status</label>
            <select name="status" id="edit_status">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>

            <label>Contract Start</label>
            <input type="date" name="contract_start" id="edit_contract_start">

            <label>Contract End</label>
            <input type="date" name="contract_end" id="edit_contract_end">

            <div class="button-group">
                <button type="submit">Update</button>
                <button type="button" onclick="closeEditModal()">Cancel</button>
            </div>

        </form>

    </div>
</div>


<!-- DELETE MODAL -->
<div id="deleteModal" class="modal">
    <div class="modal-content">

        <h3>Delete Supplier?</h3>

        <form method="POST" id="deleteForm">
            @csrf
            @method('DELETE')

            <div class="button-group">
                <button type="submit">Yes Delete</button>
                <button type="button" onclick="closeDeleteModal()">Cancel</button>
            </div>

        </form>

    </div>
</div>


<div id="toast"></div>


<script>

// =========================
// ADD MODAL
// =========================
function openAddModal() {
    document.getElementById("addModal")
        .classList.add("show");

    document.body.style.overflow = "hidden";
}

function closeAddModal() {
    document.getElementById("addModal")
        .classList.remove("show");

    document.body.style.overflow = "auto";
}


// =========================
// EDIT MODAL
// =========================
function openEditModal(btn){

    document.getElementById("editModal")
        .classList.add("show");

    document.body.style.overflow = "hidden";

    // update form action
    document.getElementById("editForm").action =
        "/supplier/" + btn.dataset.id;

    // fill fields
    document.getElementById("edit_id").value =
        btn.dataset.id || "";

    document.getElementById("edit_name").value =
        btn.dataset.name || "";

    document.getElementById("edit_category").value =
        btn.dataset.category || "";

    document.getElementById("edit_product_service").value =
        btn.dataset.productService || "";

    document.getElementById("edit_rating").value =
        btn.dataset.rating || "";

    document.getElementById("edit_primary_contact").value =
        btn.dataset.primaryContact || "";

    document.getElementById("edit_phone").value =
        btn.dataset.phone || "";

    document.getElementById("edit_email").value =
        btn.dataset.email || "";

    document.getElementById("edit_address").value =
        btn.dataset.address || "";

    document.getElementById("edit_payment_terms").value =
        btn.dataset.paymentTerms || "";

    document.getElementById("edit_payment_method").value =
        btn.dataset.paymentMethod || "";

    document.getElementById("edit_status").value =
        btn.dataset.status || "";

    document.getElementById("edit_contract_start").value =
        btn.dataset.contractStart || "";

    document.getElementById("edit_contract_end").value =
        btn.dataset.contractEnd || "";
}

function closeEditModal(){

    document.getElementById("editModal")
        .classList.remove("show");

    document.body.style.overflow = "auto";
}


// =========================
// DELETE MODAL
// =========================
function openDeleteModal(id){

    document.getElementById("deleteModal")
        .classList.add("show");

    document.getElementById("deleteForm").action =
        "/supplier/" + id;

    document.body.style.overflow = "hidden";
}

function closeDeleteModal(){

    document.getElementById("deleteModal")
        .classList.remove("show");

    document.body.style.overflow = "auto";
}


// =========================
// SEARCH
// =========================
function searchSupplier(){

    let input =
        document.getElementById("searchInput")
        .value.toLowerCase();

    let rows =
        document.querySelectorAll("table tr");

    rows.forEach((row,index)=>{

        if(index===0) return;

        let text =
            row.innerText.toLowerCase();

        row.style.display =
            text.includes(input)
            ? ""
            : "none";

    });
}


// =========================
// TOAST
// =========================
function showToast(message,type){

    let toast =
        document.getElementById("toast");

    toast.innerHTML = message;

    toast.className = "show";

    if(type==="success"){
        toast.classList.add("toast-success");
    }

    if(type==="error"){
        toast.classList.add("toast-error");
    }

    setTimeout(()=>{

        toast.className = "";

    },3000);
}

</script>

@if(session('success'))
<script>
showToast(@json(session('success')), "success");
</script>
@endif

@if(session('error'))
<script>
showToast(@json(session('error')), "error");
</script>
@endif




@endsection