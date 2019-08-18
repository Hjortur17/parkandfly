<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function about() {
        return view('pages.about');
    }

    public function terms() {
        return view('pages.terms');
    }

    public function howDoesItWork() {
        return view('pages.work');
    }

    public function questions() {
        return view('pages.questions');
    }

    public function prices() {
        return view('pages.prices');
    }
}