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
<link rel="stylesheet" href="{{ asset('css/form_sect.css') }}">
<body>
    @include('layouts.navigation')
    <section class="main" id="main">
        <div class="header">
            <h4>Activity Logs</h4>
            @include('layouts.filter_btn')
        </div>
        <div class="form-sect">
            <form method="GET" action="{{ route('auth.index') }}">
                <label for="date">Filter by Date:</label>
                <input type="date" name="date" id="date" value="{{ request('date') ?? now()->toDateString() }}">
                <input type="submit" value="Filter" class="regis-btn">
            </form>
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
                            User ID
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(1)" id="filter-icon-1"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            User Role
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(2)" id="filter-icon-2"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            Action
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(3)" id="filter-icon-3"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            Target
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(4)" id="filter-icon-4"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            Description
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(5)" id="filter-icon-5"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            IP Address
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(6)" id="filter-icon-6"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            User Agent
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(7)" id="filter-icon-7"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                        <th>
                            Date Time
                            <span class="filter-container">
                                <span class="filter-icon" onclick="toggleFilter(8)" id="filter-icon-8"><i class="fas fa-filter"></i></span>
                            </span>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($actlogs as $act)
                        <tr>
                            <td></td>
                            <td>{{ optional($act->custom_users)->username ?? 'Not Found' }}</td>
                            <td>{{ $act->role }}</td>
                            <td>{{ $act->action }}</td>
                            <td>{{ $act->target }}</td>
                            <td>{{ $act->description }}</td>
                            <td>{{ $act->ip_address }}</td>
                            <td>{{ $act->user_agent }}</td>
                            <td>{{ $act->created_at }}</td>
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
    </section>
</body>
@include('layouts.swal_fire')
</html>