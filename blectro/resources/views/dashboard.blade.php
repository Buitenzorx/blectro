@extends('layouts.main')

@section('container')
<div class="row">
    <div class="col-md-6">
        <div class="col-md-11">
            <h2>Sensors</h2>
        </div>
        <div class="col-md-1"></div> <!-- tambahkan kolom kosong untuk memberikan jarak -->
    </div>
    <div class="col-md-6 d-flex justify-content-end align-items-center">
        <!-- menggunakan flex untuk menyusun ke kanan -->
        <div class="col-md-12">
            <h2>Actuator</h2>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <hr class="half-width"> <!-- garis di bawah Sensors -->
    </div>
    <div class="col-md-6">
        <hr class="half-width"> <!-- garis di bawah Aktuator -->
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-3 d-flex justify-content-center align-items-center">
        <figure class="highcharts-figure">
            <div id="container"></div>
        </figure>
    </div>
    <div class="col-md-1 mt-2">
        <label class="toggle">
            <input class="toggle-checkbox" type="checkbox" data-device-id="4" {{ $devices->find(4)->data == 1 ? 'checked' : '' }}>
            <div class="toggle-switch">
                <div class="toggle-circle"></div> <!-- Lingkaran -->
            </div>
            <span class="toggle-label">LED 1</span>
        </label>
    </div>
    <div class="col-md-1 mt-2">
        <label class="toggle">
            <input class="toggle-checkbox" type="checkbox" data-device-id="10" {{ $devices->find(10)->data == 1 ? 'checked' : '' }}>
            <div class="toggle-switch">
                <div class="toggle-circle"></div> <!-- Lingkaran -->
            </div>
            <span class="toggle-label">LED 2</span>
        </label>
    </div>
    <div class="col-md-1 mt-2">
        <label class="toggle">
            <input class="toggle-checkbox" type="checkbox" data-device-id="11" {{ $devices->find(11)->data == 1 ? 'checked' : '' }}>
            <div class="toggle-switch">
                <div class="toggle-circle"></div> <!-- Lingkaran -->
            </div>
            <span class="toggle-label">LED 3</span>
        </label>
    </div>
    <div id="bellContainer" class="col-md-2 justify-content-center align-items-center">
        <b>Buzzer</b>
        <div class="alert bg-white alert-secondary" role="alert">
            <div class="iq-alert-text">
                <i id="bellIcon" class='fas fa-bell' style='font-size:30px'></i>
                <span id="conditionText">Normal</span>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 mt-3 d-flex justify-content-center align-items-center">
        <canvas id="rainSensorChart"></canvas>
    </div>
    <div class="col-md-6 ">
        <div class="col-md-12">
            <h2>Notification Recent</h2>
        </div>
        <div class="col-md-12">
            <hr class="half-width">
        </div>
        <div class="col-md-12 mt-2">
            <div id="clockContainer">
                <h6>Real Time Clock:
                    <span id="digitalClock" style="font-size: 15px;"></span>
                    WIB
                </h6>
            </div>
            <div class="col-md-12 mt-2">
                <div id="clockContainer"></div>
                <table class="table table-striped-columns" id="dataTable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Message</th>
                            <th scope="col">Date Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($notificationLog->isNotEmpty())
                        <!-- Pastikan array tidak kosong -->
                        @php
                            $latestNotification = $notificationLog->last(); // Mendapatkan data terakhir
                        @endphp
                        <tr>
                            <td>1</td>
                            <td>{{ $latestNotification['user_phone_number'] }}</td>
                            <td>{{ $latestNotification['message'] }}</td>
                            <td>{{ $latestNotification['updated_at'] }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        @include('layouts.raingraph')
    </div>
</div>

<style>
    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 310px;
        max-width: 500px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #ebebeb;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }

    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }

    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }

    .highcharts-data-table td,
    .highcharts-data-table th,
    .highcharts-data-table caption {
        padding: 0.5em;
    }

    .highcharts-data-table thead tr,
    .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }

    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }

    .fa-bell {
        margin-left: 20px;
    }

    .half-width {
        width: 100%;
        margin: 0 auto;
        /* Memastikan garis berada di tengah */
    }

    font-family: -apple-system,
    ".SFNSText-Regular",
    "Helvetica Neue",
    "Roboto",
    "Segoe UI",
    sans-serif;
    }

    .toggle {
        cursor: pointer;
        display: inline-block;
    }

    .toggle-switch {
        display: inline-block;
        background: #ccc;
        border-radius: 16px;
        width: 58px;
        height: 32px;
        position: relative;
        vertical-align: middle;
        transition: background 0.25s;
    }

    .toggle-switch:before,
    .toggle-switch:after {
        content: "";
    }

    .toggle-switch:before {
        display: block;
        background: linear-gradient(to bottom, #fff 0%, #eee 100%);
        border-radius: 50%;
        box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.25);
        width: 24px;
        height: 24px;
        position: absolute;
        top: 4px;
        left: 4px;
        transition: left 0.25s;
    }

    .toggle-checkbox:checked+.toggle-switch {
        background: #56c080;
    }

    .toggle-checkbox:checked+.toggle-switch:before {
        left: 30px;
    }

    .toggle-checkbox {
        position: absolute;
        visibility: hidden;
    }

    .toggle-label {
        margin-left: 5px;
        position: relative;
        top: 2px;
    }

    .toggle-circle {
        background-color: black;
        top: 80px;
        position: absolute;
        width: 30px;
        /* Sesuaikan ukuran lingkaran sesuai kebutuhan */
        height: 30px;
        /* Sesuaikan ukuran lingkaran sesuai kebutuhan */
        border-radius: 50%;
        background-color: transparent;
        /* Warna awal lingkaran */
        border: 2px solid #ccc;
        /* Garis lingkaran */
        /* Pusat lingkaran secara vertikal */
        transform: translateY(-50%);
        /* Memusatkan lingkaran secara vertikal */
        right: 10px;
        /* Jarak lingkaran dari sisi kanan switch */
        transition: background-color 0.3s ease, box-shadow 0.25s;
        /* Animasi perubahan warna */
        left: 13px;
        box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.5);
        /* Bayangan */
    }

    .toggle-switch {
        position: relative;
        /* Tambahkan posisi relatif untuk kontainer switch */
    }

    .toggle-checkbox:checked+.toggle-switch .toggle-circle {
        background-color: yellow;
        /* Warna lingkaran saat switch ditekan */
        border-color: yellow;
        /* Warna garis lingkaran saat switch ditekan */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var gaugeValue = @json($devices[0]['nilai']);
        
        function createGauge() {
            Highcharts.chart('container', {
                chart: {
                    type: 'gauge',
                    plotBackgroundColor: null,
                    plotBackgroundImage: null,
                    plotBorderWidth: 0,
                    plotShadow: false,
                    height: '80%'
                },
                title: {
                    text: 'Speedometer'
                },
                pane: {
                    startAngle: -90,
                    endAngle: 89.9,
                    background: null,
                    center: ['50%', '75%'],
                    size: '110%'
                },
                yAxis: {
                    min: 0,
                    max: 200,
                    tickPixelInterval: 72,
                    tickPosition: 'inside',
                    tickColor: Highcharts.defaultOptions.chart.backgroundColor || '#FFFFFF',
                    tickLength: 20,
                    tickWidth: 2,
                    minorTickInterval: null,
                    labels: {
                        distance: 20,
                        style: {
                            fontSize: '14px'
                        }
                    },
                    lineWidth: 0,
                    plotBands: [
                        { from: 0, to: 130, color: '#55BF3B', thickness: 20, borderRadius: '50%' },
                        { from: 150, to: 200, color: '#DF5353', thickness: 20, borderRadius: '50%' },
                        { from: 120, to: 160, color: '#DDDF0D', thickness: 20 }
                    ]
                },
                series: [{
                    name: 'Speed',
                    data: [gaugeValue],
                    tooltip: {
                        valueSuffix: ' km/h'
                    },
                    dataLabels: {
                        format: '{y} km/h',
                        borderWidth: 0,
                        color: Highcharts.defaultOptions.title.style.color || '#333333',
                        style: {
                            fontSize: '16px'
                        }
                    },
                    dial: {
                        radius: '80%',
                        backgroundColor: 'gray',
                        baseWidth: 12,
                        baseLength: '0%',
                        rearLength: '0%'
                    },
                    pivot: {
                        backgroundColor: 'gray',
                        radius: 6
                    }
                }]
            });
        }

        createGauge();

        setInterval(function () {
            fetchLatestGaugeValue().then(newVal => {
                const chart = Highcharts.charts[0];
                if (chart && !chart.renderer.forExport) {
                    const point = chart.series[0].points[0];
                    point.update(newVal);
                }
            });
        }, 10000);

        async function fetchLatestGaugeValue() {
            try {
                const response = await fetch('/blectro/blectro/public/api/devices');
                const devices = await response.json();
                return devices[0]['nilai'];
            } catch (error) {
                console.error('Error fetching gauge value:', error);
                return gaugeValue;
            }
        }

        function updateClock() {
            const clock = document.getElementById('digitalClock');
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            clock.textContent = `${hours}:${minutes}:${seconds}`;
        }

        setInterval(updateClock, 1000);
        updateClock();

        const bellIcon = document.getElementById('bellIcon');
        const conditionText = document.getElementById('conditionText');

        function updateBellColor(temperature) {
            if (temperature >= 30) {
                bellIcon.style.color = 'red';
                conditionText.textContent = 'Danger';
            } else if (temperature >= 21 && temperature <= 29) {
                bellIcon.style.color = 'orange';
                conditionText.textContent = 'Warning';
            } else {
                bellIcon.style.color = '';
                conditionText.textContent = 'Normal';
            }
        }

        async function fetchLatestTemperature() {
            try {
                const response = await fetch('/blectro/blectro/public/api/devices');
                const devices = await response.json();
                const currentTemperature = devices[0]['nilai'];
                updateBellColor(currentTemperature);
            } catch (error) {
                console.error('Error fetching temperature:', error);
            }
        }

        fetchLatestTemperature();
        setInterval(fetchLatestTemperature, 10000);

        document.querySelectorAll('.toggle-checkbox').forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const deviceId = this.getAttribute('data-device-id');
                const status = this.checked ? 1 : 0;

                fetch("/blectro/blectro/public/toggle-led", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        device_id: deviceId,
                        data: status,
                        device_name: "LED " + deviceId,
                        devicetype: "Actuator",
                        useraction: 1,
                        statuslog: status ? "active" : "inactive"
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            console.log('LED status updated successfully.');
                        } else {
                            console.error('Failed to update LED status.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    });
</script>
@endsection
