<?php

namespace App\Models;

/**
 * @property string $id
 * @property string $year
 * @property string $month
 * @property string $curah_hujan
 * */
class Cuaca extends Model
{
    protected $fillable = [
        'year',
        'month',
        'curah_hujan',
    ];
}
