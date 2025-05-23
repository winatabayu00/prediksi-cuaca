@extends('layouts.app')

@section('page-content')
    <div class="card card-bordered">
        <div class="card-body">
            <div id="kt_apexcharts_3" style="height: 350px;"></div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const chartCategories = @json($chartData['categories']);
            const chartSeries = @json($chartData['series']);

            var element = document.getElementById('kt_apexcharts_3');

            if (!element || typeof KTUtil === 'undefined') {
                console.warn('Chart element or KTUtil not found.');
                return;
            }

            var height = parseInt(KTUtil.css(element, 'height')) || 350;
            var labelColor = '#A1A5B7';      // Abu-abu label
            var borderColor = '#E4E6EF';     // Border
            var baseColor = '#00B5E2';       // Warna garis utama
            var lightColor = '#D1F3FF';      // Warna isi area

            var options = {
                series: [{
                    name: 'Curah Hujan',
                    data: chartSeries
                }],
                chart: {
                    fontFamily: 'inherit',
                    type: 'area',
                    height: height,
                    toolbar: {
                        show: false
                    }
                },
                legend: { show: false },
                dataLabels: { enabled: false },
                fill: {
                    type: 'solid',
                    opacity: 1
                },
                stroke: {
                    curve: 'smooth',
                    show: true,
                    width: 3,
                    colors: [baseColor]
                },
                xaxis: {
                    categories: chartCategories,
                    axisBorder: { show: false },
                    axisTicks: { show: false },
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    },
                    crosshairs: {
                        position: 'front',
                        stroke: {
                            color: baseColor,
                            width: 1,
                            dashArray: 3
                        }
                    },
                    tooltip: { enabled: true }
                },
                yaxis: {
                    labels: {
                        style: {
                            colors: labelColor,
                            fontSize: '12px'
                        }
                    }
                },
                tooltip: {
                    style: { fontSize: '12px' },
                    y: {
                        formatter: function (val) {
                            return val ;
                        }
                    }
                },
                colors: [lightColor],
                grid: {
                    borderColor: borderColor,
                    strokeDashArray: 4,
                    yaxis: {
                        lines: { show: true }
                    }
                },
                markers: {
                    strokeColor: baseColor,
                    strokeWidth: 3
                }
            };

            var chart = new ApexCharts(element, options);
            chart.render();
        });
    </script>
@endpush
