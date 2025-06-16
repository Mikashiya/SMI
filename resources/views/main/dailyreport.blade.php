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
<link rel="stylesheet" href="{{ asset('css/form_sect.css') }}">
<link rel="stylesheet" href="{{ asset('css/main_style.css') }}">
<body>
    @include('layouts.navigation')
    <section class="main" id="main">
        <div class="header" id="plantId">
            <h4>Daily Reports {{ $plants->firstWhere('id_whlocs', request('plant_id'))?->location ?? 'All Plants' }}</h4>
            @include('layouts.filter_btn')
        </div>
        <div class="form-sect">
            <form method="GET" action="{{ route('reports.daily') }}">
                <label for="date">Filter by Date:</label>
                <input type="date" name="date" id="date" value="{{ request('date') ?? now()->toDateString() }}">
                <input type="hidden" name="plant_id" value="{{ request('plant_id') ?? session('plant_id') }}">
                <input type="submit" value="Filter" class="regis-btn">
            </form>
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
                                    Transaction Type
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
                                        <span class="filter-icon" onclick="toggleFilter(9)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Supplier
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(10)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Date Inbound
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(11)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Date Outbound
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(12)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Date Transfer
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(13)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Description
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(14)"><i class="fas fa-filter"></i></span>
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
                                    <td onclick="overlayOn('{{ $mvt->id }}')">{{ $mvt->description }}</td>
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
                        <p>Transaction Type:</p><input type="text" placeholder="Input.." onkeyup="filterTable(1, this.value)">
                    </div>
                    <div class="filter-overlay" id="filter-2">
                        <p>Part ID:</p><input type="text" placeholder="Input.." onkeyup="filterTable(2, this.value)">
                    </div>
                    <div class="filter-overlay" id="filter-3">
                        <p>Quantity:</p><input type="text" placeholder="Input.." onkeyup="filterTable(3, this.value)">
                    </div>
                    <div class="filter-overlay" id="filter-4">
                        <p>(Transfer) From ID:</p><input type="text" placeholder="Input.." onkeyup="filterTable(4, this.value)">
                    </div>
                    <div class="filter-overlay" id="filter-5">
                        <p>(Transfer) To ID:</p><input type="text" placeholder="Input.." onkeyup="filterTable(5, this.value)">
                    </div>
                    <div class="filter-overlay" id="filter-6">
                        <p>Part Usage:</p><input type="text" placeholder="Input.." onkeyup="filterTable(6, this.value)">
                    </div>
                    <div class="filter-overlay" id="filter-7">
                        <p>PIC Warehouse:</p><input type="text" placeholder="Input.." onkeyup="filterTable(7, this.value)">
                    </div>
                    <div class="filter-overlay" id="filter-8">
                        <p>PIC Request:</p><input type="text" placeholder="Input.." onkeyup="filterTable(8, this.value)">
                    </div>
                    <div class="filter-overlay" id="filter-9">
                        <p>Price:</p><input type="text" placeholder="Input.." onkeyup="filterTable(9, this.value)">
                    </div>
                    <div class="filter-overlay" id="filter-10">
                        <p>Supplier:</p><input type="text" placeholder="Input.." onkeyup="filterTable(10, this.value)">
                    </div>
                    <div class="filter-overlay" id="filter-11">
                        <p>Date Inbound:</p><input type="text" placeholder="Input.." onkeyup="filterTable(11, this.value)">
                    </div>
                    <div class="filter-overlay" id="filter-12">
                        <p>Date Outbound:</p><input type="text" placeholder="Input.." onkeyup="filterTable(12, this.value)">
                    </div>
                    <div class="filter-overlay" id="filter-13">
                        <p>Description:</p><input type="text" placeholder="Input.." onkeyup="filterTable(13, this.value)">
                    </div>
                </div>
            @endif
        @endforeach
    </section>
</body>
@include('layouts.swal_fire')
<script>
    function plantId(id_whlocs){
        fetch(`/reports/daily/${id_whlocs}`)
            .then(response => response.json()) // Bukan `.json()` untuk melihat isi asli
            .then(data => {
                document.getElementById("plant_id").textContent = data.location;

                //console.log("Data asli dari API:", text); // Lihat apakah ini JSON valid atau HTML/error
            });
    }
</script>
</html>