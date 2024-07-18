<?php

namespace App\Http\Controllers\Frontend;

use app\helpers\MailHelper;
use App\Http\Controllers\Controller;
use App\Mail\Subscription;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class NewLetterController extends Controller
{
    public function subscribe(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
        ]);

        $checkSubscriber = Subscriber::where('email', $request->email)->first();
        if (! empty($checkSubscriber)) {
            if ($checkSubscriber->is_verified == 0) {
                // unverified
                $checkSubscriber->verified_token = str()->random(32);
                $checkSubscriber->save();

                // config mail
                MailHelper::mailConfigure();
                // sending email
                Mail::to($checkSubscriber->email)->send(new Subscription($checkSubscriber));

                return response()->json([
                    'status' => 'success',
                    'message' => 'A verification link has been sent to your email address.',
                ]);
            } elseif ($checkSubscriber->is_verified == 1) {

                return response()->json([
                    'status' => 'error',
                    'message' => 'You already subscribed with this email!',
                ]);
            }
        }

        $subscriber = new Subscriber();
        $subscriber->email = $request->email;
        $subscriber->verified_token = str()->random(32);
        $subscriber->is_verified = 0;
        $subscriber->save();

        // config mail
        MailHelper::mailConfigure();

        // sending email
        Mail::to($subscriber->email)->send(new Subscription($subscriber));

        return response()->json([
            'status' => 'success',
            'message' => 'A verification link has been sent to your email address.',
        ]);
    }

    public function verifyEmail($token)
    {
        $verify = Subscriber::where('verified_token', $token)->first();
        if ($verify) {
            $verify->verified_token = 'verified';
            $verify->is_verified = 1;
            $verify->save();

            toastr('Your account has been verified!', 'success');

            return redirect()->route('home');
        } else {
            toastr('Invalid token!', 'error');

            return redirect()->route('home');
        }
    }
}
