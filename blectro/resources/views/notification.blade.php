@extends('layouts.main')

@section('container')
    <h1>Data Log All</h1>
    <h3>Notification Log</h3>
    <div class="scrollable">
        <table class="table table-striped-columns" id="dataTable">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Message</th>
                    <th scope="col">Date Time</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = 1;
                @endphp
                @foreach ($notificationLog as $n)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $n['user_phone_number'] }}</td>
                            <td>{{ $n['message'] }}</td>
                            <td>{{ $n['updated_at'] }}</td>
                        </tr>
                        @php
                            $i++;
                        @endphp
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
        var table = document.getElementById('dataTable');
        if (table.rows.length > 10) {
            table.classList.add('scrollable');
        }
    </script>
@endsection
