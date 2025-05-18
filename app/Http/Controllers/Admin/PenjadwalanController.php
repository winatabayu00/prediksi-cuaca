<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Dentro\Yalr\Attributes;
use Illuminate\Contracts\View\View;

#[Attributes\Prefix('penjadwalan')]
#[Attributes\Name('penjadwalan', false, true)]
class PenjadwalanController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Penjadwalan';
    }

    /**
     * @return View
     */
    #[Attributes\Get('', 'index')]
    public function index(): View
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

        return $this->view('pages.admin.penjadwalan.index');
    }
}
