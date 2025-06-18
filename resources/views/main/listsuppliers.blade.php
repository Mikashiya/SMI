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

    .table-sect th:nth-child(2), .table-sect th:nth-child(3), .table-sect th:nth-child(4){
        width: 10vh;
    }
</style>
<body>
    @include('layouts.navigation')
    <section class="main" id="main">
        <div class="header">
            <h4>List Suppliers</h4>
            @include('layouts.filter_btn')
        </div>
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
                            Nama Supplier
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(1)"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            Contact Information
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(2)"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        @if (Auth::user()->role->role_name === 'Leader')
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @forelse($supplier as $spl)
                        <tr>
                            <td></td>
                            <td>{{ $spl->spl_name }}</td>
                            <td>{{ $spl->ctc_info }}</td>
                            @if (Auth::user()->role->role_name === 'Leader')
                                <td style="cursor:default;">
                                    <span style="float: left;">
                                        <i class="fas fa-pencil-alt" style="background-color: #48ff00;"></i>
                                        <form action="{{ route('supplier.edit', $spl->id_spl) }}" method="GET">
                                            <button type="submit">Edit</button>
                                        </form>
                                    </span>
                                    <span style="float: right;">
                                        <i class="fas fa-trash" style="background-color: #ff0000;"></i>
                                        <form action="{{ route('supplier.destroy', $spl->id_spl) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="delete-btn" data-id="{{ $spl->id_spl }}">Hapus</button>
                                        </form>
                                    </span>
                                </td>
                            @endif
                        </tr>
                    @empty
                        <td colspan="3">Empty</td>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</body>
@include('layouts.swal_fire')
</html>