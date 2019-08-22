<?php

namespace App\Http\Controllers;

use App\Mail\BookingConfirmed;
use Illuminate\Http\Request;

use App\Booking;
use App\Service;
use App\Discount;

use Illuminate\Support\Facades\Mail;
use Session;

class ApiController extends Controller
{
	public function getServices()
	{
		$services = Service::orderBy('id', 'asc')->get();

		return $services;
	}

	public function getDiscounts()
	{
		$discounts = Discount::latest()->get();

		return $discounts;
	}

	public function getCarInfo(Request $request)
	{
		$content = utf8_encode(file_get_contents("https://rogg.is/bizServices/CarRegistry/XmlService/CarService/v0703/CarDataByNumber.aspx?user=parkandflyws&password=LeggiStaedi13X12&number=" . $request->carNumber));
		$xml = simplexml_load_string($content);
		$json = json_encode($xml);

		$array = json_decode($json, True);

		$carNumberInfo = $array;

		return $carNumberInfo;
	}

	public function addBookingToSession(Request $request)
	{
		$form = collect($request->all());

		Session::put('form', $form);

		if (request()->wantsJson()) {
			return $form;
		}

		dd($form);

		return $form;
	}

	public function createBooking (Request $request)
	{
		$booking = Booking::create([
			'carNumber' => $request->input('carNumber'),
			'carSize' => $request->input('carSize'),
			'carMake' => $request->input('carMake'),
			'carType' => $request->input('carType'),
			'carColor' => $request->input('carColor'),

			'name' => $request->input('name'),
			'socialId' => $request->input('socialId'),
			'email' => $request->input('email'),
			'phone' => $request->input('phone'),

			'dropOffDate' => $request->input('dropOffDate'),
			'dropOffTime' => $request->input('dropOffTime'),
			'pickUpDate' => $request->input('pickUpDate'),
			'pickUpTime' => $request->input('pickUpTime'),

			'flightNumber' => $request->input('flightNumber'),

			'numberOfDays' => $request->input('numberOfDays'),
			'priceForDays' => $request->input('priceForDays'),

			'paidPrice' => $request->input('paidPrice'),

			'step' => $request->input('step'),

			'reservation_date' => date("Y-m-d H:i:s")
		]);

		$booking->services()->attach($request->input('selectedServicesId'));

		if (request()->wantsJson()) {
			return $booking->id;
		}

		return $booking->id;
	}

	public function updateBooking(Request $request)
	{
		Booking::where([
			['id', '=', $request->input('reference')],
			['step', '=', 1],
			// ['korta_authcode', '<>', $request->input('korta_authcode')],
		])->update(
			[
				'korta_authcode' => $request->input('korta_authcode'),
				'step' => 2,
				'confirmation_date' => date("Y-m-d H:i:s")
			]
		);

		$booking = Booking::where([
			['id', '=', $request->input('reference')]
		])->get()->first();
		
		Mail::to($booking->email)
			->cc('hjorturfreyr@hjorturfreyr.com')
			//->cc('bokanir@parkandfly.is')
			->send(new BookingConfirmed($booking));

		return redirect('/')->with('flash', 'Bókun þín hefur verið gerð! #');
	}

}
