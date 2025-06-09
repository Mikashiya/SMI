<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NeoTeam</title>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>

    body{
        background-color: #f8f8f8;
        margin: 0;
    }

    .btn{
        bottom: 2.5%;
        right: 1.5%;
        position: fixed;
        display: flex;
        gap: 10px;
        z-index: 2;
    }

    .btn span{
        width: 3vh;
        background-color: #7B95F9;
        padding: 5px;
        transition: .5s;
    }

    .btn span:hover{
        background-color: #1f1f1f;
    }

    .btn i{
        color: #f8f8f8;
    }

    .side-nav{
        left: -35vh;
        position: fixed;
        height: 100vh;
        width: 30vh;
        background-color: #f8f8f8;
        border-right: #969696 3px solid;
        padding-left: 5vh;
        padding-bottom: 5vh;
        padding-top: 5vh;
        z-index: 1;
        transition: .5s;
    }

    .side-nav h4{
        color: #424242;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        padding-top: 2vh;
    }

    .side-nav-links span{
        display: flex;
        margin-top: 1vh;
        margin-left: 2vh;
        max-width: 22vh;
        padding: 5px;
        border-radius: 10px;
        transition: .5s;
    }

    .side-nav-links span:hover{
        background-color: rgba(107, 107, 107, 0.3);
    }

    .side-nav-links i{
        color: #7B95F9;
    }

    .side-nav-links a{
        text-decoration: none;
        color: #424242;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        margin-left: 1vh;
    }

    .side-nav-links form{
        margin-left: 1vh;
    }

    .side-nav-links select{
        border: none;
        background-color: transparent;
        color: #424242;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: medium;
        cursor: pointer;
    }

    .side-nav img{
        max-width: 50%;
        margin-bottom: 5vh;
    }

    .active{
        background-color: rgba(107, 107, 107, 0.3);
    }

    .main{
        height: auto;
        position: absolute;
        transition: .5s;
    }

    .top-nav{
        height: 5vh;
        width: 100%;
        border-bottom: #969696 3px solid;
    }

    .top-nav h3{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        color: #7B95F9;
        margin-left: 2.5vh;
    }

    .top-nav a{
        text-decoration: none;
        color: #7B95F9;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        right: 0;
        top: 2.5vh;
        margin-right: 5vh;
        position: absolute;
        transition: .25s;
        z-index: 1;
    }

    .top-nav a:hover{
        color: #1f1f1f;
    }

    .header{
        margin-top: 5vh;
        display: flex;
    }

    .header h4{
        color: #424242;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        margin-left: 2.5vh;
    }

    .header button{
        padding: 5px;
        right: 1.5%;
        position: absolute;
        margin-top: 2vh;
        background-color: #ebebeb;
        border: #424242 1px solid;
        cursor: pointer;
        transition: .5s;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        z-index: 1;
    }

    .header button:hover{
        box-shadow: 4px 4px #424242;
    }

    .table-sect{
        margin-top: 10vh;
        max-width: 100%;
        max-height: 50vh;
        overflow: auto;
        margin-left: 3px;
        margin-bottom: 10vh;
        white-space: nowrap;
    }

    .table-sect table{
        border: #969696 2px solid;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        color: #424242;
        width: 200%;
        height: 100%;
        gap: 0;
    }

    .table-sect th{
       background-color: #7B95F9;
       position: sticky;
       overflow-y: auto;
       z-index: 1;
       top: 0;
       height: 3vh;
    }

    .table-sect th:nth-child(1){
        width: 6vh;
    }

    .table-sect th:nth-child(8), .table-sect th:nth-child(9), .table-sect th:nth-child(10){
        width: 15vh;
    }

    .table-sect th:nth-child(2){
        width: 10vh;
    }

    .table-sect th:nth-child(11){
        width: 20vh;
     }

    .table-sect th:nth-child(3), .table-sect th:nth-child(5), .table-sect th:nth-child(6){
        width: 30vh;
    }

    .table-sect th:nth-child(4), .table-sect th:nth-child(7){
        width: 50vh;
    }

    .table-sect tbody{
        counter-reset: rowNumber;
    }

    .table-sect tbody tr td:first-child::before{
        content: counter(rowNumber);
        counter-increment: rowNumber;
    }

    .table-sect tbody button{
        padding: 5px;
        background-color: transparent;
        border: none;
        cursor: pointer;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .table-sect td{
       border: #969696 1px solid;
       padding: 5px;
       cursor: pointer;
       text-align: center;
       background-color: #f8f8f8;
    }

    .table-sect td i{
        padding: 5px; 
        color: #f8f8f8; 
        border-radius: 5px;
    }

    .table-sect td span{
        display: flex; 
        max-height: 3vh;
        padding: 5px;
        transition: .5s;
        border-radius: 5px;
    }

    .table-sect td span:hover{
        background-color: rgba(107, 107, 107, 0.3);
    }

    .table-sect td a{
        color: #424242;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        text-decoration: none;
        padding: 3px;
    }

    .table-sect h4{
        color: #424242;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        margin-left: 2.5vh;
    }

    .overlay{
        display: none;
        position: fixed;
        width: 50vh;
        max-height: 100%;
        top: 0;
        right: 0;
        background-color: #ebebeb;
        z-index: 2;
        overflow: auto;
        border-left: #969696 3px solid;
        opacity: 0;
        transition: all .5s;
    }

    .overlay-top{
        height: 5vh;
        display: block;
        margin-bottom: 5vh;
        position: sticky;
        top: 0;
        background-color: #ebebeb;
        padding: 5px;
    }

    .overlay-top h3{
        float: left;
        color: #424242;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .overlay-top i{
        color: #424242;
        top: 2vh;
        right: 2.5vh;
        position: absolute;
        padding: 5px;
        border-radius: 2px;
        transition: .5s;
        cursor: pointer;
    }

    .overlay-top i:hover{
        background-color: rgba(107, 107, 107, 0.3);
    }

    .overlay-main{
        display: block;
        height: auto;
        margin-bottom: 3vh;
        padding: 5px;
        border-radius: 3px;
        background-color: #f8f8f8;
    }

    .overlay-main span{
        margin: .5vh;
    }

    .overlay-main h4{
        color: #424242;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .overlay-main p{
        color: #424242;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        text-align: justify;
        width: 95%;
    }

    .overlay-note{
        height: auto;
        display: block;
    }

    .part-out{
        padding: 5px;
        border-radius: 3px;
        background-color: #f8f8f8;
        margin-bottom: 3vh;
    }

    .part-in{
        padding: 5px;
        border-radius: 3px;
        background-color: #f8f8f8;
        margin-bottom: 3vh;
    }

    .overlay-note span{
        margin: .5vh;
    }

    .overlay-note h3{
        color: #424242;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .overlay-note h4{
        color: #424242;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .overlay-note p{
        color: #424242;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
    
    .filter-icon{
        cursor: pointer;
        padding-left: 8px;
    }

    .filter-overlay{
        top: 19%;
        width: 100%;
        position: fixed;
        display: none;
        background-color: #ebebeb;
        border: #969696 2px solid;
        padding: 5px;
        z-index: 1;
        box-shadow: #969696;
        margin-left: 3px;
    }

    .filter-overlay p{
        color: #424242;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .filter-overlay input{
        width: 30vh;
        padding: 5px;
    }

    .custom-font{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
</style>
<body>
    <div class="btn">
        <div><span><i class="fas fa-angle-left" onclick="closeNav()"></i></span></div>
        <div><span><i class="fas fa-angle-right" onclick="openNav()"></i></span></div>
    </div>
    <section>
        <div class="side-nav" id="side-nav">
            <div>
                <img src="{{asset('logo.png')}}" alt="Logo">
                <div class="side-nav-links">
                    <span><i class="fas fa-home"></i><a href="{{route('leader.dashboard')}}"> Dashboard</a></span>
                </div>
                <div class="side-nav-links">
                    <h4>Manajemen Sparepart</h4>
                    <span class="active"><i class="fas fa-list"></i>
                        <form method="GET" action="{{route('leader.listspareparts')}}">
                            <select name="id_whlocs" onchange="this.form.submit()">
                                <option value="all" disabled selected>List Spareparts</option>
                                @foreach ($plants as $plant)
                                    <option value="{{ $plant->id_whlocs }}">{{ $plant->location }}</option>
                                @endforeach
                            </select>
                        </form>
                    </span>
                    <span><i class="fas fa-file-signature"></i><a href="{{route('leader.registparts')}}"> Register Sparepart</a></span>
                </div>
                <div class="side-nav-links">
                    <h4>Manajemen Warehouse</h4>
                    <span><i class="fas fa-warehouse"></i><a href="{{route('leader.listwarehouses')}}"> List Warehouse</a></span>
                </div>
                <div class="side-nav-links">
                    <h4>Manajemen Supplier</h4>
                    <span><i class="fas fa-users"></i><a href="#"> List Supplier</a></span>
                    <span><i class="fas fa-user-plus"></i><a href="#"> Register Supplier</a></span>
                </div>
                <div class="side-nav-links">
                    <h4>Aktivitas</h4>
                    <span><i class="fas fa-file-alt"></i><a href="#"> Audit</a></span>
                    <span><i class="fas fa-calendar-alt"></i><a href="#"> Laporan Harian</a></span>
                </div>
            </div>
        </div>
    </section>
    <section class="main" id="main">
        <div class="top-nav">
            <h3>Hello Leader</h3>
            <a href="#">Keluar</a>
        </div>
        <div class="header" id="plantId">
            <h4>List Spareparts {{ $plants->firstWhere('id_whlocs', request('id_whlocs'))?->location ?? 'All Plants' }}</h4>
            <button onclick="resetFilters()">Reset Filter</button>
        </div>
        @foreach($plants as $plant)
            @if(request('id_whlocs') == 'all' || request('id_whlocs') == $plant->id_whlocs)
                <div class="table-sect">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    No
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(0)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Part ID
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(1)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Part Name
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(2)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Part Type
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(3)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    MFG
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(4)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Usage
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(5)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Note
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(6)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Stock Balance
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(7)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Safety Stock
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(8)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Reminder
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(9)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allocations->where('warehouses.id_whlocs', $plant->id_whlocs) as $parts)
                                <tr>
                                    <td onclick="overlayOn('{{ $parts->id_alct }}')"></td>
                                    <td onclick="overlayOn('{{ $parts->id_alct }}')">{{ $parts->id_alct }}</td>
                                    <td onclick="overlayOn('{{ $parts->id_alct }}')">{{ optional($parts->spareparts)->part_name ?? 'Not Found' }}</td>
                                    <td onclick="overlayOn('{{ $parts->id_alct }}')">{{ optional($parts->spareparts)->part_type ?? 'Not Found' }}</td>
                                    <td onclick="overlayOn('{{ $parts->id_alct }}')">{{ optional($parts->spareparts)->mfg ?? 'Not Found' }}</td>
                                    <td onclick="overlayOn('{{ $parts->id_alct }}')">{{ $parts->usage }}</td>
                                    <td onclick="overlayOn('{{ $parts->id_alct }}')">{{ $parts->note }}</td>
                                    <td onclick="overlayOn('{{ $parts->id_alct }}')">{{ $parts->e_stock }}</td>
                                    <td onclick="overlayOn('{{ $parts->id_alct }}')">{{ $parts->s_stock }}</td>
                                    <td onclick="overlayOn('{{ $parts->id_alct }}')">{{ $parts->reminder }}</td>
                                    <td style="cursor:default;">
                                        <span style="float: left;">
                                            <i class="fas fa-pencil-alt" style="background-color: #48ff00;"></i>
                                            <form action="{{ route('parts.edit', $parts->id_alct) }}" method="GET">
                                                <button type="submit">Edit</button>
                                            </form>
                                        </span>
                                        <span style="float: right;">
                                            <i class="fas fa-trash" style="background-color: #ff0000;"></i>
                                            <form action="{{ route('parts.destroy', $parts->id_alct) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="delete-btn" data-id="{{ $parts->id_alct }}">Hapus</button>
                                            </form>
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <td colspan="11">Empty</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif
        @endforeach
        <div>
            <div class="filter-overlay" id="filter-0">
                <p>No:</p><input type="text" placeholder="Input.." onkeyup="filterTable(0, this.value)">
            </div>
            <div class="filter-overlay" id="filter-1">
                <p>Part ID:</p><input type="text" placeholder="Input.." onkeyup="filterTable(1, this.value)">
            </div>
            <div class="filter-overlay" id="filter-2">
                <p>Part Name:</p><input type="text" placeholder="Input.." onkeyup="filterTable(2, this.value)">
            </div>
            <div class="filter-overlay" id="filter-3">
                <p>Part Type:</p><input type="text" placeholder="Input.." onkeyup="filterTable(3, this.value)">
            </div>
            <div class="filter-overlay" id="filter-4">
                <p>Manufacturing:</p><input type="text" placeholder="Input.." onkeyup="filterTable(4, this.value)">
            </div>
            <div class="filter-overlay" id="filter-5">
                <p>Usage:</p><input type="text" placeholder="Input.." onkeyup="filterTable(5, this.value)">
            </div>
            <div class="filter-overlay" id="filter-6">
                <p>Note:</p><input type="text" placeholder="Input.." onkeyup="filterTable(6, this.value)">
            </div>
            <div class="filter-overlay" id="filter-7">
                <p>Stock Balance:</p><input type="text" placeholder="Input.." onkeyup="filterTable(7, this.value)">
            </div>
            <div class="filter-overlay" id="filter-8">
                <p>Safety Stock:</p><input type="text" placeholder="Input.." onkeyup="filterTable(8, this.value)">
            </div>
            <div class="filter-overlay" id="filter-9">
                <p>Reminder:</p><input type="text" placeholder="Input.." onkeyup="filterTable(9, this.value)">
            </div>
        </div>
        <div class="overlay" id="overlay">
            <div class="overlay-top">
                <h3>Spareparts Information <span id="wh_loc"></span></h3>
                <i class="fas fa-close" onclick="overlayOff()"></i>
            </div>
            <div class="overlay-main">
                <span><h4>Part ID: </h4><p><span id="part_id"></span></p></span>
                <span><h4>Part Name: </h4><p><span id="part_name"></span></p></span>
                <span><h4>Part Type: </h4><p><span id="part_type"></span></p></span>
                <span><h4>Manufacturing: </h4><p><span id="mfg"></span></p></span>
                <span><h4>Part Usage: </h4><p><span id="usage"></span></p></span>
                <span><h4>Note: </h4><p><span id="note"></span></p></span>
                <span><h4>Part Location: </h4><p><span>Warehouse</span><span id="wh_type"></span></p></span>
                <span><h4>Inbound Stock: </h4><p><span id="f_stock"></span></p></span>
                <span><h4>Stock Balance: </h4><p><span id="e_stock"></span></p></span>
                <span><h4>Safety Stock: </h4><p><span id="s_stock"></span></p></span>
                <span><h4>Reminder: </h4><p><span id="reminder"></span></p></span>
                <span><h4>Price Per Quantity: </h4><p><span id="price"></span></p></span>
                <span><h4>Supplier: </h4><p><span id="spl_name"></span></p></span>
            </div>
            <div class="overlay-note">
                <h3>Part Movement Information</h3>
                <div class="part-out">
                    <h4>Part Out</h4>
                    <span><h4>Last Date Out: </h4><p></p></span>
                    <span><h4>Stock Out: </h4><p></p></span>
                    <span><h4>Part Usage: </h4><p></p></span>
                    <span><h4>PIC WH: </h4><p></p></span>
                    <span><h4>PIC Maintenance/Genba: </h4><p></p></span>
                    <span><h4>Note: </h4><p></p></span>
                </div>
                <div class="part-in">
                    <h4>Part In</h4>
                    <span><h4>Last Date In: </h4><p></p></span>
                    <span><h4>Stock In: </h4><p></p></span>
                    <span><h4>Part Usage: </h4><p></p></span>
                    <span><h4>PIC WH: </h4><p></p></span>
                    <span><h4>PIC Order Request: </h4><p></p></span>
                    <span><h4>Note: </h4><p></p></span>
                    <span><h4>Price: </h4><p></p></span>
                    <span><h4>Supplier: </h4><p></p></span>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
    <script>
        Swal.fire({
            title: "SUCCESS",
            text: "{{ session('success') }}",
            icon: "success",
            timer: 3000,
            showConfirmButton: false,
            customClass:{
                popup: 'custom-font'
            }
        });
    </script>
    @php session()->forget('success'); @endphp
@endif
<script>
    function openNav(){
        document.getElementById("side-nav").style.left = "0";
        document.getElementById("main").style.left = "35vh";
    }

    function closeNav(){
        document.getElementById("side-nav").style.left = "-35vh";
        document.getElementById("main").style.left = "0";
    }
    
    function overlayOn(id_alct) {
        fetch(`/parts/${id_alct}`)
            .then(response => response.json()) // Bukan `.json()` untuk melihat isi asli
            .then(data => {
                document.getElementById("part_id").textContent = data.id_alct;
                document.getElementById("part_name").textContent = data.spareparts.part_name;
                document.getElementById("part_type").textContent = data.spareparts.part_type;
                document.getElementById("mfg").textContent = data.spareparts.mfg;
                document.getElementById("usage").textContent = data.usage;
                document.getElementById("note").textContent = data.note;
                document.getElementById("wh_type").textContent = data.warehouses.wh_type;
                document.getElementById("f_stock").textContent = data.f_stock;
                document.getElementById("e_stock").textContent = data.e_stock;
                document.getElementById("s_stock").textContent = data.s_stock;
                document.getElementById("reminder").textContent = data.reminder;
                document.getElementById("price").textContent = "Rp. " + Number(data.spareparts.price).toLocaleString('id-ID', { minimumFractionDigits: 2 });
                document.getElementById("wh_loc").textContent = data.warehouses.whlocs.location;


                //console.log("Data asli dari API:", text); // Lihat apakah ini JSON valid atau HTML/error
            });
        
        let overlay = document.getElementById("overlay");

        overlay.style.display = "block"; // Pastikan elemen terlihat sebelum transisi
        setTimeout(() => {
            overlay.style.opacity = "1"; // Efek fade-in
        }, 200); // Delay sedikit agar transisi bisa aktif


        //console.log("Overlay sekarang seharusnya aktif!");
    }

    function plantId(id_whlocs){
        fetch(`/parts/${id_whlocs}`)
            .then(response => response.json()) // Bukan `.json()` untuk melihat isi asli
            .then(data => {
                document.getElementById("plant_id").textContent = data.location;

                //console.log("Data asli dari API:", text); // Lihat apakah ini JSON valid atau HTML/error
            });
    }

    function overlayOff() {
        let overlay = document.getElementById("overlay");

        overlay.style.opacity = "0"; // Buat efek fade-out lebih dulu

        setTimeout(() => {
            overlay.style.display = "none"; // Sembunyikan setelah transisi selesai
        }, 500); // Sesuaikan dengan durasi transition
    }

    function toggleFilter(index) {
        let overlay = document.getElementById(`filter-${index}`);

        // Cek apakah overlay sedang terlihat
        let isVisible = overlay.style.display === "block";

        // Tutup semua overlay dulu
        document.querySelectorAll(".filter-overlay").forEach(filter => {
            filter.style.display = "none";
        });

        // Jika overlay yang ditekan tadinya tertutup, maka buka kembali
        if (!isVisible) {
            let rect = event.target.getBoundingClientRect();
            overlay.style.display = "block";
        }
    }

    function filterTable(colIndex, value) {
        let table = document.querySelector("table");
        let rows = table.querySelectorAll("tbody tr");
        
        rows.forEach(row => {
            let cell = row.cells[colIndex];
            row.style.display = cell.textContent.toLowerCase().includes(value.toLowerCase()) ? "" : "none";
        });
    }

    function resetFilters() {
        // Kosongkan semua input filter
        document.querySelectorAll(".filter-overlay input").forEach(input => {
            input.value = "";
        });

        // Tampilkan kembali semua baris tabel
        document.querySelectorAll("tbody tr").forEach(row => {
            row.style.display = "";
        });

        // Tutup semua filter overlay
        document.querySelectorAll(".filter-overlay").forEach(filter => {
            filter.style.display = "none";
        });
    }

    document.querySelectorAll('.delete-btn').forEach(button => {
        //console.log("Event listener aktif!"); // Debug sebelum eksekusi
        button.addEventListener('click', function(event) {
            event.preventDefault();
            let partId = this.getAttribute('data-id');
            let form = this.closest("form");
            Swal.fire({
                title: "WARNING",
                html: `<p>Part ID <strong>${partId}</strong></p><p>Will be deleted permanently</p></p><p>Proceed with caution</p>`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Proceed",
                cancelButtonText: "Cancel",
                customClass:{
                    popup: 'custom-font'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Jalankan penghapusan menggunakan form
                }
            });
        });
    });
</script>
</html>