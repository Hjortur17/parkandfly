<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Booking;
use App\Service;

use Session;

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

	public function addBookingToSession(Request $request)
	{
		$form = collect($request->all());

		Session::put('form', $form);

		return $form;
	}

	public function createBooking(Request $request)
	{	
		if ($request->input('reference') === $request->session()->get('form.sessionKey')) {
			$booking = Booking::create([
				'carNumber' => $request->session()->get('form.carNumber'),
				'carSize' => $request->session()->get('form.carSize'),
				'carMake' => $request->session()->get('form.carMake'),
				'carType' => $request->session()->get('form.carType'),
				'carColor' => $request->session()->get('form.carColor'),

				'name' => $request->session()->get('form.name'),
				'socialId' => $request->session()->get('form.socialId'),
				'email' => $request->session()->get('form.email'),
				'phone' => $request->session()->get('form.phone'),

				'dropOffDate' => $request->session()->get('form.dropOffDate'),
				'dropOffTime' => $request->session()->get('form.dropOffTime'),
				'pickUpDate' => $request->session()->get('form.pickUpDate'),
				'pickUpTime' => $request->session()->get('form.pickUpTime'),

				'flightNumber' => $request->session()->get('form.flightNumber'),

				'numberOfDays' => $request->session()->get('form.numberOfDays'),
				'priceForDays' => $request->session()->get('form.priceForDays'),

				'paidPrice' => $request->session()->get('form.paidPrice'),

				'korta_authcode' => $request->input('authcode')
			]);

			// $booking->services()->attach($request->session()->get('form.selectedServicesId'));

			\Mail::to($request->session()->get('form.email'))
				->cc('bokanir@parkandfly.is')
				->bcc('reynir@parkandfly.is')
				->bcc('solveig@parkandfly.is')
				->send(new BookingConfirmed($booking));

			return redirect('/');
		} else {
			dd($request->all());
		}
	}
}
