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
            <h4>Edit Part</h4>
        </div>
        <div class="form-sect">
            <form action="{{ route('parts.update', $parts->id_alct) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-mvt">
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
                    <div class="col">
                        <label for="price">Price</label><br>
                        <input type="text" value="{{ $parts->spareparts->price }}" name="price">
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
                        <textarea name="note" id="" value="{{ $parts->note }}"></textarea>
                    </div>
                </div>
                <input type="submit" value="Submit" class="regist-btn">
                <input type="reset" onclick="window.history.back()" value="Back">
            </form>
        </div>
    </section>
</body>
@include('layouts.swal_fire')
</html>