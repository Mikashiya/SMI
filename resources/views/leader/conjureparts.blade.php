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
        margin-left: 1vh;
    }

    .side-nav-links select{
        border: none;
        background-color: transparent;
        color: #424242;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        font-size: medium;
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

    .top-nav a{
        text-decoration: none;
        color: #7B95F9;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        right: 0;
        top: 2.3%;
        margin-right: 5vh;
        position: fixed;
        transition: .25s;
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

    label{
        color: #1f1f1f;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
    
    input[type=submit], input[type=reset]{
        color: #1f1f1f;
        padding: 9px 18px;
        font-style: oblique;
        cursor: pointer;
        float: right;
        margin: 20px;
    }

    input[type=submit]:hover, input[type=reset]:hover{
        background-color: rgba(107, 107, 107, 0.3);
    }

    input[type=text], input[type=date], textarea, .form-sect select{
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
                    <span class="active"><i class="fas fa-list"></i>
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
                </div>
                <div class="side-nav-links">
                    <h4>Manajemen Supplier</h4>
                    <span><i class="fas fa-users"></i><a href="{{route('supplier.index')}}"> List Supplier</a></span>
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
        <div class="header">
            <h4>Edit Part</h4>
        </div>
        <div class="form-sect">
            <form action="{{ route('parts.update', $parts->id_alct) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="upper-row">
                    <div class="col">
                        <label for="part_id">Part ID</label><br>
                        <input type="text" value="{{ $parts->id_alct }}" name="part_id">
                    </div>
                    <div class="col">
                        <label for="pic_order">PIC Edit</label><br>
                        <input type="text" placeholder="Input" name="pic_edit">
                    </div>
                    <div class="col">
                        <label for="spl_name">Supplier</label><br>
                        <select name="spl">
                            <option value="{{ old('spl', $selectedSpl) }}">
                                {{ $spl[old('spl', $selectedSpl)] ?? 'Select Supplier' }}
                            </option>

                            @foreach ($spl as $spl=>$spl_name)
                                <option value="{{$spl}}">{{$spl_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="usage">Usage</label><br>
                        <input type="text" value="{{ $parts->usage }}" name="usage">
                    </div>
                </div>
                <div class="middle-row">
                    <div class="col">
                        <label for="part_name">Part Name</label><br>
                        <input type="text" value="{{ $parts->spareparts->part_name }}" name="part_name">
                    </div>
                    <div class="col">
                        <label for="part_type">Part Type</label><br>
                        <input type="text" value="{{ $parts->spareparts->part_type }}" name="part_type">
                    </div>
                    <div class="col">
                        <label for="mfg">Manufacturing</label><br>
                        <input type="text" value="{{ $parts->spareparts->mfg }}" name="mfg">
                    </div>
                    <div class="col">
                        <label for="loc">WH Location</label><br>
                        <select name="loc">
                            <option value="{{ old('loc', $selectedLoc) }}">
                                {{ $choices[old('loc', $selectedLoc)] ?? 'Select WH' }}
                            </option>

                            @foreach ($choices as $loc=>$wh_type)
                                <option value="{{$loc}}">{{$wh_type}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="lower-row">
                    <div class="col">
                        <label for="price">Price</label><br>
                        <input type="text" value="{{ $parts->spareparts->price }}" name="price" style="width: 30vh;">
                    </div>
                    <div class="col">
                        <label for="e_stock">Stock Balance</label><br>
                        <input type="text" value="{{ $parts->e_stock }}" name="e_stock">
                    </div>
                    <div class="col">
                        <label for="s_stock">Safety Stock</label><br>
                        <input type="text" value="{{ $parts->s_stock }}" name="s_stock">
                    </div>
                    <div class="col">
                        <label for="note">Note</label><br>
                        <textarea name="note" id="" value="{{ $parts->note }}" style="width: 80vh;"></textarea>
                    </div>
                </div>
                <input type="submit" value="Submit" class="regist-btn">
                <input type="reset" onclick="window.history.back()" value="Back">
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
</script>
</html>