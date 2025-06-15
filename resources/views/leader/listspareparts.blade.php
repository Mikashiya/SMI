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
        <div class="header" id="plantId">
            <h4>List Spareparts {{ $plants->firstWhere('id_whlocs', request('id_whlocs'))?->location ?? 'All Plants' }}</h4>
            @include('layouts.filter_btn')
        </div>
        @foreach($plants as $plant)
            @if(request('id_whlocs') == 'all' || request('id_whlocs') == $plant->id_whlocs)
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
                                    Part ID
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(1)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Part Name
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(2)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Part Type
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(3)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    MFG
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(4)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Usage
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(5)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Note
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(6)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Stock Balance
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(7)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Safety Stock
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(8)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                <th>
                                    Reminder
                                    <span class="filter-container">
                                        <span class="filter-icon" onclick="toggleFilter(9)"><i class="fas fa-filter"></i></span>
                                    </span>
                                </th>
                                @if (Auth::user()->role->role_name === 'Leader')
                                    <th>Action</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($allocations->where('warehouses.id_whlocs', $plant->id_whlocs) as $parts)
                                <tr>
                                    <td onclick="overlayOn('{{ $parts->id_alct }}')"></td>
                                    <td onclick="overlayOn('{{ $parts->id_alct }}')">{{ $parts->id_alct }}</td>
                                    <td onclick="overlayOn('{{ $parts->id_alct }}')">{{ optional($parts->spareparts)->part_name ?? 'Not Found' }}</td>
                                    <td onclick="overlayOn('{{ $parts->id_alct }}')">{{ optional($parts->spareparts)->part_type ?? 'Not Found' }}</td>
                                    <td onclick="overlayOn('{{ $parts->id_alct }}')">{{ optional($parts->spareparts)->mfg ?? 'Not Found' }}</td>
                                    <td onclick="overlayOn('{{ $parts->id_alct }}')">{{ $parts->usage }}</td>
                                    <td onclick="overlayOn('{{ $parts->id_alct }}')">{{ $parts->note }}</td>
                                    <td onclick="overlayOn('{{ $parts->id_alct }}')">{{ $parts->e_stock }}</td>
                                    <td onclick="overlayOn('{{ $parts->id_alct }}')">{{ $parts->s_stock }}</td>
                                    <td onclick="overlayOn('{{ $parts->id_alct }}')">{{ $parts->reminder }}</td>
                                    @if (Auth::user()->role->role_name === 'Leader')
                                        <td style="cursor:default;">
                                            <span style="float: left;">
                                                <i class="fas fa-pencil-alt" style="background-color: #48ff00;"></i>
                                                <form action="{{ route('parts.edit', $parts->id_alct) }}" method="GET">
                                                    <button type="submit">Edit</button>
                                                </form>
                                            </span>
                                            <span style="float: right;">
                                                <i class="fas fa-trash" style="background-color: #ff0000;"></i>
                                                <form action="{{ route('parts.destroy', $parts->id_alct) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="delete-btn" data-id="{{ $parts->id_alct }}">Hapus</button>
                                                </form>
                                            </span>
                                        </td>
                                    @endif
                                </tr>
                            @empty
                                <td colspan="11">Empty</td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif
        @endforeach
        <div>
            <div class="filter-overlay" id="filter-0">
                <p>No:</p><input type="text" placeholder="Input.." onkeyup="filterTable(0, this.value)">
            </div>
            <div class="filter-overlay" id="filter-1">
                <p>Part ID:</p><input type="text" placeholder="Input.." onkeyup="filterTable(1, this.value)">
            </div>
            <div class="filter-overlay" id="filter-2">
                <p>Part Name:</p><input type="text" placeholder="Input.." onkeyup="filterTable(2, this.value)">
            </div>
            <div class="filter-overlay" id="filter-3">
                <p>Part Type:</p><input type="text" placeholder="Input.." onkeyup="filterTable(3, this.value)">
            </div>
            <div class="filter-overlay" id="filter-4">
                <p>Manufacturing:</p><input type="text" placeholder="Input.." onkeyup="filterTable(4, this.value)">
            </div>
            <div class="filter-overlay" id="filter-5">
                <p>Usage:</p><input type="text" placeholder="Input.." onkeyup="filterTable(5, this.value)">
            </div>
            <div class="filter-overlay" id="filter-6">
                <p>Note:</p><input type="text" placeholder="Input.." onkeyup="filterTable(6, this.value)">
            </div>
            <div class="filter-overlay" id="filter-7">
                <p>Stock Balance:</p><input type="text" placeholder="Input.." onkeyup="filterTable(7, this.value)">
            </div>
            <div class="filter-overlay" id="filter-8">
                <p>Safety Stock:</p><input type="text" placeholder="Input.." onkeyup="filterTable(8, this.value)">
            </div>
            <div class="filter-overlay" id="filter-9">
                <p>Reminder:</p><input type="text" placeholder="Input.." onkeyup="filterTable(9, this.value)">
            </div>
        </div>
        <div class="overlay" id="overlay">
            <div class="overlay-top">
                <h3>Spareparts Information <span id="wh_loc"></span></h3>
                <i class="fas fa-close" onclick="overlayOff()"></i>
            </div>
            <div class="overlay-main">
                <span><h4>Part ID: </h4><p><span id="part_id"></span></p></span>
                <span><h4>Part Name: </h4><p><span id="part_name"></span></p></span>
                <span><h4>Part Type: </h4><p><span id="part_type"></span></p></span>
                <span><h4>Manufacturing: </h4><p><span id="mfg"></span></p></span>
                <span><h4>Part Usage: </h4><p><span id="usage"></span></p></span>
                <span><h4>Note: </h4><p><span id="note"></span></p></span>
                <span><h4>Part Location: </h4><p><span>Warehouse</span><span id="wh_type"></span></p></span>
                <span><h4>Inbound Stock: </h4><p><span id="f_stock"></span></p></span>
                <span><h4>Stock Balance: </h4><p><span id="e_stock"></span></p></span>
                <span><h4>Safety Stock: </h4><p><span id="s_stock"></span></p></span>
                <span><h4>Reminder: </h4><p><span id="reminder"></span></p></span>
                <span><h4>Price Per Quantity: </h4><p><span id="price"></span></p></span>
                <span><h4>Supplier: </h4><p><span id="spl_name"></span></p></span>
            </div>
            <div class="overlay-note">
                <h3>Part Movement Information</h3>
                <div class="overlay-note">
                    <div class="overlay-note">
                        <div class="part-in">
                            <h4>Part In</h4>
                            <span><h4>Last Date In: </h4><p><span id="date_in_in"></span></p></span>
                            <span><h4>Stock: </h4><p><span id="stock-in"></span></p></span>
                            <span><h4>Part Usage: </h4><p><span id="part-use-in"></span></p></span>
                            <span><h4>PIC WH: </h4><p><span id="pic-wh-in"></span></p></span>
                            <span><h4>PIC Request: </h4><p><span id="pic-req-in"></span></p></span>
                            <span><h4>Note: </h4><p><span id="part-desc-in"></span></p></span>
                        </div>
                        <div class="part-out">
                            <h4>Part Out</h4>
                            <span><h4>Last Date Out: </h4><p><span id="date_out_out"></span></p></span>
                            <span><h4>Stock: </h4><p><span id="stock-out"></span></p></span>
                            <span><h4>Part Usage: </h4><p><span id="part-use-out"></span></p></span>
                            <span><h4>PIC WH: </h4><p><span id="pic-wh-out"></span></p></span>
                            <span><h4>PIC Request: </h4><p><span id="pic-req-out"></span></p></span>
                            <span><h4>Note: </h4><p><span id="part-desc-out"></span></p></span> 
                        </div>
                        <div class="part-transfer">
                            <h4>Part Transfer</h4>
                            <span><h4>Last Date Transfer: </h4><p><span id="date_transfer_transfer"></span></p></span>
                            <span><h4>Stock: </h4><p><span id="stock-transfer"></span></p></span>
                            <span><h4>To Location ID: </h4><p><span id="part-loc-transfer"></span></p></span>
                            <span><h4>PIC WH: </h4><p><span id="pic-wh-transfer"></span></p></span>
                            <span><h4>PIC Request: </h4><p><span id="pic-req-transfer"></span></p></span>
                            <span><h4>Part Usage: </h4><p><span id="part-use-transfer"></span></p></span>
                            <span><h4>Note: </h4><p><span id="part-desc-transfer"></span></p></span>   
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
@include('layouts.swal_fire')
<script>
    function overlayOn(id_alct) {

        //const idAlct = row.getAttribute("data-id_alct");

        fetch(`/parts/${id_alct}`)
            .then(response => response.json()) // Bukan `.json()` untuk melihat isi asli
            .then(data => {
                
                console.log('Debugging data:', data);
                document.getElementById("part_id").textContent = data.id_alct;
                document.getElementById("part_name").textContent = data.spareparts.part_name;
                document.getElementById("part_type").textContent = data.spareparts.part_type;
                document.getElementById("mfg").textContent = data.spareparts.mfg;
                document.getElementById("usage").textContent = data.usage;
                document.getElementById("note").textContent = data.note;
                document.getElementById("wh_type").textContent = data.warehouses.wh_type;
                document.getElementById("f_stock").textContent = data.f_stock;
                document.getElementById("e_stock").textContent = data.e_stock;
                document.getElementById("s_stock").textContent = data.s_stock;
                document.getElementById("reminder").textContent = data.reminder;
                document.getElementById("price").textContent = "Rp. " + Number(data.spareparts.price).toLocaleString('id-ID', { minimumFractionDigits: 2 });
                document.getElementById("wh_loc").textContent = data.warehouses.whlocs.location;
                document.getElementById("spl_name").textContent = data.spareparts.supplier.spl_name;


                data.stc_mvt.forEach(stc_mvt =>{
                    document.getElementById(`stock-${stc_mvt.mvt_type}`).textContent = stc_mvt.qty ?? 'N/A';
                    document.getElementById(`pic-wh-${stc_mvt.mvt_type}`).textContent = stc_mvt.pic_wh ?? 'N/A';
                    document.getElementById(`pic-req-${stc_mvt.mvt_type}`).textContent = stc_mvt.pic_item ?? 'N/A';
                    document.getElementById(`part-desc-${stc_mvt.mvt_type}`).textContent = stc_mvt.description ?? 'N/A';
                    document.getElementById(`part-use-${stc_mvt.mvt_type}`).textContent = stc_mvt.part_use ?? 'N/A';
                    document.getElementById(`part-loc-transfer`).textContent = stc_mvt.to_loc ?? 'N/A';

                    if (stc_mvt.date_in) {
                        document.getElementById(`date_in_${stc_mvt.mvt_type}`).textContent = stc_mvt.date_in;
                    }
                    if (stc_mvt.date_out) {
                        document.getElementById(`date_out_${stc_mvt.mvt_type}`).textContent = stc_mvt.date_out;
                    }
                    if (stc_mvt.date_transfer) {
                        document.getElementById(`date_transfer_${stc_mvt.mvt_type}`).textContent = stc_mvt.date_transfer;
                    }


                })
                
            });

        let overlay = document.getElementById("overlay");

        overlay.style.display = "block"; // Pastikan elemen terlihat sebelum transisi
        setTimeout(() => {
            overlay.style.opacity = "1"; // Efek fade-in
        }, 200); // Delay sedikit agar transisi bisa aktif


        //console.log("Overlay sekarang seharusnya aktif!");
    }

    function plantId(id_whlocs){
        fetch(`/parts/${id_whlocs}`)
            .then(response => response.json()) // Bukan `.json()` untuk melihat isi asli
            .then(data => {
                document.getElementById("plant_id").textContent = data.location;

                //console.log("Data asli dari API:", text); // Lihat apakah ini JSON valid atau HTML/error
            });
    }

    function overlayOff() {
        let overlay = document.getElementById("overlay");

        overlay.style.opacity = "0"; // Buat efek fade-out lebih dulu

        setTimeout(() => {
            overlay.style.display = "none"; // Sembunyikan setelah transisi selesai
        }, 500); // Sesuaikan dengan durasi transition
    }
</script>
</html>