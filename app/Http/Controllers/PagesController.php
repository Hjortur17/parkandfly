<?php

namespace App\Exceptions;
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Exception;

class PagesController extends Controller
{
	public function index(Request $request) {
		$status = $request->status;

		if ($status == 1) {
			return redirect('/')->with('flash', 'Bókun þín hefur verið gerð!');
		}

		return view('pages.index');
	}

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
