@extends('layouts.main')
@section('container')
<h1>Log Data : {{ $device["nama_device"] }}</h1>
    @php
        $i = 1;
    @endphp
    <table class="table table-striped-columns">
        <tr>
            <th scope>No</th>
            <th scope>Date Time</th>
            <th scope>Data</th>
        </tr>
        @foreach($data as $d)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $d['created_at'] }}</td>
                <td>{{ $d['data'] }}</td>
            </tr>
            @php
                $i++;
            @endphp
        @endforeach
    </table>
    <a href="/devices">Kembali</a>
@endsection
