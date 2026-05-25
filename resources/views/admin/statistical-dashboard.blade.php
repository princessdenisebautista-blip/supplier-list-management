@extends('layouts.admin')

@section('content')

<style>

.content{
    margin-left:220px;
    min-height:100vh;
    display:block;
    padding:30px;
     background: linear-gradient(135deg, #0f172a, #1e293b, #0b1220);
}

.dashboard{
    width:95%;
    margin:auto;
}

/* TITLE */
.dashboard h2{
    margin-bottom:25px;
    color:white;
}

/* CARDS */
.cards{
    display:flex;
    gap:20px;
    flex-wrap:wrap;
    margin-bottom:30px;
}

.card {
    flex:1;
    min-width:220px;

    padding:20px;
    border-radius:16px;

    /* GLASS */
    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(12px);

    border: 1px solid rgba(255,255,255,0.15);

    /* 3D SHADOW */
    box-shadow:
        0 10px 25px rgba(0,0,0,0.25),
        0 4px 10px rgba(0,0,0,0.15),
        inset 0 1px 0 rgba(255,255,255,0.2);

    color:#fff;

    transition: 0.3s ease;
}

/* HOVER FLOAT EFFECT */
.card:hover {
    transform: translateY(-5px) scale(1.02);
    box-shadow:
        0 20px 40px rgba(0,0,0,0.35),
        0 10px 20px rgba(0,0,0,0.2),
        inset 0 1px 0 rgba(255,255,255,0.25);
}

.card h3 {
    color: rgba(255,255,255,0.7);
}

.card p {
    color: white;
    font-size: 34px;
    font-weight: bold;
    margin-top: 10px;
}

/* CHART */
.chart-container{
    margin-bottom:30px;
}

.chart-box{
    background:white;
    padding:20px;
    border-radius:12px;
    box-shadow:0 2px 10px rgba(0,0,0,.1);

    width:700px;
    max-width:100%;
}

.chart-wrapper{
    width:300px;
    height:300px;
    margin:auto;
}

#supplierList{
    list-style:none;
    padding:0;
}

#supplierList li{
    padding:10px;
    margin-bottom:8px;
    background:#f5f5f5;
    border-radius:8px;
}

/* smaller chart size */
#supplierChart{
    width:300px !important;
    height:300px !important;
    margin:auto;
}

/* supplier list after clicking chart */
#supplierList{
    margin-top:20px;
    border-top:1px solid #ddd;
    padding-top:15px;
}

.list-item{
    padding:10px;
    border-bottom:1px solid #eee;
}

.list-item:hover{
    background:#f5f5f5;
}

.chart-box table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0 10px; /* space between rows */
}

.chart-box th {
    background: rgba(255,255,255,0.1);
    backdrop-filter: blur(8px);

    color: rgba(255,255,255,0.8);
    padding: 12px;

    text-align: left;
    font-weight: 600;

    border: none;
}

.chart-box td {
    padding: 14px;
    border: none;
}

/* each row becomes a "mini card" */
.chart-box tr {
    background: rgba(255,255,255,0.06);
    backdrop-filter: blur(8px);

    box-shadow:
        0 6px 15px rgba(0,0,0,0.2),
        inset 0 1px 0 rgba(255,255,255,0.15);

    border-radius: 10px;
    transition: 0.2s ease;
}

/* round corners for row */
.chart-box tr td:first-child {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
}

.chart-box tr td:last-child {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
}

.empty-text {
    text-align: center;
    color: rgba(255,255,255,0.6);
}

/* RESPONSIVE */
@media(max-width:768px){

.cards{
    flex-direction:column;
}

}

.dashboard-row{
    display:flex;
    gap:20px;
    align-items:flex-start;
    margin-bottom:30px;
    flex-wrap:wrap;
}

.chart-box {
    flex:1;
    min-width:400px;

    background: rgba(255,255,255,0.08);
    backdrop-filter: blur(12px);

    padding:20px;
    border-radius:16px;

    border: 1px solid rgba(255,255,255,0.15);

    box-shadow:
        0 10px 25px rgba(0,0,0,0.25),
        inset 0 1px 0 rgba(255,255,255,0.2);

    color:white;
}

