<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use App\Booking;
use App\Discount;

use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmed;

use Illuminate\Database\Eloquent\ModelNotFoundException;

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
		$services = json_decode(file_get_contents('http://admin.parkandfly.is/api/ServicesServiceApi'), true);

		return $services;
	}

	public function getDiscounts()
	{
		$discounts = json_decode(file_get_contents('http://admin.parkandfly.is/api/DiscountsServiceApi'), true);

		return $discounts;
	}

	public function getSingleDiscount($discount)
	{
		$url = 'http://admin.parkandfly.is/api/DiscountsServiceApi/getbycode/'.$discount;
		
		$discounts = json_decode(file_get_contents($url), true);

		return $discounts;
	}

	public function createBookingStepOne(Request $request)
	{
		$url = 'http://admin.parkandfly.is/api/BookingsServiceApi/createbooking';

		$data = json_encode(array([
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

			'selectedServicesId' => $request->input('selectedServicesId'),

			'bookingRef' => '123',
			'tokenKorta' => '456',
		]), JSON_FORCE_OBJECT);

		$options = array(
			'http' => array(
				'header'  => "Content-type: application/json",
				'method'  => 'POST',
				'content' => $data
			)
		);

		$context  = stream_context_create($options);
		$resultTemp = file_get_contents($url, true, $context);

		$result = json_decode($resultTemp, true);

		dd($result);

		$key = $result.bookingRef . '-' . $result.tokenKorta;
		$dateTimeNow = date("Y-m-d H:i:s");

		Log::channel('slack')->notice('Bókun hefur stofnuð. Kt: '.($result->socialId).', Netfang: '.($result->email).', Bókunarnr.: '.$key.', Dags.: '.$dateTimeNow.', Skref: 1');

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
				'korta_authcode' => $request->input('authcode'),
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
