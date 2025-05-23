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

        $testingValues = array_column($dataTesting, 'value'); // [33, 185, 66,]

        $trainingWindows = $this->generateWindows($dataTraining);

        $distances = [];

        $count = 0;
        foreach ($trainingWindows as $window) {
            $count++;
            if ($count > 56){
                continue;
            }
            $data = $window['distance'];
            $nextTrainingWindow = ($count === 56) ? [33] : [$trainingWindows[$count]['distance'][2]];
            $data = array_merge( $data, $nextTrainingWindow);
            $distances[] = [
                'periode' => $window['periode'],
                'window' => $data,
                'distance' => $this->getEuclideanDistance($window['distance'], $testingValues)
            ];
        }

        return collect($distances)->where('distance', '>', 0)->sortBy('distance')->values()->all();
    }

    public function getEuclideanDistance(array $dataTraining, array $dataTesting): float
    {
        $sum = 0;
        if (count($dataTraining) === count($dataTesting)) {
            for ($i = 0; $i < count($dataTraining); $i++) {
                $sum += pow($dataTesting[$i] - $dataTraining[$i], 2);
            }
        }
        return sqrt($sum);
    }

    public function generateWindows(array $rawData, int $windowSize = 3): array
    {
        $period = array_map(fn($item) => "{$item[0]}/$item[1]", $rawData);
        $values = array_map(fn($item) => $item[2], $rawData);
        $windows = [];

        for ($i = 0; $i <= count($values) - $windowSize; $i++) {
            $windows[] = [
                'distance' => array_slice($values, $i, $windowSize),
                'periode' => array_slice($period, $i, $windowSize),
            ];
        }

        return $windows;
    }
}
