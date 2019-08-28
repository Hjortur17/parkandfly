<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Booking;
use App\Service;
use App\Discount;

use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmed;

class ApiController extends Controller
{
	public function getCarInfo(Request $request)
	{
		$strippedRequest = str_replace(' ', '', $request->carNumber);
		$content = utf8_encode(file_get_contents("https://rogg.is/bizServices/CarRegistry/XmlService/CarService/v0703/CarDataByNumber.aspx?user=parkandflyws&password=LeggiStaedi13X12&number=" . $strippedRequest));
		$xml = simplexml_load_string($content);
		$json = json_encode($xml);

		$array = json_decode($json, True);

		$carNumberInfo = $array;

		return $carNumberInfo;
	}

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

	public function createBooking(Request $request)
	{
		$token = uniqid();
		$booking_ref = uniqid();

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

			'reservation_date' => date("Y-m-d H:i:s"),
			'token_expaire_date' => date("Y-m-d H:i:s"),

			'token_korta' => $token,
			'booking_ref' => $booking_ref
		]);

		$booking->services()->attach($request->input('selectedServicesId'));

		$key = $booking_ref . '-' . $token;

		$dateTimeNow = date("Y-m-d H:i:s");

		Log::channel('slack')->notice('Bókun hefur stofnuð. Kt: '.($booking->socialId).', Netfang: '.($booking->email).', Bókunarnr.: '.($booking->id).', Dags.: '.$dateTimeNow.', Skref: 1');

		if (request()->wantsJson()) {
			return $key;
		}

		return $key;
	}

	public function updateBooking(Request $request)
	{
		$temp_booking_ref = substr($request->input('reference'), 0, 13);
		$temp_token = substr($request->input('reference'), 14, 26);

		$token_expaire_date = date("Y-m-d H:i:s");

		$current = Booking::where([
			['booking_ref', '=', $temp_booking_ref],
			['token_korta', '=', $temp_token],
			['step', '=', 1],
		])->get()->first();

		$keyNow = \DateTime::createFromFormat('Y-m-d H:i:s', $current->token_expaire_date);

		$inAYear = $keyNow->add(new \DateInterval('PT10M'));
		$prevTokenDate = $inAYear;

		$tempDateNow = \DateTime::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s"));

		if ($prevTokenDate < $tempDateNow) {
			return redirect('/')->with('flash', 'Óvænt villa!');
		}

		Booking::where([
			['booking_ref', '=', $temp_booking_ref],
			['token_korta', '=', $temp_token],
			['step', '=', 1]
		])->update(
			[
				'korta_authcode' => $request->input('reference')$request->input('authcode'),
				'step' => 2,
				'confirmation_date' => date("Y-m-d H:i:s")
			]
		);

		Log::channel('slack')->notice('Bókun hefur verið staðfest. Kt: '.($current->socialId).', Bókunarnr.: '.($current->id).', Korta auth_code.: '.($request->input('korta_authcode')).', Skref: 2');
		
		Mail::to($current->email)
			->cc('admin@parkandfly.is')
			->cc('hjorturfreyr@hjorturfreyr.com')
			->send(new BookingConfirmed($current));

		return redirect('/')->with('flash', 'Bókun þín hefur verið gerð!');
	}
}
