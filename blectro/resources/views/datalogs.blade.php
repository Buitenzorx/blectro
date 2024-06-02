@extends('layouts.main')

@section('container')
    <h1>Data Log All</h1>
    <h3>Log Data : Sensor</h3>
    <div class="scrollable">
        <table class="table table-striped-columns" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Device Name</th>
                    <th scope="col">Device Type</th>
                    <th scope="col">Data</th>
                    <th scope="col">Device Status</th>
                    <th scope="col">Date Time</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($datalog as $d)
                    @if ($d['device_id'] <= 3) <!-- Display data log with ID 1 to 3 -->
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $d['device_name'] }}</td>
                            <td>{{ $d['devicetype'] }}</td>
                            <td>{{ $d['valuelog'] }}</td>
                            <td>{{ $d['statuslog'] }}</td>
                            <td>{{ $d['created_at'] }}</td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <h3>Log Data : Aktuator</h3>
    <div class="scrollable">
        <table class="table table-striped-columns" id="actuatorTable">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Device Name</th>
                    <th scope="col">Device Type</th>
                    <th scope="col">Data</th>
                    <th scope="col">Device Status</th>
                    <th scope="col">Date Time</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($datalog as $d)
                    @if ($d['device_id'] >= 4) <!-- Display aktuator data with ID greater than or equal to 4 -->
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $d['device_name'] }}</td>
                            <td>{{ $d['devicetype'] }}</td>
                            <td>{{ $d['valuelog'] }}</td>
                            <td>{{ $d['statuslog'] }}</td>
                            <td>{{ $d['created_at'] }}</td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endif
                @endforeach
            </tbody>
        </table>
    </div>

    <a href="/devices">Kembali</a>

    <style>
        .scrollable {
            max-height: 200px; /* Atur tinggi maksimal tabel di sini */
            overflow-y: auto;
        }
    </style>

    <script>
        // Check if number of rows exceeds 5, if so, add a class for scrolling
        var table = document.getElementById('dataTable');
        if (table.rows.length > 5) {
            table.classList.add('scrollable');
        }

        var actuatorTable = document.getElementById('actuatorTable');
        if (actuatorTable.rows.length > 5) {
            actuatorTable.classList.add('scrollable');
        }
    </script>
@endsection
