<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Booking;
use App\Service;

class ApiController extends Controller
{
	public function getServices()
	{
		$services = Service::orderBy('id', 'asc')->get();

		return $services;
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

	public function createBooking(Request $request)
	{
		request()->validate([
			'carNumber' => 'required',
			'carSize' => 'required',
			'carMake' => 'required',
			'carType' => 'required',
			'carColor' => 'required',

			'name' => 'required',
			'socialId' => 'required',
			'email' => 'required|email',
			'phone' => 'required',
			
			'dropOffDate' => 'required',
			'dropOffTime' => 'required',
			'pickUpDate' => 'required',
			'pickUpTime' => 'required',

			'flightNumber' => 'required',
			'flightTime' => 'required',

			'numberOfDays' => 'required',
			'priceForDays' => 'required',

			'paidPrice' => 'required'
		]);

		$booking = Booking::create([
			'carNumber' => request('carNumber'),
			'carSize' => request('carSize'),
			'carMake' => request('carMake'),
			'carType' => request('carType'),
			'carColor' => request('carColor'),

			'name' => request('name'),
			'socialId' => request('socialId'),
			'email' => request('email'),
			'phone' => request('phone'),

			'dropOffDate' => request('dropOffDate'),
			'dropOffTime' => request('dropOffTime'),
			'pickUpDate' => request('pickUpDate'),
			'pickUpTime' => request('pickUpTime'),

			'flightNumber' => request('flightNumber'),
			'flightTime' => request('flightTime'),

			'numberOfDays' => request('numberOfDays'),
			'priceForDays' => request('priceForDays'),

			'paidPrice' => request('paidPrice'),

			'korta_authcode' => request('korta_authcode')
		]);

		$booking->services()->attach($request->services);

		\Mail::to($request->email)
			->cc('bokanir@parkandfly.is')
			->bcc('reynir@parkandfly.is')
			->bcc('solveig@parkandfly.is')
			->send(new BookingConfirmed($booking));

		// if (request()->wantsJson()) {
		// 	return response($booking, 201);
		// }

		return redirect('/');
	}
}
