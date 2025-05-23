<?php

namespace App\Models;

/**
 * @property string $id
 * @property string $year
 * @property string $month
 * @property string $curah_hujan
 * @property string $date
 * */
class PrediksiCurahHujan extends Model
{

    protected $table = 'prediksi_curah_hujan';

    protected $fillable = [
        'year',
        'month',
        'curah_hujan',
        'date',
    ];

    protected $casts = [
        'curah_hujan' => 'integer',
    ];
}
