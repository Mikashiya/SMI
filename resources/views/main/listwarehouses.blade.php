<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NeoTeam</title>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/overlay.css') }}">
<link rel="stylesheet" href="{{ asset('css/table_sect.css') }}">
<link rel="stylesheet" href="{{ asset('css/main_style.css') }}">
<style>
    .table-sect th:nth-child(1){
        width: 6vh;
    }

    .table-sect th:nth-child(8), .table-sect th:nth-child(9), .table-sect th:nth-child(10){
        width: 15vh;
    }

    .table-sect th:nth-child(2){
        width: 10vh;
    }

    .table-sect th:nth-child(11){
        width: 20vh;
     }

    .table-sect th:nth-child(3), .table-sect th:nth-child(5), .table-sect th:nth-child(6){
        width: 30vh;
    }

    .table-sect th:nth-child(4), .table-sect th:nth-child(7){
        width: 50vh;
    }
</style>
<body>
    @include('layouts.navigation')
    <section class="main" id="main">
        <div class="header">
            <h4>List Warehouses {{ $plants->firstWhere('id_whlocs', request('id_whlocs'))?->location ?? 'All Plants' }}</h4>
            @include('layouts.filter_btn')
        </div>
        <div class="table-sect">
            <table>
                <thead>
                    <tr>
                        <th>
                            No
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(0)" id="filter-icon-0"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            Plant Location
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(1)" id="filter-icon-1"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            Warehouse Type
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(2)" id="filter-icon-2"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            Shelf Counts
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(3)" id="filter-icon-3"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            Shelf IDs/Names
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(4)" id="filter-icon-4"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            Cabinet Counts
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(5)" id="filter-icon-5"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            Cabinet IDs/Names
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(6)" id="filter-icon-6"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            Capacity
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(7)" id="filter-icon-7"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            Temperature Control
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(8)" id="filter-icon-8"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        @if (Auth::user()->role->role_name === 'Leader')
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($warehouses as $wh)
                        <tr>
                            <td></td>
                            <td>{{ optional($wh->whlocs)->location ?? 'Not Found' }}</td>
                            <td>{{ $wh->wh_type }}</td>
                            <td>{{ $wh->shelf_count }}</td>
                            <td>{{ $wh->shelf_ids }}</td>
                            <td>{{ $wh->cabs_count }}</td>
                            <td>{{ $wh->cabs_ids }}</td>
                            <td>{{ $wh->capacity }} Items</td>
                            <td>{{ $wh->temp_ctrl }}</td>
                            @if (Auth::user()->role->role_name === 'Leader')
                                <td style="cursor:default;">
                                    <span style="float: left;">
                                        <i class="fas fa-pencil-alt" style="background-color: #48ff00;"></i>
                                        <form action="{{ route('wh.edit', $wh->id_wh) }}" method="GET">
                                            <button type="submit">Edit</button>
                                        </form>
                                    </span>
                                    <span style="float: right;">
                                        <i class="fas fa-trash" style="background-color: #ff0000;"></i>
                                        <form action="{{ route('wh.destroy', $wh->id_wh) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn" data-id="{{ $wh->id_wh }}">Hapus</button>
                                        </form>
                                    </span>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <td colspan="9">Empty</td>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div>
            <div class="filter-overlay" id="filter-0">
                <p>No:</p><input type="text" placeholder="Input.." onkeyup="filterTable(0, this.value)">
            </div>
            <div class="filter-overlay" id="filter-1">
                <p>Plant Location:</p><input type="text" placeholder="Input.." onkeyup="filterTable(1, this.value)">
            </div>
            <div class="filter-overlay" id="filter-2">
                <p>Warehouse Type:</p><input type="text" placeholder="Input.." onkeyup="filterTable(2, this.value)">
            </div>
            <div class="filter-overlay" id="filter-3">
                <p>Shelf Counts:</p><input type="text" placeholder="Input.." onkeyup="filterTable(3, this.value)">
            </div>
            <div class="filter-overlay" id="filter-4">
                <p>Shelf IDs/Names:</p><input type="text" placeholder="Input.." onkeyup="filterTable(4, this.value)">
            </div>
            <div class="filter-overlay" id="filter-5">
                <p>Cabinet Counts:</p><input type="text" placeholder="Input.." onkeyup="filterTable(5, this.value)">
            </div>
            <div class="filter-overlay" id="filter-6">
                <p>Cabinet IDs/Names:</p><input type="text" placeholder="Input.." onkeyup="filterTable(6, this.value)">
            </div>
            <div class="filter-overlay" id="filter-7">
                <p>Capacity:</p><input type="text" placeholder="Input.." onkeyup="filterTable(7, this.value)">
            </div>
            <div class="filter-overlay" id="filter-8">
                <p>Temperature Control:</p><input type="text" placeholder="Input.." onkeyup="filterTable(8, this.value)">
            </div>
        </div>
    </section>
</body>
@include('layouts.swal_fire')
</html>