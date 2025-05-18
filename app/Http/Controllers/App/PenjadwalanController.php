<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
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
        return $this->view('pages.app.penjadwalan');
    }
}
