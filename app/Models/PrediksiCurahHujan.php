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
    protected $fillable = [
        'year',
        'month',
        'curah_hujan',
        'date',
    ];
}
