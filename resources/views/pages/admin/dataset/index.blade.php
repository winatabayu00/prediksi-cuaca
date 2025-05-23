@extends('layouts.app')

@section('page-content')
    <div class="card mb-10">
        <div class="card-body row">
            <div class="col-md-4">
                <div class="d-flex justify-content-center">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Periode</th>
                                <th>Curah Hujan</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($dataCurahHujan as $curahHujan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ "{$curahHujan->year}/{$curahHujan->month}" }}</td>
                                    <td>{{ $curahHujan->curah_hujan }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="d-flex justify-content-center">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Periode</th>
                                <th>X1 (t-3)</th>
                                <th>Periode</th>
                                <th>X2 (t-2)</th>
                                <th>Periode</th>
                                <th>X3 (t-1)</th>
                                <th>Periode</th>
                                <th>Y (Target)</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($tableData as $row)
                                <tr>
                                    <td>{{$row['no']}}</td>
                                    <td>{{$row['x1_period']}}</td>
                                    <td>{{$row['x1_value']}}</td>
                                    <td>{{$row['x2_period']}}</td>
                                    <td>{{$row['x2_value']}}</td>
                                    <td>{{$row['x3_period']}}</td>
                                    <td>{{$row['x3_value']}}</td>
                                    <td>{{$row['y_period']}}</td>
                                    <td>{{$row['y_value']}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
