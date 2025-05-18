<?php

namespace App\Enums;

enum Predict: string
{
    CASE LOW = 'low';
    CASE MEDIUM = 'medium';
    CASE HIGH = 'high';
    CASE VERY_HIGH = 'very_high';

    public function label(): string
    {
        return match ($this){
            self::LOW => 'Rendah',
            self::MEDIUM => 'Menengah',
            self::HIGH => 'Tinggi',
            self::VERY_HIGH => 'Sangat Tinggi',
        };
    }

    public function predict(): int
    {
        return match ($this){
            self::LOW => 100,
            self::MEDIUM => 300,
            self::HIGH, self::VERY_HIGH => 500,
        };
    }

    public function getPredict(int $amount)
    {
        if (($amount < self::LOW->predict())){
            return self::LOW;
        }

        if (($amount > self::LOW->predict()) && ($amount < self::MEDIUM->predict())){
            return self::MEDIUM;

        }

        if (($amount > self::MEDIUM->predict()) && ($amount < self::HIGH->predict())){
            return self::HIGH;
        }

        if (($amount > self::HIGH->predict())){
            return self::VERY_HIGH;
        }
    }
}
