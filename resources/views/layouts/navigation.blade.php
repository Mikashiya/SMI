<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .side-nav{
        left: -100vh;
        position: fixed;
        height: 100vh;
        width: auto;
        background-color: #f8f8f8;
        border-right: #969696 3px solid;
        padding: 5vh;
        z-index: 1;
        transition: all .5s ease-in-out;
        overflow: auto;
    }

    .side-nav h4{
        color: #424242;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        padding-top: 2vh;
    }

    .side-nav-links{
        width: auto;
        display: flex;
        flex-direction: column;
    }

    .side-nav-links span{
        display: flex;
        padding: 5px;
        border-radius: 10px;
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

    .side-nav-links select:hover{
        cursor: pointer;
    }

    .side-nav img{
        width: 150px;
        margin-bottom: 5vh;
        margin-left: auto;
        margin-right: auto;
        display: block;
    }

    li{
        list-style: none;
        border-radius: 10px;
        transition: .5s;
        border-radius: 10px;
        margin-top: 1vh;
        margin-left: 2vh;
    }

    .active{
        background-color: rgba(107, 107, 107, 0.3);
    }

    .top-nav{
        position: fixed;
        top: 0;
        height: 5vh;
        width: 100%;
        border-bottom: #969696 3px solid;
        z-index: 1;
        transition: all .5s ease-in-out;
    }

    .top-nav h3{
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        color: #7B95F9;
        margin-left: 7.5vh;
        position: fixed;
        top: -.7%;
        width: 100%;
    }

    .top-nav button{
        text-decoration: none;
        color: #7B95F9;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        right: 0;
        top: 1.3%;
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

    .nav-btn button{
        text-decoration: none;
        color: #7B95F9;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        margin-top: .7%;
        margin-left: 2.5vh;
        transition: .25s;
        background-color: transparent;
        border: none;
        left: 0;
        font-size: 15px;
        cursor: pointer;
        position: relative;
    }

    .nav-btn button:hover{
        color: #1f1f1f;
    }
</style>
<section>
    <div class="side-nav" id="side-nav">
        <div>
            <img src="{{asset('img/logo.png')}}" alt="Logo">
            <ul>
                <div class="side-nav-links">
                    <li class="{{ Route::currentRouteName() === 'leader.dashboard' ? 'active' : '' }}"><span><i class="fas fa-home"></i><a href="{{route('leader.dashboard')}}"> Dashboard</a></span></li>
                    <li class="{{ Route::currentRouteName() === 'mvt.create' ? 'active' : '' }}"><span><i class="fas fa-file-signature"></i><a href="{{route('mvt.create')}}"> Card Movement Parts</a></span></li>
                </div>
                <div class="side-nav-links">
                    <h4>Management Sparepart</h4>
                    <li class="{{ Route::currentRouteName() === 'parts.index' ? 'active' : '' }}"><span><i class="fas fa-list"></i>
                        <form method="GET" action="{{route('parts.index')}}">
                            <select name="id_whlocs" onchange="this.form.submit()">
                                <option value="all" disabled selected>List Spareparts</option>
                            @foreach ($plants as $plant)
                                <option value="{{ $plant->id_whlocs }}">{{ $plant->location }}</option>
                            @endforeach
                            </select>
                        </form>
                    </span></li>
                    @if (Auth::user()->role->role_name === 'Leader')
                        <li class="{{ Route::currentRouteName() === 'parts.create' ? 'active' : '' }}"><span><i class="fas fa-box-open"></i><a href="{{route('parts.create')}}"> Register Sparepart</a></span></li>
                    @endif
                </div>
                <div class="side-nav-links">
                    <h4>Management Warehouse</h4>
                    <li class="{{ Route::currentRouteName() === 'wh.index' ? 'active' : '' }}"><span><i class="fas fa-warehouse"></i><a href="{{route('wh.index')}}"> List Warehouse</a></span></li>
                    @if (Auth::user()->role->role_name === 'Leader')
                        <li class="{{ Route::currentRouteName() === 'wh.create' ? 'active' : '' }}"><span><i class="fas fa-plus"></i><a href="{{route('wh.create')}}"> Register Warehouse</a></span></li>
                    @endif
                </div>
                <div class="side-nav-links">
                    <h4>Management Supplier</h4>
                    <li class="{{ Route::currentRouteName() === 'supplier.index' ? 'active' : '' }}"><span><i class="fas fa-users"></i><a href="{{route('supplier.index')}}"> List Supplier</a></span></li>
                    @if (Auth::user()->role->role_name === 'Leader')
                        <li class="{{ Route::currentRouteName() === 'supplier.create' ? 'active' : '' }}"><span><i class="fas fa-user-plus"></i><a href="{{route('supplier.create')}}"> Register Supplier</a></span></li>
                    @endif
                </div>
                @if (Auth::user()->role->role_name === 'Leader')
                    <div class="side-nav-links">
                        <h4>Monitoring System</h4>
                        <li class="{{ Route::currentRouteName() === 'auth.index' ? 'active' : '' }}"><span><i class="fas fa-file-alt"></i><a href="{{ route('auth.index') }}"> Activity Logs</a></span></li>
                        <li class="{{ Route::currentRouteName() === 'reports.daily' ? 'active' : '' }}"><span><i class="fas fa-calendar-alt"></i>
                            <form method="GET" action="{{ route('reports.daily') }}">
                                <select name="plant_id" onchange="this.form.submit()">
                                    <option value="all" disabled selected>Daily Reports</option>
                                    @foreach ($plants as $plant)
                                        <option value="{{ $plant->id_whlocs }}">{{ $plant->location }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </span></li>
                    </div>
                @endif
            </ul>
        </div>
    </div>
    <div class="top-nav" id="top-nav">
        <div class="nav-btn"><button id="nav-btn"><i class="fas fa-bars"></i></button></div>
        <h3>Hello {{ Auth::user()->role->role_name }} ID: {{ Auth::user()->username }}</h3>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
        </form>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function openNav() {
        document.getElementById("side-nav").style.left = "0";
        document.getElementById("main").style.left = document.getElementById("side-nav").offsetWidth + "px";
        document.getElementById("main").style.width = `calc(100% - ${document.getElementById("side-nav").offsetWidth}px)`;
        document.getElementById("top-nav").style.left = document.getElementById("side-nav").offsetWidth + "px";
    }

    window.addEventListener('resize', openNav);
    window.addEventListener('DOMContentLoaded', openNav);


    function closeNav() {
        document.getElementById("side-nav").style.left = "-100vh";
        document.getElementById("main").style.left = "0";
        document.getElementById("top-nav").style.left = "0";
    }

    document.getElementById("nav-btn").addEventListener("click", function () {
        let sidebar = document.getElementById("side-nav");

        if (sidebar.style.left === "0px") {
            closeNav();
        } else {
            openNav();
        }
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
                    form.submit();
                }
            });
        });
    });
</script>
        