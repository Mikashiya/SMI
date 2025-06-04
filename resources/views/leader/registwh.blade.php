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
        left: -30vh;
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
        display: block;
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

    form{
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

    input[type=text], input[type=date], textarea, select{
        width: 100%;
        padding: 12px;
        border: 2px solid #424242;
        box-sizing: border-box;
        resize: vertical;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        color: #1f1f1f;
    }
</style>
<body>
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif
    @if(session('success'))
    <div class="alert alert-danger">
        {{ session('success') }}
    </div>
    @endif
    <div class="btn">
        <div><span><i class="fas fa-angle-left" onclick="closeNav()"></i></span></div>
        <div><span><i class="fas fa-angle-right" onclick="openNav()"></i></span></div>
    </div>
    <section>
        <div class="side-nav" id="side-nav">
            <div>
                <img src="{{asset('logo.png')}}" alt="Logo">
                <div class="side-nav-links">
                    <span><i class="fas fa-home"></i><a href="#"> Dashboard</a></span>
                </div>
                <div class="side-nav-links">
                    <h4>Manajemen Sparepart</h4>
                    <span><i class="fas fa-list"></i><a href="{{route('leader.listspareparts')}}"> List Sparepart</a></span>
                    <span><i class="fas fa-box-open"></i><a href="{{route('leader.registparts')}}"> Register Sparepart</a></span>
                </div>
                <div class="side-nav-links">
                    <h4>Manajemen Warehouse</h4>
                    <span><i class="fas fa-warehouse"></i><a href="#"> List Warehouse</a></span>
                    <span class="active"><i class="fas fa-file-signature"></i><a href="{{route('leader.registwh')}}"> Register Warehouse</a></span>
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
                <input type="submit" value="Submit">
                <input type="reset" value="Clear">
            </form>
        </div>
    </section>
</body>
<script>
    function openNav(){
        document.getElementById("side-nav").style.left = "0";
        document.getElementById("main").style.left = "35vh";
    }

    function closeNav(){
        document.getElementById("side-nav").style.left = "-30vh";
        document.getElementById("main").style.left = "5vh";
    }
</script>
</html>