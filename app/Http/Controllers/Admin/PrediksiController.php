<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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

        if (!empty($request->input('data'))) {
            $prediksi = new Predict();
            $data = $prediksi->predict($request->input('data'));

            $total = 0;
            foreach ($data as $item){
                $total += $item['window'][2];
            }
            $output = round($total / count($data));

            $this->setData('output', $output);
            $this->setData('result', $data);
        }
        return $this->view('pages.admin.prediksi.index');
    }
}
