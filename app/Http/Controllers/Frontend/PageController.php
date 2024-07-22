<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\TermsAndCondition;
use Illuminate\Http\Request;

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
}