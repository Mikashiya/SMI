<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NeoTeam</title>
</head>
<link rel="stylesheet" href="{{ asset('css/main_style.css') }}">
<link rel="stylesheet" href="{{ asset('css/form_sect.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<style>
    .comp-profile{
        margin-left: 5vh;
        margin-top: 10vh;
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
        width: 15%;
        text-align: center;
        margin-left: auto;
        margin-right: auto;
        margin-bottom: 5vh;
        border-radius: 20px;
    }

    .text{
        color: #424242;
        font-family: Verdana, Geneva, Tahoma, sans-serif;
        text-align: justify;
        width: 90%;
        margin-left: auto;
        margin-right: auto;
        line-height: 3vh;
    }
</style>
<body>
    @include('layouts.navigation')
    <section class="main" id="main">
        <div class="header">
            <h4>Part Movements</h4>
        </div>
        <div class="form-sect">
            <form action="{{ route('mvt.store') }}" method="POST">
                @csrf
                <label for="transactionType">Transaction Type</label>
                <select id="transactionType" name="mvt_type">
                    <option value="" disabled selected>Select Transaction Type</option>
                    <option value="in">In</option>
                    <option value="out">Out</option>
                    @if (Auth::user()->role->role_name === 'Leader')
                        <option value="transfer">Transfer</option>
                    @endif
                </select>
                <div>
                    <div id="formIn" style="display: none;">@include('layouts.part_in')</div>
                    <div id="formOut" style="display: none;">@include('layouts.part_out')</div>
                    <div id="formTransfer" style="display: none;">@include('layouts.part_tf')</div>
                </div>
            </form>
        </div>
    </section>
</body>
@include('layouts.swal_fire')
<script>
    function toggleForm(type) {
        const forms = ['formIn', 'formOut', 'formTransfer'];
        forms.forEach(id => {
            const section = document.getElementById(id);
            const isActive = id === `form${type.charAt(0).toUpperCase() + type.slice(1)}`;
            section.style.display = isActive ? 'block' : 'none';
            section.querySelectorAll('input, select, textarea').forEach(el => {
                el.disabled = !isActive;
            });
        });
    }

    document.getElementById("transactionType").addEventListener("change", function () {
        toggleForm(this.value);
    });
</script>
</html>