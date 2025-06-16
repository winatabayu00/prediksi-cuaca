<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Predict;
use App\Http\Controllers\Controller;
use App\Models\Cuaca;
use App\Models\PrediksiCurahHujan;
use Dentro\Yalr\Attributes;
use Illuminate\Contracts\View\View;

#[Attributes\Prefix('dashboard')]
#[Attributes\Name('dashboard', false, true)]
class DashboardController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Dashboard';
    }

    /**
     * @return View
     */
    #[Attributes\Get('', 'index')]
    public function index(): View
    {
        $cuaca = PrediksiCurahHujan::query()
            ->get();

        $chartData = [
            'categories' => $cuaca->map(function ($cuaca) {
                return "{$cuaca->year}/{$cuaca->month}";
            }),
            'series' => $cuaca->map(fn($val) => $val->curah_hujan)
        ];

        $recentActivities = PrediksiCurahHujan::query()
            ->limit(5)
            ->orderBy('created_at', 'desc')
            ->get()->map(function ($cuaca) {
                return [
                    'title' => 'Prediksi cuaca ' . $cuaca->year . '/' . $cuaca->month,
                    'time' => $cuaca->created_at->diffForHumans(),
                ];
            });

        $recentPredictions = PrediksiCurahHujan::query()
            ->limit(5)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function (PrediksiCurahHujan $cuaca) {
                return [
                    'status' => Predict::getPredict($cuaca->curah_hujan),
                    'time' => $cuaca->year . '/' . $cuaca->month,
                ];
            });

        $totalPredictions = PrediksiCurahHujan::query()
            ->select('id')
            ->count();

        $dateNow = now();
        $monthlyPredictions = PrediksiCurahHujan::query()
            ->where([
                'year' => $dateNow->format('Y'),
            ])
            ->count();

        $this->setData('monthlyPredictions', $monthlyPredictions);
        $this->setData('totalPredictions', $totalPredictions);
        $this->setData('recentPredictions', $recentPredictions);
        $this->setData('chartData', $chartData);
        $this->setData('recentActivities', $recentActivities);
        return $this->view('pages.admin.dashboard.index');
    }
}
