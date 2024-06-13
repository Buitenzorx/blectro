@extends('layouts.main')

@section('container')
    <div class="row">
        <div class="col-md-12">
            <!-- Tabel Sensors -->
            <h1 class="text-primary mb-4 bg-dark text-white text-center">Sensors</h1>

            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">ID</th>
                        <th scope="col">Device Name</th>
                        <th scope="col">Current Value</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($devices as $index => $device)
                        @if ($index < 3)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a href="/devices/{{ $device['id'] }}" class="text-decoration-none">
                                        <i class="fas fa-link"></i> {{ $device['id'] }}
                                    </a>
                                </td>
                                <td>{{ $device['nama_device'] }}</td>
                                <td>{{ $device['nilai'] }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <!-- Tabel Aktuator -->
            <h1 class="text-primary mb-6 bg-dark text-white text-center">Aktuator</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <!-- Tabel LED -->
            <h2 class="text-primary mb-4 bg-dark text-white text-center">LED</h2>
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">ID</th>
                        <th scope="col">LED</th>
                        <th scope="col">Current Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($devices as $index => $device)
                        @if (in_array($device['id'], [4, 5, 6]))
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a href="/devices/{{ $device['id'] }}" class="text-decoration-none">
                                        <i class="fas fa-link"></i> {{ $device['id'] }}
                                    </a>
                                </td>
                                <td>{{ $device['nama_device'] }}</td>
                                <td id="status{{ $device['id'] }}">{{ $device['nilai'] }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-6">
            <!-- Tabel Buzzer -->
            <h2 class="text-primary mb-4 bg-dark text-white text-center">Buzzer</h2>
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">ID</th>
                        <th scope="col">Buzzer Name</th>
                        <th scope="col">Current Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($devices as $index => $device)
                        @if ($index > 3 && $index < 5)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a href="/devices/{{ $device['id'] }}" class="text-decoration-none">
                                        <i class="fas fa-link"></i> {{ $device['id'] }}
                                    </a>
                                </td>
                                <td>{{ $device['nama_device'] }}</td>
                                <td>{{ $device['nilai'] }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
