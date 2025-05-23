@extends('layouts.app-landing')

@section('app-content')
    <div class="card mb-10">
        <div class="card-header">
            <h3 class="card-title"> Prediksi </h3>
        </div>
        <div class="card-body">
            <form class="form fv-plugins-bootstrap5 fv-plugins-framework p-5" novalidate="novalidate">
                <div class="card-body border-top p-2">
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">TAHUN</label>

                        <select class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Pilih Tahun"
                                data-allow-clear="true" name="year">
                            <option></option>
                            @foreach($years as $year)
                                <option
                                    value="{{$year['id']}}" @selected(request()->input('year', now()->format('Y')) == $year['id'])> {{$year['name']}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card-body border-top p-2">
                    <div class="row mb-6">
                        <label class="col-lg-4 col-form-label required fw-semibold fs-6">BULAN</label>

                        <select class="form-select form-select-solid" data-control="select2"
                                data-placeholder="Pilih Bulan"
                                data-allow-clear="true" name="month">
                            <option></option>
                            @foreach($months as $month)
                                <option
                                    value="{{$month['id']}}" @selected(request()->input('month', now()->format('m')) == $month['id'])> {{$month['name']}} </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="reset" class="btn btn-light btn-active-light-primary me-2">BATAL</button>
                    <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">PREDIKSI
                    </button>
                </div>
                <input type="hidden">
            </form>
        </div>
    </div>

    @if(isset($result))
        <div class="card mb-10">
            <div class="card-header">
                <h3 class="card-title"> Jadwal </h3>
                <div class="card-toolbar">
                    <a class="btn btn-info"
                       href="{{ route('penjadwalan.pdf', ['year' => request()->input('year'), 'month' => request()->input('month')]) }}"
                       target="_blank">PDF</a>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center">
                    <div class="table-responsive">
                        <table class="table ">
                            <thead>
                            <tr class="fw-bold fs-6 text-gray-800">
                                <th width="100px">Tahun</th>
                                <th width="100px">Bulan</th>
                                <th width="400px">Agenda</th>
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
                                        <td>Tidak Ada Agenda Menanam Pada Bulan Ini</td>
                                    </tr>
                                @endif


                                @if($isMenanam)
                                    @if($key < 2)
                                        <tr>
                                            <td>{{ $date->format('Y') }}</td>
                                            <td>{{ $date->format('F') }}</td>
                                            <td>@if(in_array($curahHujan, [\App\Enums\Predict::HIGH->value, \App\Enums\Predict::VERY_HIGH->value]))
                                                    Hati
                                                    Hati {{ \App\Enums\Predict::tryFrom($curahHujan)->information() }}
                                                @else
                                                    {{ \App\Enums\Predict::tryFrom($curahHujan)->informationMessage() }}
                                                @endif </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td>{{ $date->format('Y') }}</td>
                                            <td>{{ $date->format('F') }}</td>
                                            <td>Memanen</td>
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
@endsection
