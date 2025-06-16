To adjust the dashboard view based on the data sent from the controller, we can implement conditional rendering for each section. If the data is not available, we can either hide the section or replace it with a default message or content. Below is the modified version of your dashboard code that incorporates these changes:

```blade
@extends('layouts.app')

@section('page-content')
    <!-- Stats Cards Row -->
    <div class="row g-5 g-xl-8 mb-5 mb-xl-8">
        @if(isset($totalPredictions))
            <!-- Total Prediksi -->
            <div class="col-xl-3">
                <div class="card card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-50px me-5">
                                <span class="symbol-label bg-light-success">
                                    <i class="fas fa-seedling text-success fs-2x"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <a href="#" class="text-dark fw-bold text-hover-primary fs-6">Total Prediksi</a>
                                <span class="text-muted fw-semibold d-block">{{ $totalPredictions ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-xl-3">
                <div class="card card-xl-stretch mb-xl-8">
                    <div class="card-body text-center">
                        <span class="text-muted fw-semibold d-block">Data Total Prediksi tidak tersedia</span>
                    </div>
                </div>
            </div>
        @endif

        @if(isset($monthlyPredictions))
            <!-- Prediksi Bulan Ini -->
            <div class="col-xl-3">
                <div class="card card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-50px me-5">
                                <span class="symbol-label bg-light-primary">
                                    <i class="fas fa-calendar text-primary fs-2x"></i>
                                </span>
                            </div>
                            <div class="flex-grow-1">
                                <a href="#" class="text-dark fw-bold text-hover-primary fs-6">Tahun Ini</a>
                                <span class="text-muted fw-semibold d-block">{{ $monthlyPredictions ?? 0 }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-xl-3">
                <div class="card card-xl-stretch mb-xl-8">
                    <div class="card-body text-center">
                        <span class="text-muted fw-semibold d-block">Data Prediksi Tahun Ini tidak tersedia</span>
                    </div>
                </div>
            </div>
        @endif

    </div>

    <!-- Charts Row -->
    <div class="row g-5 g-xl-8 mb-5 mb-xl-8">
        @if(isset($chartData) && !empty($chartData['series']))
            <!-- Curah Hujan Chart -->
            <div class="col-xl-12">
                <div class="card card-bordered">
                    <div class="card-header border-0 pt-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1">Data Curah Hujan</span>
                            <span class="text-muted fw-semibold fs-7">Monitoring curah hujan untuk prediksi optimal</span>
                        </h3>
                    </div>
                    <div class="card-body">
                        <div id="kt_apexcharts_3" style="height: 350px;"></div>
                    </div>
                </div>
            </div>
        @else
            <div class="col-xl-12">
                <div class="card card-bordered">
                    <div class="card-body text-center">
                        <span class="text-muted fw-semibold d-block">Data Curah Hujan tidak tersedia</span>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Activity and Recent Predictions Row -->
    <div class="row g-5 g-xl-8">
        <!-- Recent Activity -->
        <div class="col-xl-6">
            <div class="card card-bordered">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Aktivitas Terbaru</span>
                        <span class="text-muted fw-semibold fs-7">Log aktivitas sistem</span>
                    </h3>
                </div>
                <div class="card-body pt-3">
                    <div class="timeline timeline-border-dashed">
                        @if(isset($recentActivities) && count($recentActivities) > 0)
                            @foreach($recentActivities as $activity)
                                <div class="timeline-item">
                                    <div class="timeline-line w-40px"></div>
                                    <div class="timeline-icon symbol symbol-circle symbol-40px">
                                        <div class="symbol-label bg-light-primary">
                                            <i class="fas fa-{{ $activity['icon'] ?? 'user' }} text-primary fs-6"></i>
                                        </div>
                                    </div>
                                    <div class="timeline-content mb-10 mt-n1">
                                        <div class="pe-3 mb-5">
                                            <div class="fs-5 fw-semibold mb-2">{{ $activity['title'] ?? 'Aktivitas Baru' }}</div>
                                            <div class="d-flex align-items-center mt-1 fs-6">
                                                <div class="text-muted me-2 fs-7">{{ $activity['time'] ?? now()->diffForHumans() }}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="timeline-item">
                                <div class="timeline-line w-40px"></div>
                                <div class="timeline-icon symbol symbol-circle symbol-40px">
                                    <div class="symbol-label bg-light-success">
                                        <i class="fas fa-seedling text-success fs-6"></i>
                                    </div>
                                </div>
                                <div class="timeline-content mb-10 mt-n1">
                                    <div class="pe-3 mb-5">
                                        <div class="fs-5 fw-semibold mb-2">Tidak ada aktivitas terbaru</div>
                                        <div class="d-flex align-items-center mt-1 fs-6">
                                            <div class="text-muted me-2 fs-7">Belum ada aktivitas yang tercatat.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Top Predictions -->
        <div class="col-xl-6">
            <div class="card card-bordered">
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bold fs-3 mb-1">Prediksi Terbaru</span>
                        <span class="text-muted fw-semibold fs-7">Hasil prediksi terkini</span>
                    </h3>
                </div>
                <div class="card-body pt-3">
                    <div class="table-responsive">
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <thead>
                            <tr class="fw-bold text-muted">
                                <th class="min-w-100px">Status</th>
                                <th class="min-w-100px">Waktu</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($recentPredictions) && count($recentPredictions) > 0)
                                @foreach($recentPredictions as $prediction)
                                    <tr>
                                        <td>
                                            @php
                                                $status = $prediction['status'] ?? 'low';
                                                $badgeClass = match($status) {
                                                    'low' => 'badge-light-success',
                                                    'medium' => 'badge-light-primary',
                                                    'high' => 'badge-light-warning',
                                                    'very_high' => 'badge-light-danger',
                                                    default => 'badge-light-success'
                                                };
                                            @endphp
                                            <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                                        </td>
                                        <td>
                                            <span class="text-muted fw-semibold">{{ $prediction['time'] }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada prediksi terbaru.</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Original Rainfall Chart - Enhanced error handling
            const chartCategories = @json($chartData['categories'] ?? []);
            const chartSeries = @json($chartData['series'] ?? []);

            var element = document.getElementById('kt_apexcharts_3');

            if (element) {
                // Check if data is valid
                if (!Array.isArray(chartSeries) || chartSeries.length === 0) {
                    console.warn('Chart series data is empty or invalid');
                    element.innerHTML = '<div class="d-flex align-items-center justify-content-center h-100"><span class="text-muted">Data tidak tersedia</span></div>';
                    return;
                }

                var height = 350;
                if (typeof KTUtil !== '' && KTUtil.css) {
                    height = parseInt(KTUtil.css(element, 'height')) || 350;
                }

                var labelColor = '#A1A5B7';
                var borderColor = '#E4E6EF';
                var baseColor = '#00B5E2';
                var lightColor = '#D1F3FF';

                var options = {
                    series: [{
                        name: 'Curah Hujan (mm)',
                        data: chartSeries
                    }],
                    chart: {
                        fontFamily: 'inherit',
                        type: 'area',
                        height: height,
                        toolbar: { show: false }
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
                                return val + ' mm';
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

                try {
                    if (typeof ApexCharts !== '') {
                        var chart = new ApexCharts(element, options);
                        chart.render();
                    } else {
                        console.error('ApexCharts library not loaded');
                        element.innerHTML = '<div class="d-flex align-items-center justify-content-center h-100"><span class="text-muted">Chart library tidak tersedia</span></div>';
                    }
                } catch (error) {
                    console.error('Error rendering chart:', error);
                    element.innerHTML = '<div class="d-flex align-items-center justify-content-center h-100"><span class="text-muted">Error memuat chart</span></div>';
                }
            }

            // Donut Chart for Prediction Status - Enhanced error handling
            var donutElement = document.getElementById('kt_apexcharts_donut');
            if (donutElement) {
                const predictionStatusData = @json($predictionStatusData ?? [44, 32, 24]);

                // Validate donut data
                if (!Array.isArray(predictionStatusData) || predictionStatusData.length === 0) {
                    console.warn('Donut chart data is empty or invalid');
                    donutElement.innerHTML = '<div class="d-flex align-items-center justify-content-center h-100"><span class="text-muted">Data status tidak tersedia</span></div>';
                    return;
                }

                var donutOptions = {
                    series: predictionStatusData,
                    chart: {
                        fontFamily: 'inherit',
                        type: 'donut',
                        height: 350
                    },
                    labels: ['Optimal', 'Baik', 'Cukup'],
                    colors: ['#50CD89', '#FFC700', '#F1416C'],
                    legend: {
                        position: 'bottom',
                        horizontalAlign: 'center'
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '65%',
                                labels: {
                                    show: true,
                                    name: {
                                        show: true,
                                        fontSize: '18px',
                                        fontWeight: 600,
                                        color: '#A1A5B7'
                                    },
                                    value: {
                                        show: true,
                                        fontSize: '26px',
                                        fontWeight: 600,
                                        color: '#181C32'
                                    },
                                    total: {
                                        show: true,
                                        showAlways: false,
                                        label: 'Total',
                                        fontSize: '16px',
                                        fontWeight: 600,
                                        color: '#A1A5B7'
                                    }
                                }
                            }
                        }
                    },
                    dataLabels: {
                        enabled: false
                    }
                };

                try {
                    if (typeof ApexCharts !== 'undefined') {
                        var donutChart = new ApexCharts(donutElement, donutOptions);
                        donutChart.render();
                    } else {
                        console.error('ApexCharts library not loaded for donut chart');
                        donutElement.innerHTML = '<div class="d-flex align-items-center justify-content-center h-100"><span class="text-muted">Chart library tidak tersedia</span></div>';
                    }
                } catch (error) {
                    console.error('Error rendering donut chart:', error);
                    donutElement.innerHTML = '<div class="d-flex align-items-center justify-content-center h-100"><span class="text-muted">Error memuat status chart</span></div>';
                }
            }
        });
    </script>
@endpush
