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

    public function information(): string
    {
        return match ($this){
            self::LOW => 'Curah Hujan Rendah',
            self::MEDIUM => 'Curah Hujan Sedang',
            self::HIGH => 'Curah Hujan Tinggi',
            self::VERY_HIGH => 'Curah Hujan Sangat Tinggi',
        };
    }

    public function informationMessage(): string
    {
        return match ($this){
            self::LOW, self::MEDIUM => 'Cocok Untuk Mulai Menanam',
            self::HIGH, self::VERY_HIGH => 'Tidak Cocok Untuk Menanam',
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

    public static function getPredict(int $amount)
    {
        if (($amount < self::LOW->predict())){
            return self::LOW;
        }

        if (($amount >= self::LOW->predict()) && ($amount < self::MEDIUM->predict())){
            return self::MEDIUM;

        }

        if (($amount >= self::MEDIUM->predict()) && ($amount < self::HIGH->predict())){
            return self::HIGH;
        }

        if (($amount > self::HIGH->predict())){
            return self::VERY_HIGH;
        }
    }
}
