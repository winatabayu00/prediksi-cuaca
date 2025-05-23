@extends('layouts.app-landing')

@section('app-content')
    <div class="card">
        <div class="card-body">
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
                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                            <button type="reset" class="btn btn-light btn-active-light-primary me-2">BATAL</button>
                            <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
                                PREDIKSI
                            </button>
                        </div>
                        <input type="hidden">
                    </form>
                </div>
            </div>

            @if(isset($result))
                <div class="card mb-10">
                    <div class="card-header">
                        <h3 class="card-title"> Hasil Prediksi </h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <th width="100px">Tahun</th>
                                        <th width="100px">Bulan</th>
                                        <th width="200px">Curah Hujan</th>
                                        <th width="400px">Keterangan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($result as $key => $data)
                                        @php
                                            $date = \Carbon\CarbonImmutable::createFromDate($data->year, $data->month, '01');
                                            $curahHujan = \App\Enums\Predict::getPredict($data->curah_hujan)->value;

                                        @endphp
                                        <tr>
                                            <td>{{ $date->format('Y') }}</td>
                                            <td>{{ $date->format('F') }}</td>
                                            <td>{{ $data->curah_hujan }}</td>
                                            <td>{{ \App\Enums\Predict::tryFrom($curahHujan)->information() }} {{ \App\Enums\Predict::tryFrom($curahHujan)->informationMessage() }}</td>
                                        </tr>
                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
