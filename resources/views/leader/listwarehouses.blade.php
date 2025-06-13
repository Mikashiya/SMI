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

    .top-nav button{
        text-decoration: none;
        color: #7B95F9;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        right: 0;
        top: 2.3%;
        margin-right: 5vh;
        position: fixed;
        transition: .25s;
        background-color: transparent;
        border: none;
        font-size: 15px;
        cursor: pointer;
    }

    .top-nav button:hover{
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
       z-index: 0;
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
                    <span><i class="fas fa-list"></i>
                        <form method="GET" action="{{route('parts.index')}}">
                            <select name="id_whlocs" onchange="this.form.submit()">
                                <option value="all" disabled selected>List Spareparts</option>
                                @foreach ($plants as $plant)
                                    <option value="{{ $plant->id_whlocs }}">{{ $plant->location }}</option>
                                @endforeach
                            </select>
                        </form>
                    </span>
                    <span><i class="fas fa-file-signature"></i><a href="{{route('parts.create')}}"> Register Sparepart</a></span>
                </div>
                <div class="side-nav-links">
                    <h4>Manajemen Warehouse</h4>
                    <span class="active"><i class="fas fa-warehouse"></i><a href="{{route('wh.index')}}"> List Warehouse</a></span>
                    <span><i class="fas fa-plus"></i><a href="{{route('wh.create')}}"> Register Warehouse</a></span>
                </div>
                <div class="side-nav-links">
                    <h4>Manajemen Supplier</h4>
                    <span><i class="fas fa-users"></i><a href="{{route('supplier.index')}}"> List Supplier</a></span>
                    <span><i class="fas fa-user-plus"></i><a href="{{route('supplier.create')}}"> Register Supplier</a></span>
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
            <h3>Hello Leader ID: {{ Auth::user()->username }}</h3>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
        <div class="header" id="plantId">
            <h4>List Warehouses {{ $plants->firstWhere('id_whlocs', request('id_whlocs'))?->location ?? 'All Plants' }}</h4>
            <button onclick="resetFilters()">Reset Filter</button>
        </div>
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
                            Plant Location
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(1)"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            Warehouse Type
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(2)"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            Shelf Counts
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(3)"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            Shelf IDs/Names
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(4)"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            Cabinet Counts
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(5)"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            Cabinet IDs/Names
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(6)"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            Capacity
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(7)"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            Temperature Control
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(8)"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($warehouses as $wh)
                        <tr>
                            <td onclick="overlayOn('{{ $wh->id_wh }}')"></td>
                            <td onclick="overlayOn('{{ $wh->id_wh }}')">{{ optional($wh->whlocs)->location ?? 'Not Found' }}</td>
                            <td onclick="overlayOn('{{ $wh->id_wh }}')">{{ $wh->wh_type }}</td>
                            <td onclick="overlayOn('{{ $wh->id_wh }}')">{{ $wh->shelf_count }}</td>
                            <td onclick="overlayOn('{{ $wh->id_wh }}')">{{ $wh->shelf_ids }}</td>
                            <td onclick="overlayOn('{{ $wh->id_wh }}')">{{ $wh->cabs_count }}</td>
                            <td onclick="overlayOn('{{ $wh->id_wh }}')">{{ $wh->cabs_ids }}</td>
                            <td onclick="overlayOn('{{ $wh->id_wh }}')">{{ $wh->capacity }} Items</td>
                            <td onclick="overlayOn('{{ $wh->id_wh }}')">{{ $wh->temp_ctrl }}</td>
                            <td style="cursor:default;">
                                <span style="float: left;">
                                    <i class="fas fa-pencil-alt" style="background-color: #48ff00;"></i>
                                    <form action="{{ route('wh.edit', $wh->id_wh) }}" method="GET">
                                        <button type="submit">Edit</button>
                                    </form>
                                </span>
                                <span style="float: right;">
                                    <i class="fas fa-trash" style="background-color: #ff0000;"></i>
                                    <form action="{{ route('wh.destroy', $wh->id_wh) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-btn" data-id="{{ $wh->id_wh }}">Hapus</button>
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
        <div>
            <div class="filter-overlay" id="filter-0">
                <p>No:</p><input type="text" placeholder="Input.." onkeyup="filterTable(0, this.value)">
            </div>
            <div class="filter-overlay" id="filter-1">
                <p>Plant Location:</p><input type="text" placeholder="Input.." onkeyup="filterTable(1, this.value)">
            </div>
            <div class="filter-overlay" id="filter-2">
                <p>Warehouse Type:</p><input type="text" placeholder="Input.." onkeyup="filterTable(2, this.value)">
            </div>
            <div class="filter-overlay" id="filter-3">
                <p>Shelf Counts:</p><input type="text" placeholder="Input.." onkeyup="filterTable(3, this.value)">
            </div>
            <div class="filter-overlay" id="filter-4">
                <p>Shelf IDs/Names:</p><input type="text" placeholder="Input.." onkeyup="filterTable(4, this.value)">
            </div>
            <div class="filter-overlay" id="filter-5">
                <p>Cabinet Counts:</p><input type="text" placeholder="Input.." onkeyup="filterTable(5, this.value)">
            </div>
            <div class="filter-overlay" id="filter-6">
                <p>Cabinet IDs/Names:</p><input type="text" placeholder="Input.." onkeyup="filterTable(6, this.value)">
            </div>
            <div class="filter-overlay" id="filter-7">
                <p>Capacity:</p><input type="text" placeholder="Input.." onkeyup="filterTable(7, this.value)">
            </div>
            <div class="filter-overlay" id="filter-8">
                <p>Temperature Control:</p><input type="text" placeholder="Input.." onkeyup="filterTable(8, this.value)">
            </div>
        </div>
        <div class="overlay" id="overlay">
            <div class="overlay-top">
                <h3>Warehouse Information</h3>
                <i class="fas fa-close" onclick="overlayOff()"></i>
            </div>
            <div class="overlay-main">
                <span><h4>Plant Location: </h4><p><span id="plt_loc"></span></p></span>
                <span><h4>Warehouse Type: </h4><p><span id="wh_type"></span></p></span>
                <span><h4>Shelf Counts: </h4><p><span id="sc"></span></p></span>
                <span><h4>Shelf IDs/Names: </h4><p><span id="si"></span></p></span>
                <span><h4>Cabinet Counts: </h4><p><span id="cc"></span></p></span>
                <span><h4>Cabinet IDs/Names: </h4><p><span id="ci"></span></p></span>
                <span><h4>Capacity: </h4><p><span id="cpt"></span></p></span>
                <span><h4>Temperature Control: </h4><p><span id="temp_ctrl"></span></p></span>
                <span><h4>Plant Manager: </h4><p><span id="pm"></span></p></span>
                <span><h4>Manager Contact Information: </h4><p><span id="mci"></span></p></span>
            </div>
        </div>
    </section>
</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function openNav(){
        document.getElementById("side-nav").style.left = "0";
        document.getElementById("main").style.left = "35vh";
    }

    function closeNav(){
        document.getElementById("side-nav").style.left = "-35vh";
        document.getElementById("main").style.left = "0";
    }
    
    function overlayOn(id_wh) {
        fetch(`/wh/${id_wh}`)
            .then(response => response.json()) // Bukan `.json()` untuk melihat isi asli
            .then(data => {
                document.getElementById("plt_loc").textContent = data.whlocs.location;
                document.getElementById("wh_type").textContent = data.wh_type;
                document.getElementById("sc").textContent = data.shelf_count;
                document.getElementById("si").textContent = data.shelf_ids;
                document.getElementById("cc").textContent = data.cabs_count;
                document.getElementById("ci").textContent = data.cabs_ids;
                document.getElementById("cpt").textContent = data.capacity;
                document.getElementById("temp_ctrl").textContent = data.temp_ctrl;
                document.getElementById("pm").textContent = data.whlocs.manager;
                document.getElementById("mci").textContent = data.whlocs.ctc_info;


                //console.log("Data asli dari API:", text); // Lihat apakah ini JSON valid atau HTML/error
            });
        
        let overlay = document.getElementById("overlay");

        overlay.style.display = "block"; // Pastikan elemen terlihat sebelum transisi
        setTimeout(() => {
            overlay.style.opacity = "1"; // Efek fade-in
        }, 200); // Delay sedikit agar transisi bisa aktif

        //document.getElementById("td-list").style.backgroundColor = "#7B95F9";
        //console.log("Overlay sekarang seharusnya aktif!");
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

    document.querySelectorAll('.logout-btn').forEach(button => {
        //console.log("Event listener aktif!"); // Debug sebelum eksekusi
        button.addEventListener('click', function(event) {
            event.preventDefault();
            let partId = this.getAttribute('data-id');
            let form = this.closest("form");
            Swal.fire({
                title: "WARNING",
                html: `<p>Are you sure want to logout?</p>`,
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