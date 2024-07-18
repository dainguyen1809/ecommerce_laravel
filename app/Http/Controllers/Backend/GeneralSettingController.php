<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\EmailConfiguration;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    public function index()
    {
        $generalSetting = GeneralSetting::first();
        $emailConfiguration = EmailConfiguration::first();

        return view('admin.setting.index', [
            'generalSetting' => $generalSetting,
            'emailConfiguration' => $emailConfiguration,
        ]);
    }

    public function generalSettingUpdate(Request $request)
    {
        $request->validate([
            'site_name' => ['required', 'max:255'],
            'layouts' => ['required', 'max:255'],
            'contact_email' => ['required', 'max:255'],
            'currency_name' => ['required', 'max:255'],
            'currency_icon' => ['required', 'max:15'],
            'timezone' => ['required', 'max:255'],
        ]);

        GeneralSetting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => $request->site_name,
                'layouts' => $request->layouts,
                'contact_email' => $request->contact_email,
                'currency_name' => $request->currency_name,
                'currency_icon' => $request->currency_icon,
                'timezone' => $request->timezone,
            ],
        );

        toastr('Updated success !', 'success');

        return redirect()->back();
    }

    public function emailSettingUpdate(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'host' => ['required', 'max:255'],
            'username' => ['required', 'max:255'],
            'password' => ['required', 'max:255'],
            'port' => ['required', 'max:255'],
            'encryption' => ['required', 'max:255'],
        ]);

        EmailConfiguration::updateOrCreate(
            ['id' => 1],
            [
                'email' => $request->email,
                'host' => $request->host,
                'username' => $request->username,
                'password' => $request->password,
                'port' => $request->port,
                'encryption' => $request->encryption,
            ]
        );

        toastr('Updated success !', 'success');

        return redirect()->back();
    }
}
