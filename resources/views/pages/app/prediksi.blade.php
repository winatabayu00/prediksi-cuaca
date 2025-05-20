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
                                        <th width="100px">Keterangan</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($result as $key => $data)
                                        @php
                                            $date = \Carbon\Carbon::createFromDate($data->year, $data->month, '01');
                                            if ($key < 2){
                                                $menanam = in_array(\App\Enums\Predict::getPredict($data->curah_hujan)->value, ['medium', 'low']);
                                            }
                                        @endphp
                                        @if($key < 2)
                                            <tr>
                                                <td>{{ $date->format('Y') }}</td>
                                                <td>{{ $date->format('F') }}</td>
                                                <td>{{ $data->curah_hujan }}</td>
                                                <td>{{ $menanam ? 'Menanam' : 'Tidak disarankan menanam di bulan ini' }}</td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{ $date->format('Y') }}</td>
                                                <td>{{ $date->format('F') }}</td>
                                                <td>{{ $data->curah_hujan }}</td>
                                                <td>{{ $menanam ? 'Memanen' : 'Tidak ada agenda penanaman' }}</td>
                                            </tr>
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
    </div>

@endsection
