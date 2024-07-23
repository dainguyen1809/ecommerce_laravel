<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\Contact;
use App\Models\About;
use App\Models\EmailConfiguration;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends Controller
{
    public function about()
    {
        $about = About::first();

        return view('frontend.pages.about', compact('about'));
    }

    public function termsAndCondition()
    {
        $term = TermsAndCondition::first();

        return view('frontend.pages.term', compact('term'));
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function contactForm(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|max:255',
            'message' => 'required|max:1000',
        ]);

        $setting = EmailConfiguration::first();
        Mail::to($setting->email)->send(new Contact($request->subject, $request->message, $request->email));

        return response()->json([
            'status' => 'success',
            'message' => 'Mail sent successfully',
        ]);
    }
}
