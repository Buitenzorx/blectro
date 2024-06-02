@extends('layouts.main')

@section('container')
    <div class="row">
        <div class="col-md-6">
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

        <div class="col-md-3 d-flex justify-content-center align-items-center">
            <div id="gaugeContainer"></div>
        </div>
        <div class="col-md-3 d-flex justify-content-center align-items-center">
            <div id="dhtContainer"></div>
        </div>
    </div>



    <div class="row mt-4">
        <div class="col-md-6">
            <!-- Tabel Aktuator -->
            <h1 class="text-primary mb-6 bg-dark text-white text-center">Aktuator</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <!-- Tabel LED -->
            <h2 class="text-primary mb-4 bg-dark text-white text-center">LED</h2>
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">ID</th>
                        <th scope="col">LED</th>
                        <th scope="col">Current Status</th>
                        <th scope="col">User Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($devices as $index => $device)
                        @if ($index > 2 && $index != 4)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <a href="/devices/{{ $device['id'] }}" class="text-decoration-none">
                                        <i class="fas fa-link"></i> {{ $device['id'] }}
                                    </a>
                                </td>
                                <td>{{ $device['nama_device'] }}</td>
                                <td>{{ $device['nilai'] }}</td>
                                <td>
                                    <div class="toggle-container">
                                        <input type="checkbox" id="toggle{{ $device['id'] }}" class="toggle-checkbox">
                                        <label for="toggle{{ $device['id'] }}" class="toggle-label"></label>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    @endforeach


                </tbody>
            </table>
        </div>

        <div class="col-md-3">
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
    @include('layouts.mq2gauge')
    @include('layouts.dht11gauge')
@endsection
