<?php

namespace App\Services;

use App\Models\Cuaca;
use Illuminate\Database\Eloquent\Collection;
use Winata\PackageBased\Abstracts\BaseService;

class Predict extends BaseService
{
    /**
     * @return Collection
     */
    private function getHistoryCuaca(): Collection
    {
        return Cuaca::query()
            ->get();
    }

    public function predict(array $dataTesting)
    {
        $dataTraining = $this->getHistoryCuaca()->map(function ($item) {
            return [$item->year, $item->month, $item->curah_hujan];
        })->toArray();

        $testingValues = array_column($dataTesting, 'value'); // [33, 185, 66]

        $trainingWindows = $this->generateWindows($dataTraining);

        $distances = [];

        foreach ($trainingWindows as $window) {
            $distances[] = [
                'window' => $window,
                'distance' => $this->getEuclideanDistance($window, $testingValues)
            ];
        }

        return $distances;

    }

    public function getEuclideanDistance(array $a, array $b): float
    {
        $sum = 0;
        if (count($a) === count($b)) {
            for ($i = 0; $i < count($a); $i++) {
                $sum += pow($a[$i] - $b[$i], 2);
            }
        }
        return sqrt($sum);
    }

    public function generateWindows(array $rawData, int $windowSize = 3): array
    {
        $values = array_map(fn($item) => $item[2], $rawData);
        $windows = [];

        for ($i = 0; $i <= count($values) - $windowSize; $i++) {
            $windows[] = array_slice($values, $i, $windowSize);
        }

        return $windows;
    }
}
