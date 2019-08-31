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

	public function getFlightInfo(Request $request)
	{
		$strippedRequest = str_replace(' ', '', $request->flightNumber);
		$string = strtoupper($strippedRequest);

		$content = json_encode(file_get_contents("https://apis.is/flight?language=en&type=departures"));
		$json = json_decode($content);
		$strippedRequest = strip_tags($json);

		$finalJson = json_decode($strippedRequest, true);

		dd($finalJson);

		return $carNumberInfo;
	}

	public function getSingleDiscount($discount)
	{
		$url = 'http://admin.parkandfly.is/api/DiscountsServiceApi/getbycode/'.$discount;
		
		$discounts = json_decode(file_get_contents($url), true);

		$result = json_decode(json_encode($discounts), true);

		if ($result['success'] == false) {

		}

		return $result;
	}

	public function bookingCheck(Request $request)
	{
		$url = 'http://admin.parkandfly.is/api/BookingsServiceApi/checkbooking';

		$data = json_encode(array(
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

			'discountCode' => $request->input('discountCode')
		));

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

		if ($result['success'] == false) {
			$temp_error_message = 'API call BookingsServiceApi for action checkbooking failed. Result message: ' . $result['message'];

			Log::channel('slackError')->error($temp_error_message);
			
			return redirect('/')->with('flash', 'Óvænt villa!');
		}

		if (request()->wantsJson()) {
			return $result;
		}

		return $result;
	}

	public function bookingStepOne(Request $request)
	{
		$url = 'http://admin.parkandfly.is/api/BookingsServiceApi/createbooking';

		$data = json_encode(array(
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

			'discountCode' => $request->input('discountCode')
		));

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

		if ($result['success'] == false) {
			$temp_error_message = 'API call BookingsServiceApi for action createbooking failed. Result message: ' . $result['message'];

			Log::channel('slackError')->error($temp_error_message);
			
			return redirect('/')->with('flash', 'Óvænt villa!');

			// $result.Success = false
			// $result.Message = "Booking is null"
		}

		$key = $result['bookingRef'] . '-' . $result['tokenKorta'];
		$dateTimeNow = date("Y-m-d H:i:s");

		Log::channel('slack')->notice('Bókun hefur stofnuð. Kt: '.($result['socialId']).', Netfang: '.($result['email']).', Bókunarnr.: '.$key.', Dags.: '.$dateTimeNow.', Skref: 1');

		if ($result['step'] == 2) {
			Log::channel('slack')->notice('Bókun hefur verið staðfest. Kt: '.($result['socialId']).', Bókunarnr.: '.($result['bookingRef']).', Skref: 2');
		}

		if (request()->wantsJson()) {
			return $result;
		}

		return $result;
	}

	public function bookingStepTwo(Request $request)
	{
		$url = 'http://admin.parkandfly.is/api/BookingsServiceApi/confirmbooking?token=' . $request->input('reference') . '&kortaAuthcode=' . $request->input('authcode');

		$data = json_encode(array(
			'token' => $request->input('reference'),
			'kortaAuthcode' => $request->input('authcode'),
		));

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

		if ($result['success'] == false) {
			$temp_error_message = 'API call BookingsServiceApi for action confirmbooking failed. Result message: ' . $result['message'];

			Log::channel('slackError')->error($temp_error_message);
			
			return redirect('/')->with('flash', 'Óvænt villa!');

			// $result.Success = false
			// $result.Message = "Booking is null"
		}

		Log::channel('slack')->notice('Bókun hefur verið staðfest. Kt: '.($result['socialId']).', Bókunarnr.: '.($result['bookingRef']).', Korta auth_code.: '.($request->input('authcode')).', Skref: 2');
		
		// Mail::send('emails.confirmed', $result, function ($message) use ($result) {
		// 	$message->to($result['email'])
		// 		->cc('admin@parkandfly.is')
		// 		->cc('hjorturfreyr@hjorturfreyr.com')
		// 		->cc('parkandfly@patreksson.net');

		// 	$message->attachData($result);

		// 	$message->from('parkandfly@parkandfly.is', 'Park and fly');
		// });

		Mail::to($result['email'])
		->cc(['admin@parkandfly.is','hjorturfreyr@hjorturfreyr.com','bokanir@parkandfly.is'])
		->send(new BookingConfirmed($result));

		return redirect('/')->with('flash', 'Bókun þín hefur verið gerð!');

		// $temp_booking_ref = substr($request->input('reference'), 0, 13);
		// $temp_token = substr($request->input('reference'), 14, 26);


		// $current = Booking::where([
		// 	['booking_ref', '=', $temp_booking_ref],
		// 	['token_korta', '=', $temp_token],
		// 	['step', '=', 1],
		// ])->get()->first();

		// $token_expaire_date = date("Y-m-d H:i:s");
		
		// $keyNow = \DateTime::createFromFormat('Y-m-d H:i:s', $result->token_expaire_date);

		// $inAYear = $keyNow->add(new \DateInterval('PT10M'));
		// $prevTokenDate = $inAYear;

		// $tempDateNow = \DateTime::createFromFormat('Y-m-d H:i:s', date("Y-m-d H:i:s"));

		// if ($prevTokenDate < $tempDateNow) {
		// 	return redirect('/')->with('flash', 'Óvænt villa!');
		// }

		// Booking::where([
		// 	['booking_ref', '=', $temp_booking_ref],
		// 	['token_korta', '=', $temp_token],
		// 	['step', '=', 1]
		// ])->update(
		// 	[
		// 		'korta_authcode' => $request->input('authcode'),
		// 		'step' => 2,
		// 		'confirmation_date' => date("Y-m-d H:i:s")
		// 	]
		// );
	}
}
