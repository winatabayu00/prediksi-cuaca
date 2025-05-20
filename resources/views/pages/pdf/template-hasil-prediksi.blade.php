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
                <th width="100px">Tahun</th>
                <th width="100px">Bulan</th>
                <th width="100px">Agenda</th>
            </tr>
        </thead>
        <tbody>
        @if(isset($cuaca))
            @for($i = 0; $i < 3; $i++)
                @php
                    $date = \Carbon\CarbonImmutable::createFromDate($cuaca->year, $cuaca->month, '01');
                        $menanam = in_array(\App\Enums\Predict::getPredict($cuaca->curah_hujan)->value, ['medium', 'low']);
                @endphp
                @if($i < 2)
                    <tr>
                        <td>{{ $date->addMonth($i)->format('Y') }}</td>
                        <td>{{ $date->addMonth($i)->format('F') }}</td>
                        <td>{{ $menanam ? 'Menanam' : 'Tidak disarankan menanam di bulan ini' }}</td>
                    </tr>
                @else
                    <tr>
                        <td>{{ $date->addMonth($i)->format('Y') }}</td>
                        <td>{{ $date->addMonth($i)->format('F') }}</td>
                        <td>{{ $menanam ? 'Memanen' : 'Tidak ada agenda penanaman ' }}</td>
                    </tr>
                @endif
            @endfor
        @endif

        </tbody>
    </table>
</body>
</html>
