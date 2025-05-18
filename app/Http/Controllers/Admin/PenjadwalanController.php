<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return $this->view('pages.admin.penjadwalan.index');
    }
}