.chart-wrapper{
    width:280px;
    height:280px;
    margin:auto;
}

/* mobile */
@media(max-width:768px){

.dashboard-row{
    flex-direction:column;
}

}

</style>


<div class="dashboard">

<h2>📊 Statistical Dashboard</h2>


<div class="cards">

<div class="card">
<h3>Total Users</h3>
<p>{{ $totalUsers }}</p>
</div>


<div class="card">
<h3>Total Suppliers</h3>
<p>{{ $totalSuppliers }}</p>
</div>


<div class="card">
<h3>Active Suppliers</h3>
<p>{{ $activeSuppliers }}</p>
</div>


<div class="card">
<h3>Inactive Suppliers</h3>
<p>{{ $inactiveSuppliers }}</p>
</div>


</div>


<div class="dashboard-row">

    <!-- PIE CHART -->
    <div class="chart-box">

        <h3>Supplier Status Distribution</h3>

        <div class="chart-wrapper">
            <canvas id="supplierChart"></canvas>
        </div>

        <div id="supplierListBox"
             style="display:none;margin-top:20px;">

            <h4 id="listTitle"></h4>

            <table>
                <thead>
                    <tr>
                        <th>Supplier Name</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody id="supplierListBody"></tbody>

            </table>

        </div>

    </div>


    <!-- CONTRACT EXPIRATION -->
    <div class="chart-box">

        <h3> Contracts Expiring in 30 Days</h3>

        <table>

        <tr>
            <th>Supplier Name</th>
            <th>Contract End</th>
        </tr>

        @forelse($expiringContracts as $supplier)

        <tr>
            <td>{{ $supplier->name }}</td>
            <td>{{ $supplier->contract_end }}</td>
        </tr>

        @empty

        <tr>
            <td colspan="2"
            class="empty-text">

            No contracts expiring soon

            </td>
        </tr>

        @endforelse

        </table>

    </div>

</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>



<script>

// supplier arrays from Laravel
let activeSupplierList = [
@foreach($suppliers->where('status','active') as $supplier)
{
    name:"{{ $supplier->name }}",
    status:"Active"
},
@endforeach
];

let inactiveSupplierList = [
@foreach($suppliers->where('status','inactive') as $supplier)
{
    name:"{{ $supplier->name }}",
    status:"Inactive"
},
@endforeach
];

const ctx =
document.getElementById(
'supplierChart'
);

const chart = new Chart(ctx,{

    type:'pie',

    data:{
        labels:[
            'Active Suppliers',
            'Inactive Suppliers'
        ],

        datasets:[{
            data:[
                {{ $activeSuppliers }},
                {{ $inactiveSuppliers }}
            ],

            backgroundColor:[
                '#2ecc71',
                '#e74c3c'
            ]
        }]
    },

    options:{
        responsive:true,

        plugins:{
            legend:{
    position:'bottom',

    labels:{
        color:'#ffffff',   // makes text white
        font:{
            size:14,
            weight:'bold'
        }
    }
}
        },

        onClick:function(event,elements){

            if(elements.length>0){

                let index=
                elements[0].index;

                let listBox=
                document.getElementById(
                "supplierListBox"
                );

                let title=
                document.getElementById(
                "listTitle"
                );

                let body=
                document.getElementById(
                "supplierListBody"
                );

                body.innerHTML="";

                let suppliers=[];

                if(index===0){

                    title.innerHTML=
                    "🟢 Active Suppliers";

                    suppliers=
                    activeSupplierList;

                }else{

                    title.innerHTML=
                    "🔴 Inactive Suppliers";

                    suppliers=
                    inactiveSupplierList;
                }

                suppliers.forEach(item=>{

                    body.innerHTML += `
                    <tr>
                        <td style="padding:10px">
                            ${item.name}
                        </td>

                        <td style="padding:10px">
                            ${item.status}
                        </td>
                    </tr>
                    `;

                });

                listBox.style.display=
                "block";
            }

        }

    }

});

</script>


</script>

@endsection