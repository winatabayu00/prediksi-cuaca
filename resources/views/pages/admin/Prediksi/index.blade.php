@extends('layouts.app')


@section('page-content')
    <div class="card mb-10">
        <div class="card-header">
            <h3 class="card-title"> Prediksi </h3>
        </div>
        <div class="card-body">
            <form class="form fv-plugins-bootstrap5 fv-plugins-framework p-5" novalidate="novalidate">
                @for ($i = 0; $i < 3; $i++)
                    @php
                        $data = request('data')[$i] ?? ['period' => '', 'value' => ''];
                    @endphp

                    <div class="d-flex row">
                        <div class="col-6">
                            <label>Dalam Periode <em>(bulan/tahun)</em></label>
                            <input
                                class="form-control"
                                type="text"
                                name="data[{{ $i }}][period]"
                                value="{{ $data['period'] }}"
                                required
                            >
                        </div>
                        <div class="col-6">
                            <label>Tingkat Curah Hujan</label>
                            <input
                                class="form-control"
                                type="number"
                                name="data[{{ $i }}][value]"
                                value="{{ $data['value'] }}"
                                step="0.01"
                                required
                            >
                        </div>

                    </div>
                    <br>
                @endfor

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
                <h3 class="card-title"> Hasil Prediksi </h3>
            </div>
            <div class="card-body">
                <div class="card mb-10">
                    <div class="card-header">
                        <h3 class="card-title"> K = 7 </h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <th width="300px">Periode</th>
{{--                                        <th width="300px">data</th>--}}
                                        <th width="200px">Curah Hujan</th>
                                        <th width="200px">Jarak</th>
                                        <th width="100px">Keterangan</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @php
                                        $count = 0;
                                        $curahHujan = 0;
                                    @endphp
                                    @foreach($result as $key => $item)
                                        @php
                                            $count++;
                                        @endphp
                                        @continue($count > 7)
                                        @php
                                            $curahHujan += $item['window'][3];
                                        @endphp
                                        <tr>
                                            <td>( {{ implode(',', $item['periode']) }} )</td>
{{--                                            <td>( {{ implode(',', $item['window']) }} )</td>--}}
                                            <td>{{ $item['window'][3] }}</td>
                                            <td>{{ $item['distance'] }}</td>
                                            <td>{{ \App\Enums\Predict::tryFrom(\App\Enums\Predict::getPredict($item['window'][2])->value)->label() }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td>Tingkat Curah Hujan: {{ round(($curahHujan / 7), 0) }}</td>
                                        <td>
                                            Kesimpulan: {{ \App\Enums\Predict::tryFrom(\App\Enums\Predict::getPredict((int)($curahHujan / 7))->value)->label() }}</td>
                                        <td>
                                            <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#kt_modal_1">Simpan
                                            </button>
                                        </td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title"> Data Prediksi </h3>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-center">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr class="fw-bold fs-6 text-gray-800">
                                        <th width="300px">No</th>
                                        <th width="300px">Periode</th>
{{--                                        <th width="300px">data</th>--}}
                                        <th width="200px">Curah Hujan</th>
                                        <th width="200px">Jarak</th>
                                        <th width="100px">Keterangan</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @php
                                        $count = 0;
                                    @endphp
                                    @foreach($result as $item)
                                        @php
                                        $count++;
                                        @endphp
{{--                                        @continue(!isset($result[$count]))--}}
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>( {{ implode(',', $item['periode']) }} )</td>
{{--                                            <td>( {{ implode(',', $item['window']) }} )</td>--}}
                                            <td>{{ $item['window'][3]  }}</td>
                                            <td>{{ $item['distance'] }}</td>
                                            <td>{{ \App\Enums\Predict::tryFrom(\App\Enums\Predict::getPredict($item['window'][2])->value)->label() }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    @endif


    <div class="modal fade" tabindex="-1" id="kt_modal_1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Simpan Hasil Prediksi</h3>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal"
                         aria-label="Close">
                        <i class="fa-solid fa-circle-xmark fs-2"></i>
                    </div>
                    <!--end::Close-->
                </div>

                <form action="{{ route('admin.dataset.store') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-4 row mb-6">
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">TAHUN</label>

                                <select class="form-select" data-control="select2"
                                        data-placeholder="Pilih Tahun"
                                        data-allow-clear="true" name="year">
                                    <option></option>
                                    @foreach($years as $year)
                                        <option
                                            value="{{$year['id']}}" @selected(request()->input('year', now()->format('Y')) == $year['id'])> {{$year['name']}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-4 row mb-6">
                                <label class="col-lg-4 col-form-label required fw-semibold fs-6">BULAN</label>

                                <select class="form-select" data-control="select2"
                                        data-placeholder="Pilih Bulan"
                                        data-allow-clear="true" name="month">
                                    <option></option>
                                    @foreach($months as $month)
                                        <option
                                            value="{{$month['id']}}" @selected(request()->input('month', now()->format('m')) == $month['id'])> {{$month['name']}} </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-4 row mb-6">
                                <label class="col-form-label required fw-semibold fs-6">CURAH HUJAN</label>

                                <input type="number" class="form-control" name="curah_hujan" placeholder="Curah Hujan" min="0">
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
