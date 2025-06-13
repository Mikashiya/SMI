<!DOCTYPE html>
<html lang="en">
<head>
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
        margin: none;
    }

    .side-nav-links select{
        border: none;
        background-color: transparent;
        color: #424242;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: medium;
        margin-left: 1vh;
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
        left: 5vh;
        position: absolute;
        transition: .5s;
        overflow: hidden;
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

    .top-nav a:hover{
        color: #1f1f1f;
    }

    .header{
        margin-top: 10vh;
        margin-left: 2.5vh;
        border: #424242 2px solid;
        width: auto;
        padding: 10px;
    }

    .header h4{
        color: #7B95F9;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .form-sect{
        margin-top: 5vh;
        margin-left: 2.5vh;
        width: 150vh;
    }

    .form-sect form{
        margin-left: auto;
        margin-right: auto;
    }

    .upper-row{
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }

    .upper-row:after{
        content: "";
        display: table;
        clear: both;
    }

    .middle-row{
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }

    .middle-row:after{
        content: "";
        display: table;
        clear: both;
    }

    .lower-row{
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }

    .lower-row:after{
        content: "";
        display: table;
        clear: both;
    }

    .form-sect label{
        color: #1f1f1f;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .form-sect input[type=submit], .form-sect input[type=reset]{
        color: #1f1f1f;
        padding: 9px 18px;
        font-style: oblique;
        cursor: pointer;
        float: right;
        margin: 20px;
    }

    .form-sect input[type=submit]:hover, .form-sect input[type=reset]:hover{
        background-color: rgba(107, 107, 107, 0.3);
    }

    .form-sect input[type=text], .form-sect input[type=date], .form-sect textarea, .form-sect select{
        width: 100%;
        padding: 12px;
        border: 2px solid #424242;
        box-sizing: border-box;
        resize: vertical;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        color: #1f1f1f;
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
                    <span><i class="fas fa-warehouse"></i><a href="{{route('wh.index')}}"> List Warehouse</a></span>
                    <span class="active"><i class="fas fa-plus"></i><a href="{{route('wh.create')}}"> Register Warehouse</a></span>
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
        <div class="header">
            <h4>Register New Part</h4>
        </div>
        <div class="form-sect">
            <form action="{{ route('wh.store') }}" method="POST">
                @csrf
                <div class="upper-row">
                    <div class="col">
                        <label for="wh_type">WH Type</label><br>
                        <select name="wh_type">
                            <option value="{{ old('wh_type', $selectedType) }}">
                                {{ $whType[old('wh_type', $selectedType)] ?? 'Select Type' }}
                            </option>
                            <option value="Mechanic">Mechanic</option>
                            <option value="Electric">Electric</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="capacity">Capacity</label><br>
                        <input type="text" placeholder="Input" name="capacity">
                    </div>
                    <div class="col">
                        <label for="temp_ctrl">Temperature Control</label><br>
                        <input type="text" placeholder="Input" name="temp_ctrl">
                    </div>
                    <div class="col">
                        <label for="loc">Plant Location</label><br>
                        <select name="loc">
                            <option value="{{ old('loc', $selectedLoc) }}">
                                {{ $loc[old('loc', $selectedLoc)] ?? 'Select Location' }}
                            </option>
                            @foreach ($choices as $loc=>$location)
                                <option value="{{$loc}}">{{$location}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="middle-row">
                    <div class="col">
                        <label for="shelf_count">Shelf Count</label><br>
                        <input type="text" placeholder="Input" name="shelf_count">
                    </div>
                    <div class="col">
                        <label for="shelf_ids">Shelf IDs</label><br>
                        <input type="text" placeholder="Input" name="shelf_ids">
                    </div>
                    <div class="col">
                        <label for="cabs_count">Cabinet Count</label><br>
                        <input type="text" placeholder="Input" name="cabs_count">
                    </div>
                    <div class="col">
                        <label for="cabs_ids">Cabinet IDs</label><br>
                        <input type="text" placeholder="Input" name="cabs_ids">
                    </div>
                </div>
                <input type="submit" value="Submit" class="regist-btn">
                <input type="reset" value="Clear">
            </form>
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

@if(session('error'))
    <script>
        Swal.fire({
            title: "WARNING",
            text: "{{ session('error') }}",
            icon: "warning",
            timer: 3000,
            showConfirmButton: false,
            customClass:{
                popup: 'custom-font'
            }
        });
    </script>
    @php session()->forget('success'); @endphp
@endif

@if($errors->any())
    <script>
        Swal.fire({
            title: "Oops!",
            text: "{{ implode(', ', $errors->all()) }}",
            icon: "error",
            showConfirmButton: true,
            customClass:{
                popup: 'custom-font'
            }
        });
    </script>
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

    document.querySelectorAll('.regist-btn').forEach(button => {
        //console.log("Event listener aktif!"); // Debug sebelum eksekusi
        button.addEventListener('click', function(event) {
            event.preventDefault();
            let partId = this.getAttribute('data-id');
            let form = this.closest("form");
            Swal.fire({
                title: "WARNING",
                html: `<p>Ensure to cross check the information</p><p>Proceed with caution</p>`,
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Proceed",
                cancelButtonText: "Cancel",
                customClass:{
                    popup: 'custom-font'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); 
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