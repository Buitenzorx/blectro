<!-- Highcharts Figure -->
<figure class="highcharts-figure">
    <div id="gaugeContainer"></div>
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
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var gaugeValue1 = @json($devices[1]['nilai']); // Mengambil nilai dari variabel PHP

        // Konfigurasi chart Highcharts untuk gauge MQ-2
        Highcharts.chart('gaugeContainer', {
            chart: {
                type: 'gauge',
                plotBackgroundColor: 'black',
                plotBackgroundImage: null,
                plotBorderWidth: 0,
                plotShadow: false,
                height: '200px'
            },
            title: {
                text: 'MQ-2 Sensor',
                style: {
                    color: 'black'
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
                max: 10000,
                tickPixelInterval: 72,
                tickPosition: 'inside',
                tickColor: Highcharts.defaultOptions.chart.backgroundColor || 'white',
                tickLength: 20,
                tickWidth: 2,
                minorTickInterval: null,
                labels: {
                    distance: 20,
                    style: {
                        fontSize: '14px',
                        color: '#FFFFFF'
                    }
                },
                lineWidth: 0,
                plotBands: [{
                    from: 0,
                    to: 150,
                    color: '#55BF3B', // green
                    thickness: 5,
                    borderRadius: '50%'
                }, {
                    from: 290,
                    to: 10000,
                    color: '#DF5353', // red
                    thickness: 5,
                    borderRadius: '50%'
                }, {
                    from: 120,
                    to: 300,
                    color: '#DDDF0D', // yellow
                    thickness: 5
                }]
            },
            series: [{
                name: 'Gas Concentrate',
                data: [gaugeValue1], // Menggunakan nilai dari variabel
                tooltip: {
                    valueSuffix: ' ppm'
                },
                dataLabels: {
                    format: '{y} ppm',
                    borderWidth: 0,
                    color: (
                        Highcharts.defaultOptions.title &&
                        Highcharts.defaultOptions.title.style &&
                        Highcharts.defaultOptions.title.style.color
                    ) || 'black',
                    style: {
                        fontSize: '16px'
                    }
                },
                dial: {
                    radius: '80%',
                    backgroundColor: 'white',
                    baseWidth: 12,
                    baseLength: '0%',
                    rearLength: '0%'
                },
                pivot: {
                    backgroundColor: 'white',
                    radius: 6
                }
            }]
        });
    });
</script>
