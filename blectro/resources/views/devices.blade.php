@extends('layouts.main')
@section('container')
    <h1>Devices</h1>
    @php
        $i = 1;
    @endphp
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <td>No</td>
            <td>ID</td>
            <td>Device Name</td>
            <td>Min</td>
            <td>Max</td>
            <td>Current Value</td>
        </tr>
        @foreach($devices as $device)
            <tr>
                <td>{{ $i }}</td>
                <td>
                    <a href="/devices/{{ $device['id'] }}">{{ $device['id'] }}</a>
                </td>
                <td>{{ $device['nama_device'] }}</td>
                <td>{{ $device['nilai_min'] }}</td>
                <td>{{ $device['nilai_max'] }}</td>
                <td>{{ $device['nilai'] }}</td>
            </tr>
            @php
                $i++;
            @endphp
        @endforeach
    </table>
@endsection


