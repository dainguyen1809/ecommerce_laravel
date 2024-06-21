<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function index()
    {
        if (! session()->has('address')) {
            return redirect()->route('user.checkout');
        }
        return view('frontend.pages.payment');
    }
}
