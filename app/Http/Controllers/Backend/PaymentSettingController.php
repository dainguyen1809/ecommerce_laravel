<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\CodSetting;
use App\Models\PaypalSetting;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index()
    {
        $paypalSetting = PaypalSetting::first();
        $codSetting = CodSetting::first();
        return view('admin.payment-setting.index', [
            'paypalSetting' => $paypalSetting,
            'codSetting' => $codSetting,
        ]);
    }
}
