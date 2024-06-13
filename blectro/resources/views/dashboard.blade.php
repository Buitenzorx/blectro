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
            <div id="dhtContainer"></div>
        </div>
        <div class="col-md-3 d-flex justify-content-center align-items-center">
            <div id="gaugeContainer"></div>
        </div>
        <div class="col-md-1 mt-2">
            <label class="toggle">
                <input class="toggle-checkbox" type="checkbox" data-device-id="4"
                    {{ $devices->find(4)->data == 1 ? 'checked' : '' }}>
                <div class="toggle-switch">
                    <div class="toggle-circle"></div> <!-- Lingkaran -->
                </div>
                <span class="toggle-label">LED 1</span>
            </label>
        </div>
        <div class="col-md-1 mt-2">
            <label class="toggle">
                <input class="toggle-checkbox" type="checkbox" data-device-id="10"
                    {{ $devices->find(10)->data == 1 ? 'checked' : '' }}>
                <div class="toggle-switch">
                    <div class="toggle-circle"></div> <!-- Lingkaran -->
                </div>
                <span class="toggle-label">LED 2</span>
            </label>
        </div>
        <div class="col-md-1 mt-2">
            <label class="toggle">
                <input class="toggle-checkbox" type="checkbox" data-device-id="11"
                    {{ $devices->find(11)->data == 1 ? 'checked' : '' }}>
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
                    <div id="clockContainer">
                    </div>
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
    </div>
    <div class="row">
        <div class="col-md-6">
            @include('layouts.mq2gauge')
        </div>
        <div class="col-md-6">
            @include('layouts.dht11gauge')
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('layouts.raingraph')
        </div>
    </div>

    <style>
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
        document.addEventListener('DOMContentLoaded', function() {
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
            // Mendapatkan referensi ke elemen ikon lonceng
            const bellIcon = document.getElementById('bellIcon');

            // Fungsi untuk memperbarui warna ikon lonceng
            // Fungsi untuk memperbarui warna ikon lonceng dan menampilkan kondisi teks di sampingnya
            function updateBellColor(temperature) {
                // Dapatkan referensi ke elemen yang menampilkan teks kondisi
                const conditionText = document.getElementById('conditionText');

                // Jika suhu mencapai 30 derajat atau lebih, ubah warna ikon lonceng menjadi merah dan teks menjadi "Danger"
                if (temperature >= 30) {
                    bellIcon.style.color = 'red';
                    conditionText.textContent = 'Danger';
                } else if (temperature >= 21 && temperature <= 29) {
                    bellIcon.style.color = 'orange';
                    conditionText.textContent = 'Warning';
                } else {
                    bellIcon.style.color = ''; // Hapus warna khusus jika suhu tidak mencapai 30 derajat
                    conditionText.textContent =
                        'Normal'; // Atur teks menjadi "Normal" jika suhu di bawah 30 derajat
                }
            }


            // Fungsi untuk melakukan pemanggilan AJAX ke server untuk mendapatkan nilai suhu terbaru
            function fetchLatestTemperature() {
                fetch('https://tugas-akhir.blectric.web.id/blectro/blectro/public/api/devices') // Pemanggilan ke endpoint yang sesuai
                    .then(response => response.json())
                    .then(devices => { // Define variabel 'devices' di sini
                        const currentTemperature = devices[0]['nilai']; // Mengambil nilai suhu dari respons
                        updateBellColor(currentTemperature);
                    })
                    .catch(error => {
                        console.error('Error fetching temperature:', error);
                    });
            }

            // Pemanggilan awal untuk memeriksa suhu saat halaman dimuat
            fetchLatestTemperature();

            // Mendengarkan perubahan suhu secara periodik dengan melakukan pemanggilan AJAX
            setInterval(fetchLatestTemperature, 10000); // Contoh: Memeriksa suhu setiap detik
        });

        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.toggle-checkbox').forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    const deviceId = this.getAttribute('data-device-id');
                    const status = this.checked ? 1 : 0;

                    fetch(" {{ route('toggle-led') }} ", {
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
