<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Dentro\Yalr\Attributes;
use Illuminate\Contracts\View\View;

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
     * @return View
     */
    #[Attributes\Get('', 'index')]
    public function index(): View
    {

        $input = 'Laravel ke Python';
        $command = escapeshellcmd(env('PYTHON_INTERPRETER')." " . app_path('Core/PythonScripts/predict.py') . " \"$input\"");
        $output = shell_exec($command);

        $this->setData('output', $output);

        return $this->view('pages.admin.prediksi.index');
    }
}
