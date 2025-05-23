<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuaca;
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
        $cuaca = Cuaca::query()
            ->get();

        $chartData = [
            'categories' => $cuaca->map(function ($cuaca) {
                return "{$cuaca->year}/{$cuaca->month}";
            }),
            'series' => $cuaca->map(fn($val) => $val->curah_hujan)
        ];

        $this->setData('chartData', $chartData);
        return $this->view('pages.admin.dashboard.index');
    }
}
