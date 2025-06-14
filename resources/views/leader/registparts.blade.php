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
            <h4>Register New Part</h4>
        </div>
        <div class="form-sect">
            <form action="{{ route('parts.store') }}" method="POST">
                @csrf
                <div class="form-mvt">
                    <div class="col">
                        <label for="part_id">Part ID</label><br>
                        <input type="text" placeholder="Input" name="part_id">
                    </div>
                    <div class="col">
                        <label for="date_in">Date In</label><br>
                        <input type="date" name="date_in">
                    </div>
                    <div class="col">
                        <label for="pic_wh">PIC WH</label><br>
                        <input type="text" placeholder="Input" name="pic_wh">
                    </div>
                    <div class="col">
                        <label for="pic_order">PIC Order</label><br>
                        <input type="text" placeholder="Input" name="pic_order">
                    </div>
                    <div class="col">
                        <label for="spl_name">Supplier</label><br>
                        <select name="spl">
                            @foreach ($spl as $spl=>$spl_name)
                                <option value="{{$spl}}">{{$spl_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="usage">Usage</label><br>
                        <input type="text" placeholder="Input" name="usage">
                    </div>
                    <div class="col">
                        <label for="part_name">Part Name</label><br>
                        <input type="text" placeholder="Input" name="part_name">
                    </div>
                    <div class="col">
                        <label for="part_type">Part Type</label><br>
                        <input type="text" placeholder="Input" name="part_type">
                    </div>
                    <div class="col">
                        <label for="mfg">Manufacturing</label><br>
                        <input type="text" placeholder="Input" name="mfg">
                    </div>
                    <div class="col">
                        <label for="loc">WH Location</label><br>
                        <select name="loc">
                            @foreach ($choices as $loc=>$wh_type)
                                <option value="{{$loc}}">{{$wh_type}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col">
                        <label for="price">Price</label><br>
                        <input type="text" placeholder="Input" name="price">
                    </div>
                    <div class="col">
                        <label for="f_stock">Inbound Stock</label><br>
                        <input type="text" placeholder="Input" name="f_stock">
                    </div>
                    <div class="col">
                        <label for="s_stock">Safety Stock</label><br>
                        <input type="text" placeholder="Input" name="s_stock">
                    </div>
                    <div class="col">
                        <label for="note">Note</label><br>
                        <textarea name="note" id="" placeholder="Input"></textarea>
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