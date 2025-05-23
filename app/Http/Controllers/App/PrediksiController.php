<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Cuaca;
use App\Models\PrediksiCurahHujan;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Dentro\Yalr\Attributes;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

#[Attributes\Prefix('')]
#[Attributes\Name('', false, false)]
class PrediksiController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    #[Attributes\Get('prediksi', 'prediksi')]
    public function index(Request $request): View
    {
        $years = [];
        $date = CarbonImmutable::createFromDate('2019', '01', '01');
        $dateNow = Carbon::now();
        for ($i = 0; $i < $date->diffInYears($dateNow) + 1; $i++) {
            $year = $date->addYear($i);
            $years[] = [
                'id' => $year->format('Y'),
                'name' => $year->format('Y'),
            ];
        }

        $months = [];
        $date = CarbonImmutable::now()->startOfYear();
        for ($i = 0; $i < 12; $i++) {
            $month = $date->addMonth($i);
            $months[] = [
                'id' => $month->format('m'),
                'name' => $month->format('F'),
            ];
        }

        $this->setData('years', $years);
        $this->setData('months', $months);

        $year = $request->input('year');
        if (!empty($year)) {

            $cuaca = PrediksiCurahHujan::query()
                ->where('year', $year);
            $result = $cuaca->get();

            $this->setData('result', $result);
        }

        return $this->view('pages.app.prediksi');
    }
}
