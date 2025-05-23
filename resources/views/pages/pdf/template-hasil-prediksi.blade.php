<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Jadwal Agenda</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        thead {
            background-color: #f2f2f2;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            font-weight: bold;
        }
    </style>
</head>
<body>
<h2>Jadwal Agenda</h2>

<table>
    <thead>
    <tr>
        <th>Tahun</th>
        <th>Bulan</th>
        <th>Agenda</th>
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
</body>
</html>
