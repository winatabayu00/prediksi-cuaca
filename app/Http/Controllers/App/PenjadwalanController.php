<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Dentro\Yalr\Attributes;
use Illuminate\Contracts\View\View;

#[Attributes\Prefix('')]
#[Attributes\Name('', false, false)]
class PenjadwalanController extends Controller
{
    /**
     * @return View
     */
    #[Attributes\Get('penjadwalan', 'penjadwalan')]
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

        return $this->view('pages.app.penjadwalan');
    }

    /**
     * @return \Illuminate\Http\Response
     */
    #[Attributes\Get('penjadwalan/pdf', 'penjadwalan.pdf')]
    public function pdf()
    {
        $pdf = Pdf::loadView('pages.pdf.template-hasil-prediksi');
        return $pdf->stream('jadwal-agenda.pdf');
    }
}
