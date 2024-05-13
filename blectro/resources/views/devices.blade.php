@extends('layouts.main')
@section('container')
    <h1>Devices</h1> <!-- Mengatur warna teks judul tabel menjadi hitam -->
    @php
        $i = 1;
    @endphp
    <table class="table table-striped-columns">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">ID</th>
                <th scope="col">Device Name</th>
                <th scope="col">Current Value</th>
            </tr>
        </thead>
        <tbody>
            @foreach($devices as $device)
                <tr>
                    <td>{{ $i }}</td>
                    <td>
                        <a href="/devices/{{ $device['id'] }}">{{ $device['id'] }}</a>
                    </td>
                    <td>{{ $device['nama_device'] }}</td>
                    <td>{{ $device['nilai'] }}</td>
                </tr>
                @php
                    $i++;
                @endphp
            @endforeach
        </tbody>
    </table>
@endsection
