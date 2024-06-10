<script>
    document.addEventListener('DOMContentLoaded', function() {
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

        // Function to fetch latest rain sensor data
        function fetchLatestRainSensorData() {
            // No need to fetch data from an endpoint if you're using PHP variables directly
            // Update chart data with the latest values
            // Assuming $labels and $dataValues are updated dynamically elsewhere in your code
            myChart.data.labels = {!! json_encode($labels) !!};
            myChart.data.datasets[0].data = {!! json_encode($dataValues) !!};
            myChart.update();
        }
        fetchLatestRainSensorData();
        // Fetch latest rain sensor data every 5 seconds
        setInterval(fetchLatestRainSensorData, 5000); // Adjust interval as needed
    });
</script>
