<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return $this->view('pages.admin.dashboard.index');
    }
}
