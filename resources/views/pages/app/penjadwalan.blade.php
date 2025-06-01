@extends('layouts.app-landing')

@section('app-content')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #e8f5e8 0%, #f0f8f0 100%);
            color: #333;
            line-height: 1.6;
            min-height: 100vh;
        }

        .container-fluid {
            max-width: 1000px;
            margin: 0 auto;
            padding: 2rem 1rem;
        }

        .page-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .page-header h1 {
            font-size: 2.5rem;
            color: #2E7D32;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .page-header p {
            color: #666;
            font-size: 1.1rem;
        }

        /* Enhanced Card Styles */
        .card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            margin-bottom: 2rem;
            overflow: hidden;
            transition: all 0.3s ease;
            border: none;
        }

        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .card-header {
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            color: white;
            padding: 1.5rem 2rem;
            border-bottom: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
        }

        .card-body {
            padding: 2rem;
        }

        /* Form Styles */
        .form-section {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border-left: 4px solid #4CAF50;
        }

        .row.mb-6 {
            margin-bottom: 1.5rem;
        }

        .col-form-label {
            font-weight: 600;
            color: #2E7D32;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 1rem;
        }

        .col-form-label.required::after {
            content: "*";
            color: #e74c3c;
            margin-left: 0.25rem;
        }

        .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-select:focus {
            outline: none;
            border-color: #4CAF50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.1);
        }

        .form-select:hover {
            border-color: #4CAF50;
        }

        /* Button Styles */
        .card-footer {
            display: flex;
            gap: 1rem;
            justify-content: center;
            padding: 2rem;
            background: #f8f9fa;
            margin: 0 -2rem -2rem -2rem;
            border-top: 1px solid #e0e0e0;
        }

        .btn {
            padding: 0.75rem 2rem;
            border: none;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            min-width: 120px;
            justify-content: center;
        }

        .btn-primary {
            background: linear-gradient(135deg, #4CAF50, #66BB6A);
            color: white;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
            color: white;
        }

        .btn-light {
            background: #f8f9fa;
            color: #666;
            border: 2px solid #e0e0e0;
        }

        .btn-light:hover {
            background: #e9ecef;
            border-color: #adb5bd;
            color: #666;
        }

        .btn-info {
            background: linear-gradient(135deg, #2196F3, #42A5F5);
            color: white;
            box-shadow: 0 4px 15px rgba(33, 150, 243, 0.3);
        }

        .btn-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(33, 150, 243, 0.4);
            color: white;
        }

        /* Results Table */
        .card-toolbar {
            display: flex;
            align-items: center;
        }

        .table-responsive {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        }

        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        .table thead {
            background: linear-gradient(135deg, #2E7D32, #388E3C);
            color: white;
        }

        .table th {
            padding: 1rem;
            text-align: left;
            font-weight: 600;
            border: none;
            color: white;
        }

        .table td {
            padding: 1rem;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }

        .table tbody tr:hover {
            background: #f8f9fa;
        }

        .table tbody tr:last-child td {
            border-bottom: none;
        }

        /* Status Indicators */
        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .status-menanam {
            background: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
        }

        .status-panen {
            background: #fff3e0;
            color: #f57c00;
            border: 1px solid #ffcc02;
        }

        .status-hati-hati {
            background: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
        }

        .status-tidak-ada {
            background: #f5f5f5;
            color: #757575;
            border: 1px solid #e0e0e0;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container-fluid {
                padding: 0 0.5rem;
            }

            .page-header h1 {
                font-size: 2rem;
                flex-direction: column;
                gap: 0.5rem;
            }

            .card-body {
                padding: 1.5rem;
            }

            .card-footer {
                flex-direction: column;
                align-items: center;
            }

            .btn {
                width: 100%;
                max-width: 200px;
            }

            .card-header {
                flex-direction: column;
                gap: 1rem;
                align-items: stretch;
            }

            .table-responsive {
                overflow-x: auto;
            }

            .table {
                min-width: 600px;
            }
        }

        /* Animation */
        .fade-in {
            animation: fadeIn 0.5s ease-in;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <div class="container-fluid">
        <!-- Page Header -->
        <div class="page-header fade-in">
            <h1>
                <i class="fas fa-cloud-sun"></i>
                Prediksi Cuaca Melon
            </h1>
            <p>Tentukan waktu terbaik untuk menanam melon berdasarkan prediksi cuaca</p>
        </div>

        <!-- Prediction Form -->
        <div class="card fade-in">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-chart-line"></i>
                    Form Prediksi
                </h3>
            </div>
            <div class="card-body">
                <form class="form fv-plugins-bootstrap5 fv-plugins-framework" method="GET" novalidate="novalidate">
                    <div class="form-section">
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                                <i class="fas fa-calendar-alt"></i>
                                TAHUN
                            </label>
                            <div class="col-lg-8">
                                <select class="form-select form-select-solid" data-control="select2"
                                        data-placeholder="Pilih Tahun"
                                        data-allow-clear="true" name="year">
                                    <option></option>
                                    @foreach($years as $year)
                                        <option value="{{$year['id']}}" @selected(request()->input('year', now()->format('Y')) == $year['id'])>
                                            {{$year['name']}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-section">
                        <div class="row mb-6">
                            <label class="col-lg-4 col-form-label required fw-semibold fs-6">
                                <i class="fas fa-calendar"></i>
                                BULAN
                            </label>
                            <div class="col-lg-8">
                                <select class="form-select form-select-solid" data-control="select2"
                                        data-placeholder="Pilih Bulan"
                                        data-allow-clear="true" name="month">
                                    <option></option>
                                    @foreach($months as $month)
                                        <option value="{{$month['id']}}" @selected(request()->input('month', now()->format('m')) == $month['id'])>
                                            {{$month['name']}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                        <button type="reset" class="btn btn-light btn-active-light-primary me-2">
                            <i class="fas fa-times"></i>
                            BATAL
                        </button>
                        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                            <i class="fas fa-search"></i>
                            PREDIKSI
                        </button>
                    </div>
                    <input type="hidden">
                </form>
            </div>
        </div>

        <!-- Results Section -->
        @if(isset($result))
            <div class="card fade-in">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-calendar-check"></i>
                        Jadwal Penanaman Melon
                    </h3>
                    <div class="card-toolbar">
                        <a class="btn btn-info"
                           href="{{ route('penjadwalan.pdf', ['year' => request()->input('year'), 'month' => request()->input('month')]) }}"
                           target="_blank">
                            <i class="fas fa-file-pdf"></i>
                            PDF
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <div class="table-responsive">
                            <table class="table p-6">
                                <thead>
                                <tr class="fw-bold fs-6">
                                    <th width="100px">
                                        <i class="fas fa-calendar-alt"></i>
                                        Tahun
                                    </th>
                                    <th width="120px">
                                        <i class="fas fa-calendar"></i>
                                        Bulan
                                    </th>
                                    <th>
                                        <i class="fas fa-tasks"></i>
                                        Agenda Kegiatan
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $isMenanam = false;
                                @endphp
                                @foreach($result as $key => $data)
                                    @php
                                        $date = \Carbon\CarbonImmutable::createFromDate($data->year, $data->month, '01');
                                        $curahHujan = \App\Enums\Predict::getPredict($data->curah_hujan)->value;
                                        if ($key == 0 && in_array($curahHujan, [\App\Enums\Predict::LOW->value, \App\Enums\Predict::MEDIUM->value])){
                                            $isMenanam = true;
                                        }
                                    @endphp

                                    @continue($key > 0 && !$isMenanam)

                                    @if(!$isMenanam)
                                        <tr>
                                            <td>{{ $date->format('Y') }}</td>
                                            <td>{{ $date->format('F') }}</td>
                                            <td>
                                                <span class="status-badge status-tidak-ada">
                                                    <i class="fas fa-exclamation-triangle"></i>
                                                    Tidak Ada Agenda Menanam Pada Bulan Ini
                                                </span>
                                            </td>
                                        </tr>
                                    @endif

                                    @if($isMenanam)
                                        @if($key < 2)
                                            <tr>
                                                <td>{{ $date->format('Y') }}</td>
                                                <td>{{ $date->format('F') }}</td>
                                                <td>
                                                    @if(in_array($curahHujan, [\App\Enums\Predict::HIGH->value, \App\Enums\Predict::VERY_HIGH->value]))
                                                        <span class="status-badge status-hati-hati">
                                                            <i class="fas fa-exclamation-circle"></i>
                                                            Hati Hati {{ \App\Enums\Predict::tryFrom($curahHujan)->information() }}
                                                        </span>
                                                    @else
                                                        <span class="status-badge status-menanam">
                                                            <i class="fas fa-seedling"></i>
                                                            {{ \App\Enums\Predict::tryFrom($curahHujan)->informationMessage() }}
                                                        </span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{ $date->format('Y') }}</td>
                                                <td>{{ $date->format('F') }}</td>
                                                <td>
                                                    <span class="status-badge status-panen">
                                                        <i class="fas fa-apple-alt"></i>
                                                        Masa Panen
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Form submission handling with loading state
            const form = document.querySelector('.form');
            const submitBtn = document.getElementById('kt_account_profile_details_submit');

            if (form && submitBtn) {
                form.addEventListener('submit', function(e) {
                    const originalText = submitBtn.innerHTML;

                    // Show loading state
                    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
                    submitBtn.disabled = true;

                    // Re-enable button after a delay (in case of errors)
                    setTimeout(() => {
                        submitBtn.innerHTML = originalText;
                        submitBtn.disabled = false;
                    }, 5000);
                });
            }

            // Add smooth scrolling to results if they exist
            const resultsSection = document.querySelector('.card.fade-in:last-child');
            if (resultsSection && window.location.search) {
                setTimeout(() => {
                    resultsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }, 500);
            }
        });
    </script>
@endsection
