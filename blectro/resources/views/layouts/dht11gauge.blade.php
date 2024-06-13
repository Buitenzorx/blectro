<!-- Highcharts Figure -->
<figure class="highcharts-figure">
    <div id="dhtContainer"></div>
</figure>

<!-- CSS untuk gauge -->
<style>
    .highcharts-figure,
    .highcharts-data-table table {
        min-width: 310px;
        max-width: 500px;
        margin: 1em auto;

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
</style>

<!-- JavaScript untuk gauge -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-more.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Function to fetch data and update the chart
        function fetchDataAndRenderChart() {
            fetch('/api/devices')
                .then(response => response.json())
                .then(data => {
                    var gaugeValue = data[0]['nilai'];
                    var chart = Highcharts.charts[1];
                    chart.series[0].setData([gaugeValue]);
                })
                .catch(error => console.error('Error fetching data:', error));

        }

        // Render chart initially
        var gaugeValue = @json($devices[0]['nilai']);
        Highcharts.chart('dhtContainer', {
            chart: {
                type: 'gauge',
                plotBackgroundColor: 'black', // Set the plot background to black
                plotBackgroundImage: null,
                plotBorderWidth: 0,
                plotShadow: false,
                height: '200px' // Sesuaikan sesuai kebutuhan
            },
            title: {
                text: 'DHT11 Sensor',
                style: {
                    color: 'black' // Set title color to white
                }
            },
            pane: {
                startAngle: -90,
                endAngle: 89.9,
                background: null,
                center: ['50%', '75%'],
                size: '110%'
            },
            // Konfigurasi sumbu nilai
            yAxis: {
                min: 0,
                max: 40,
                tickPixelInterval: 72,
                tickPosition: 'inside',
                tickColor: '#FFFFFF', // Set tick color to white
                tickLength: 20,
                tickWidth: 2,
                minorTickInterval: null,
                labels: {
                    distance: 20,
                    style: {
                        fontSize: '14px',
                        color: '#FFFFFF' // Set label color to white
                    }
                },
                lineWidth: 0,
                plotBands: [{
                    from: 0,
                    to: 20,
                    color: '#55BF3B', // green
                    thickness: 5,
                    borderRadius: '50%'
                }, {
                    from: 30,
                    to: 40,
                    color: '#DF5353', // red
                    thickness: 5,
                    borderRadius: '50%'
                }, {
                    from: 20,
                    to: 30,
                    color: '#DDDF0D', // yellow
                    thickness: 5
                }]
            },
            series: [{
                name: 'Temperature',
                data: [gaugeValue], // Menggunakan nilai dari variabel
                tooltip: {
                    valueSuffix: ' Celcius'
                },
                dataLabels: {
                    format: '{y} Celcius',
                    borderWidth: 0,
                    color: '#FFFFFF', // Set data label color to white
                    style: {
                        fontSize: '16px'
                    }
                },
                dial: {
                    radius: '80%',
                    backgroundColor: '#FFFFFF', // Set dial color to white
                    baseWidth: 12,
                    baseLength: '0%',
                    rearLength: '0%'
                },
                pivot: {
                    backgroundColor: '#FFFFFF', // Set pivot color to white
                    radius: 6
                }
            }]
        });

        // Auto-refresh chart every 1 second
        setInterval(fetchDataAndRenderChart, 1000);
    });
</script>
