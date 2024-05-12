@extends('layouts.main')
@section('container')
<h1>{{$device["nama_device"]}}</h1>
    @php
        $i = 1;
    @endphp
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th scope>No</th>
            <th scope>DateTime</th>
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
