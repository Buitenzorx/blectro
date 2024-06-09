 <script>
    var ctx = document.getElementById('rainSensorChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: {!! json_encode($labels) !!}, // Label dari waktu pembuatan (created_at)
            datasets: [{
                label: 'Rain Sensor Data',
                data: {!! json_encode($dataValues) !!}, // Data dari device_id 2
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
  </script>