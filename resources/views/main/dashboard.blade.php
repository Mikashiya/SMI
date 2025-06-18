<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NeoTeam</title>
</head>
<link rel="stylesheet" href="{{ asset('css/main_style.css') }}">
<style>
    .comp-profile{
        margin-left: 5vh;
        margin-top: 5vh;
    }

    .comp-profile img{
        width: 100%; 
        margin-bottom: 5vh; 
        margin-left: -2.5vh;
    }

    .title{
        color: #424242;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        padding: 1px;
        width: auto;
        text-align: center;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 2.5vh;
        border-radius: 20px;
    }

    .text{
        color: #424242;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        text-align: justify;
        width: 90%;
        margin-left: auto;
        margin-right: auto;
        line-height: 5vh;
    }
</style>
<body>
    @include('layouts.navigation')
    <section class="main" id="main">
        <div class="header">
            <h4>Dashboard</h4>
        </div>
        <div class="comp-profile">
            <div>
                <img src="{{asset('img/comp.jpg')}}" alt="Company Photo">
            </div>
            <div class="title">
                <h4>About Company</h4>
            </div>
            <div class="text">
                <p>PT IndoTech Parts is a company specializing in automotive spare parts for both two-wheeled and four-wheeled vehicles. 
                    Established in 2025 with a vision to support the advancement of the national automotive industry, 
                    we are committed to providing high-quality, reliable spare parts that meet international standards.
                </p>
            </div>
        </div>
    </section>
</body>
@include('layouts.swal_fire')
</html>