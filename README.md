# elm-wasl
## Installation

You can install the package via [Composer](https://getcomposer.org).

```bash
composer require maree/elm-wasl
```
Publish your sms config file with

```bash
php artisan vendor:publish --provider="maree\elmWasl\ElmWaslServiceProvider" --tag="elm-wasl"
```
then change your elm-wasl config from config/elm-wasl.php file
```php
    "client-id" => "",//example ACD7A113-XXXX-4B68-B125-xxxxxxxxxx
    "app-id"    => "", //example xd8e9xxx
    "app-key"   => "", //example xx5784489c7147220924b4abb8xxxxxx
```
## Usage

## waslRegisterDriverAndCar
- to send driver and car to elm
```php
namespace maree\elmWasl;

elmWasl::waslRegisterDriverAndCar($identityNumber='',$dateOfBirthGregorian='',$emailAddress='',$mobileNumber='',$sequenceNumber='',$plateLetters='',$plateNumbers='',$plateType='');

```

- note : dateOfBirthGregorian in that format 'Y-m-d'
- note : add mobile with country code ex: +9665000000000
- note : leave space between plateLetters ex: 'a b c'
- note : car plate Types exists in api documentation sent to you
```php
$plateTypes = ['1' => 'خصوصي' ,'2' => 'نقل عام' ,'3' => 'نقل خاص' ,'4' => 'حافلة صغيرة عامة', '5' => 'حافلة صغيرة خاصة', '6' => 'اجرة' ,'7' => 'معدات ثقيلة', '8' => 'تصدير' ,'9' =>'دبلوماسي' ,'10' =>'دراجة نارية', '11' => 'مؤقت'];
```

## waslChechEligibility
- to check if driver and car info that i sent to wasl accepted or refused or waiting
```php
namespace maree\elmWasl;

elmWasl::waslChechEligibility($identityNumber = '');

```
- note : you run this service by cron job every day or 12 hour to check if driver accepted or refused and update his status in your app


## registerTrip
- to send trips that finished to wasl check first you sent that trip or no 
```php
namespace maree\elmWasl;

elmWasl::registerTrip($sequenceNumber ='',$driverId='',$tripId='',$distanceInMeters=0,$durationInSeconds=0,$customerRating=0.0,$customerWaitingTimeInSeconds=0,$originCityNameInArabic='',$destinationCityNameInArabic='',$originLatitude=0.0,$originLongitude=0.0,$destinationLatitude=0.0,$destinationLongitude=0.0,$pickupTimestamp='',$dropoffTimestamp='',$startedWhen='',$tripCost=0.0);

```
- note : $sequenceNumber is car sequence number 'الرقم التسلسلي'


## registerCaptainsLocations
- send moving captains updated locations
```php
namespace maree\elmWasl;

elmWasl::registerCaptainsLocations($driverIdentityNumber='',$vehicleSequenceNumber='',$latitude=0.0,$longitude=0.0,$hasCustomer=true,$updatedWhen='');

```
- note : you can use cron job to run that service every minute or you can execute that service inside update your driver locations api 'tracking drivers' to run every driver location changes

## note
if you have problem with dates you can convert them like that
```php 
    $pickupTimestamp = new DateTime($trip->pickupTimestamp, new DateTimeZone('Asia/Riyadh'));
    $pickupTimestamp = $pickupTimestamp->format(DateTime::ISO8601);
```

## current elm wasl services :
- waslRegisterDriverAndCar
- waslChechEligibility
- registerTrip
- registerCaptainsLocations







