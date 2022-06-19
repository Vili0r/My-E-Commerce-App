<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Http\Middleware\RedirectIfCartEmpty;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __contruct()
    {
        $this->middleware(RedirectIfCartEmpty::class);
    }

    public function __invoke()
    {
        return view('frontend.checkout');
    }
}
