<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cuaca;
use App\Models\PrediksiCurahHujan;
use App\Services\Predict;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Dentro\Yalr\Attributes;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

#[Attributes\Prefix('dataset')]
#[Attributes\Name('dataset', false, true)]
class DataSetController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->pageTitle = 'Dataset';
    }

    /**
     * @param Request $request
     * @return View
     */
    #[Attributes\Get('', 'index')]
    public function index(Request $request): View
    {

        $dataCurahHujan = Cuaca::query()
            ->orderBy('id')
            ->get();

        $this->setData('dataCurahHujan', $dataCurahHujan);
        $dataCurahHujanMap = $dataCurahHujan
            ->mapWithKeys(function ($cuaca) {
                return ["{$cuaca->year}/{$cuaca->month}" => $cuaca->curah_hujan];
            })
            ->toArray();

        $periods = array_keys($dataCurahHujanMap);
        $values = array_values($dataCurahHujanMap);

        $tableData = [];
        for ($i = 3; $i < count($periods) - 1; $i++) {
            $tableData[] = [
                'no' => $i - 2,
                'x1_period' => $periods[$i - 3],
                'x1_value' => $values[$i - 3],
                'x2_period' => $periods[$i - 2],
                'x2_value' => $values[$i - 2],
                'x3_period' => $periods[$i - 1],
                'x3_value' => $values[$i - 1],
                'y_period' => $periods[$i],
                'y_value' => $values[$i],
            ];
        }


        $this->setData('tableData', $tableData);
        return $this->view('pages.admin.dataset.index');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    #[Attributes\Post('create', 'store')]
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'year' => 'required', 'string',
            'month' => 'required', 'string',
            'curah_hujan' => 'required', 'numeric', 'gte:0',
        ]);

        $validated['date'] = now()->toDateString();
        PrediksiCurahHujan::query()->create($validated);
        successToast();
        return redirect()->back();
    }
}
