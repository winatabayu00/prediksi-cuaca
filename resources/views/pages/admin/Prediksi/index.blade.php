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

                    <div>
                        <label>Period (ex: 11/23)</label>
                        <input
                            type="text"
                            name="data[{{ $i }}][period]"
                            value="{{ $data['period'] }}"
                            required
                        >

                        <label>Curah Hujan</label>
                        <input
                            type="number"
                            name="data[{{ $i }}][value]"
                            value="{{ $data['value'] }}"
                            step="0.01"
                            required
                        >
                    </div>
                    <br>
                @endfor

                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="reset" class="btn btn-light btn-active-light-primary me-2">BATAL</button>
                    <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">PREDIKSI</button>
                </div>
                <input type="hidden">
            </form>
        </div>
    </div>

        @if(isset($result))
            <div class="card mb-10">
                <div class="card-header">
                    <h3 class="card-title"> Hasil Prediksi </h3>

                    <div class="card-toolbar">Prediksi Curah Hujan = {{ $output ?? 0 }} {{ \App\Enums\Predict::tryFrom(\App\Enums\Predict::getPredict($output ?? 0)->value)->label() }}</div>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr class="fw-bold fs-6 text-gray-800">
                                    <th width="300px">data</th>
                                    <th width="200px">Curah Hujan</th>
                                    <th width="200px">Jarak</th>
                                    <th width="100px">Keterangan</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($result as $item)
                                    <tr>
                                        <td>( {{ implode(',', $item['window']) }} )</td>
                                        <td>{{ $item['window'][2] }}</td>
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
        @endif
@endsection
