<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuaca;
use App\Services\Predict;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Dentro\Yalr\Attributes;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

#[Attributes\Prefix('prediksi')]
#[Attributes\Name('prediksi', false, true)]
class PrediksiController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Prediksi';
    }

    /**
     * @param Request $request
     * @return View
     */
    #[Attributes\Get('', 'index')]
    public function index(Request $request): View
    {
        $START_YEAR = 2019;

        $years = [];
        $date = CarbonImmutable::createFromDate($START_YEAR, '01', '01');
        $dateNow = Carbon::now();
        for ($i = 0; $i <= $date->diffInYears($dateNow); $i++) {
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

        if ($request->filled('data')) {
            $prediksi = new Predict();

            $validatedData = $request->validate([
                'data.year' => 'required|integer|between:' . $START_YEAR . ',' . $dateNow->year,
                'data.month' => 'required|integer|between:1,12',
            ]);

            try {
                $data = $prediksi->predict($validatedData['data']);
                $this->setData('result', $data);

                $prediksiUntukBulan = Carbon::createFromDate($validatedData['data']['year'], $validatedData['data']['month'], 1);
                $this->setData('predict_for', $prediksiUntukBulan->addMonth()->toDateString());
            } catch (\Exception $e) {
                $this->setData('error', 'Terjadi kesalahan saat memproses prediksi.');
            }
        }

        return $this->view('pages.admin.prediksi.index');
    }

}
