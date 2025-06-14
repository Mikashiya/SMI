<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NeoTeam</title>
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<link rel="stylesheet" href="{{ asset('css/table_sect.css') }}">
<link rel="stylesheet" href="{{ asset('css/main_style.css') }}">
<body>
    @include('layouts.navigation')
    <section class="main" id="main">
        <div class="header">
            <h4>Daily Reports {{ $plants->firstWhere('id_whlocs', request('id_whlocs'))?->location ?? 'All Plants' }}</h4>
            @include('layouts.filter_btn')
        </div>
        @foreach($plants as $plant)
            @if(request('plant_id') == 'all' || request('plant_id') == $plant->id_whlocs)
                <div class="table-sect">
                    <table>
                        <thead>
                            <tr>
                                <th>
                                    No
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(0)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    User ID
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(1)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Part ID
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(2)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Quantity
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(3)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    (Transfer) From ID
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(4)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    (Transfer) To ID
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(5)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Part Usage
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(6)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    PIC Warehouse
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(7)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    PIC Request
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(8)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Price
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(0)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Supplier
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(1)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Date Inbound
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(2)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Date outbound
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(3)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Date Transfer
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(4)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Description
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(5)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($movements->where('allocations.warehouses.id_whlocs', $plant->id_whlocs) as $mvt)
                                <tr>
                                    <td onclick="overlayOn('{{ $mvt->id }}')"></td>
                                    <td onclick="overlayOn('{{ $mvt->id }}')">{{ $mvt->mvt_type }}</td>
                                    <td onclick="overlayOn('{{ $mvt->id }}')">{{ optional($mvt->allocations)->id_alct ?? 'Not Found' }}</td>
                                    <td onclick="overlayOn('{{ $mvt->id }}')">{{ $mvt->qty }}</td>
                                    <td onclick="overlayOn('{{ $mvt->id }}')">{{ $mvt->from_loc }}</td>
                                    <td onclick="overlayOn('{{ $mvt->id }}')">{{ $mvt->to_loc }}</td>
                                    <td onclick="overlayOn('{{ $mvt->id }}')">{{ $mvt->part_use }}</td>
                                    <td onclick="overlayOn('{{ $mvt->id }}')">{{ $mvt->pic_wh }}</td>
                                    <td onclick="overlayOn('{{ $mvt->id }}')">{{ $mvt->pic_item }}</td>
                                    <td onclick="overlayOn('{{ $mvt->id }}')">{{ $mvt->price }}</td>
                                    <td onclick="overlayOn('{{ $mvt->id }}')">{{ $mvt->supplier }}</td>
                                    <td onclick="overlayOn('{{ $mvt->id }}')">{{ $mvt->date_in }}</td>
                                    <td onclick="overlayOn('{{ $mvt->id }}')">{{ $mvt->date_out }}</td>
                                    <td onclick="overlayOn('{{ $mvt->id }}')">{{ $mvt->date_transfer }}</td>
                                    <td onclick="overlayOn('{{ $mvt->id }}')">{{ $mvt->desc }}</td>
                                </tr>
                            @empty
                                <td colspan="15">Empty</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div>
                    <div class="filter-overlay" id="filter-0">
                        <p>No:</p><input type="text" placeholder="Input.." onkeyup="filterTable(0, this.value)">
                    </div>
                    <div class="filter-overlay" id="filter-1">
                        <p>User ID:</p><input type="text" placeholder="Input.." onkeyup="filterTable(1, this.value)">
                    </div>
                    <div class="filter-overlay" id="filter-2">
                        <p>User Role:</p><input type="text" placeholder="Input.." onkeyup="filterTable(2, this.value)">
                    </div>
                    <div class="filter-overlay" id="filter-3">
                        <p>Action:</p><input type="text" placeholder="Input.." onkeyup="filterTable(3, this.value)">
                    </div>
                    <div class="filter-overlay" id="filter-4">
                        <p>Target:</p><input type="text" placeholder="Input.." onkeyup="filterTable(4, this.value)">
                    </div>
                    <div class="filter-overlay" id="filter-5">
                        <p>Description:</p><input type="text" placeholder="Input.." onkeyup="filterTable(5, this.value)">
                    </div>
                    <div class="filter-overlay" id="filter-6">
                        <p>IP Address:</p><input type="text" placeholder="Input.." onkeyup="filterTable(6, this.value)">
                    </div>
                    <div class="filter-overlay" id="filter-7">
                        <p>User Agent:</p><input type="text" placeholder="Input.." onkeyup="filterTable(7, this.value)">
                    </div>
                    <div class="filter-overlay" id="filter-8">
                        <p>Date Time:</p><input type="text" placeholder="Input.." onkeyup="filterTable(8, this.value)">
                    </div>
                </div>
            @endif
        @endforeach
    </section>
</body>
@include('layouts.swal_fire')
</html>