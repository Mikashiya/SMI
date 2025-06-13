<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NeoTeam</title>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/form_sect.css') }}">
<link rel="stylesheet" href="{{ asset('css/main_style.css') }}">
<body>
    @include('layouts.navigation')
    <section class="main" id="main">
        <div class="header">
            <h4>Register New Supplier</h4>
        </div>
        <div class="form-sect">
            <form action="{{ route('supplier.store') }}" method="POST">
                @csrf
                <div class="upper-row">
                    <div class="col">
                        <label for="spl_name">Supplier Name</label><br>
                        <input type="text" placeholder="Input" name="spl_name">
                    </div>
                    <div class="col">
                        <label for="ctc_info">Contact Information</label><br>
                        <input type="text" placeholder="Input" name="ctc_info">
                    </div>
                </div>
                <input type="submit" value="Submit" class="regist-btn">
                <input type="reset" value="Clear">
            </form>
        </div>
    </section>
</body>
@include('layouts.swal_fire')
</html>