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
            <h4>Edit Warehouse</h4>
        </div>
        <div class="form-sect">
            <form action="{{ route('wh.update', $warehouse->id_wh) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="upper-row">
                    <div class="col">
                        <label for="wh_type">WH Type</label><br>
                        <select name="wh_type">
                            <option value="{{ old('wh_type', $selectedType) }}">
                                {{ old('wh_type', $selectedType) ?? 'Select Type' }}
                            </option>
                            <option value="Mechanic">Mechanic</option>
                            <option value="Electric">Electric</option>
                        </select>
                    </div>
                    <div class="col">
                        <label for="capacity">Capacity</label><br>
                        <input type="text" value="{{ $warehouse->capacity }}" name="capacity">
                    </div>
                    <div class="col">
                        <label for="temp_ctrl">Temperature Control</label><br>
                        <input type="text" value="{{ $warehouse->temp_ctrl }}" name="temp_ctrl">
                    </div>
                    <div class="col">
                        <label for="loc">Plant Location</label><br>
                        <select name="loc">
                            <option value="{{ old('loc', $selectedLoc) }}">
                                {{ $choices[old('loc', $selectedLoc)] ?? 'Select Location' }}
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
                        <input type="text" value="{{ $warehouse->shelf_count }}" name="shelf_count">
                    </div>
                    <div class="col">
                        <label for="shelf_ids">Shelf IDs</label><br>
                        <input type="text" value="{{ $warehouse->shelf_ids }}" name="shelf_ids">
                    </div>
                    <div class="col">
                        <label for="cabs_count">Cabinet Count</label><br>
                        <input type="text" value="{{ $warehouse->cabs_count }}" name="cabs_count">
                    </div>
                    <div class="col">
                        <label for="cabs_ids">Cabinet IDs</label><br>
                        <input type="text" value="{{ $warehouse->cabs_ids }}" name="cabs_ids">
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