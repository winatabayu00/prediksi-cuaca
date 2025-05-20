<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use App\Models\Cuaca;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Dentro\Yalr\Attributes;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

#[Attributes\Prefix('')]
#[Attributes\Name('', false, false)]
class PenjadwalanController extends Controller
{
    /**
     * @param Request $request
     * @return View
     */
    #[Attributes\Get('penjadwalan', 'penjadwalan')]
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
        $month = $request->input('month');
        if (!empty($year) && !empty($month)) {
            $cuaca = Cuaca::query()->where([
                'year' => $year,
                'month' => $month,
            ])->first();
            $this->setData('cuaca', $cuaca);
        }

        return $this->view('pages.app.penjadwalan');
    }


    #[Attributes\Get('penjadwalan/pdf', 'penjadwalan.pdf')]
    public function pdf()
    {
        $year = request()->input('year');
        $month = request()->input('month');
        $cuaca = null;
        if (!empty($year) && !empty($month)) {
            $cuaca = Cuaca::query()->where([
                'year' => $year,
                'month' => $month,
            ])->first();
        }
        $pdf = Pdf::loadView('pages.pdf.template-hasil-prediksi', ['cuaca' => $cuaca]);
        return $pdf->stream('jadwal-agenda.pdf');
    }
}
