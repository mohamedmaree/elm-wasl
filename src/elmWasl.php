<?php
namespace maree\elmWasl;
class elmWasl{

	public static function waslRegisterDriverAndCar($identityNumber='',$dateOfBirthGregorian='',$emailAddress='',$mobileNumber='',$sequenceNumber='',$plateLetters='',$plateNumber='',$plateType=''){
		$plateLetterRight ='';
		$plateLetterMiddle = '';
		$plateLetterLeft = ''; 
		$letters = explode(' ', $plateLetters);
		$plateLetterRight = (isset($letters[0]))? $letters[0] : '';
		$plateLetterMiddle = (isset($letters[1]))? $letters[1] : '';
		$plateLetterLeft = (isset($letters[2]))? $letters[2] : '';
		$dateOfBirthGregorian = date('Y-m-d',strtotime($dateOfBirthGregorian));
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://wasl.api.elm.sa/api/dispatching/v2/drivers",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS =>"{\r\n\"driver\":{\r\n\"identityNumber\":\"$identityNumber\",\r\n\"dateOfBirthGregorian\": \"$dateOfBirthGregorian\",  \r\n\"emailAddress\": \"$emailAddress\", \r\n\"mobileNumber\": \"$mobileNumber\"\r\n},\r\n\"vehicle\":{\r\n\"sequenceNumber\": \"$sequenceNumber\",\r\n\"plateLetterRight\": \"$plateLetterRight\",\r\n\"plateLetterMiddle\": \"$plateLetterMiddle\",\r\n\"plateLetterLeft\": \"$plateLetterLeft\",\r\n\"plateNumber\": \"$plateNumber\",\r\n\"plateType\": \"$plateType\"  \r\n}\r\n}",
		CURLOPT_HTTPHEADER => array(
			"Content-Type:  application/json",
			"client-id: ".config('elm-wasl.client-id'),
			"app-id: ".config('elm-wasl.app-id'),
			"app-key: ".config('elm-wasl.app-key'),   
			),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return json_decode($response);  
	} 

	public static function waslChechEligibility($identityNumber = ''){
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://wasl.api.elm.sa/api/dispatching/v2/drivers/eligibility/$identityNumber",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
			"Content-Type:  application/json",
			"client-id: ".config('elm-wasl.client-id'),
			"app-id: ".config('elm-wasl.app-id'),
			"app-key: ".config('elm-wasl.app-key'),  
			),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return json_decode($response);  
	}

	public static function registerTrip($sequenceNumber ='',$driverId='',$tripId='',$distanceInMeters=0,$durationInSeconds=0,$customerRating=0.0,$customerWaitingTimeInSeconds=0,$originCityNameInArabic='',$destinationCityNameInArabic='',$originLatitude=0.0,$originLongitude=0.0,$destinationLatitude=0.0,$destinationLongitude=0.0,$pickupTimestamp='',$dropoffTimestamp='',$startedWhen='',$tripCost=0.0){
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://wasl.api.elm.sa/api/dispatching/v2/trips",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS =>"{\r\n\"sequenceNumber\":\"$sequenceNumber\",\r\n\"driverId\": \"$driverId\",\r\n\"tripId\": $tripId,\r\n\"distanceInMeters\":$distanceInMeters,\r\n\"durationInSeconds\":$durationInSeconds,\r\n\"customerRating\":$customerRating,\r\n\"customerWaitingTimeInSeconds\":$customerWaitingTimeInSeconds,\r\n\"originCityNameInArabic\":\"$originCityNameInArabic\",\r\n\"destinationCityNameInArabic\":\"$destinationCityNameInArabic\",\r\n\"originLatitude\":$originLatitude,\r\n\"originLongitude\": $originLongitude,\r\n\"destinationLatitude\": $destinationLatitude,\r\n\"destinationLongitude\":$destinationLongitude,\r\n\"pickupTimestamp\":\"$pickupTimestamp\",\r\n\"dropoffTimestamp\":\"$dropoffTimestamp\",\r\n\"startedWhen\":\"$startedWhen\"\r\n,\r\n\"tripCost\":\"$tripCost\"\r\n}",
		CURLOPT_HTTPHEADER => array(
			"Content-Type:  application/json",
			"client-id: ".config('elm-wasl.client-id'),
			"app-id: ".config('elm-wasl.app-id'),
			"app-key: ".config('elm-wasl.app-key'),  
			),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		return json_decode( $response );  
	}

	public static function registerCaptainsLocations($driverIdentityNumber='',$vehicleSequenceNumber='',$latitude=0.0,$longitude=0.0,$hasCustomer=true,$updatedWhen=''){
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://wasl.api.elm.sa/api/dispatching/v2/locations",
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 0,
		CURLOPT_FOLLOWLOCATION => true,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "POST",
		CURLOPT_POSTFIELDS =>"{\r\n\"locations\":\r\n[\r\n{\r\n\"driverIdentityNumber\":\"$driverIdentityNumber\",\r\n\"vehicleSequenceNumber\": \"$vehicleSequenceNumber\",\r\n\"latitude\": $latitude,\r\n\"longitude\":$longitude,\r\n\"hasCustomer\": $hasCustomer,\r\n\"updatedWhen\":\"$updatedWhen\"\r\n}\r\n]\r\n}",
		CURLOPT_HTTPHEADER => array(
			"Content-Type:  application/json",
			"client-id: ".config('elm-wasl.client-id'),
			"app-id: ".config('elm-wasl.app-id'),
			"app-key: ".config('elm-wasl.app-key'),  
			),
		));

		$response = curl_exec($curl);
		curl_close($curl);
		return json_decode($response);  
	} 

}
