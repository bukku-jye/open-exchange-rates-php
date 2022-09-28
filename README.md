Open Exchange Rates SDK in PHP
-------------------------------
#### About the Open Exchange Rates API

Open Exchange Rates provides a simple, lightweight and portable JSON API with live and historical foreign exchange (forex) rates for over 200 worldwide and digital currencies, via a simple and easy-to-integrate API, in JSON format. Data are tracked and blended algorithmically from multiple reliable sources, ensuring fair and unbiased consistency.

Exchange rates published through the Open Exchange Rates API are collected from multiple reliable providers, blended together and served up in JSON format for everybody to use. There are no complex queries, confusing authentication methods or long-term contracts.

##### Features
* Latest up-to-date Exchange Rates
* Historical Exchange Rates back to 1st January 1999
* Time Series Exchange Rates for a given time period
* Currency Converstion
* Historical Open, High Low and Close

Website: [https://openexchangerates.org/](https://openexchangerates.org/)

Installation
-----

#### With Composer
```
composer require bukku-acc/open-exchange-rates-sdk
```

Getting Started
-----
Use it as a class
```
use BukkuAccounting\OpenExchangeRatesSdk\oerSdk;
$oerSdk = new $oerSdk('YOUR_APP_ID');
```

Available functions
-----
* All the API endpoints listed in [https://docs.openexchangerates.org/reference/api-introduction](https://docs.openexchangerates.org/reference/api-introduction) are made available to use
* Methods can be chained
* All functions return an object
* Will abort with the message and status code if there is an error

###### Example: Request latest rates via "latest" endpoint
```
$res = $oerSdk
    ->base('SGD')
    ->symbols('USD,EUR,GBP')
    ->latest()
```
###### Example: Request historical rates via "historical" endpoint
```
$res = $oerSdk
    ->date('2022-01-01)
    ->base('SGD')
    ->symbols('USD,EUR,GBP')
    ->historical()
```
###### Example: Request the list of currency symbols available via "currencies" endpoint
```
$res = $oerSdk
    ->currencies()
```
###### Example: Request historical rates for a given time period via "time_series" endpoint
```
$res = $oerSdk
    ->start('2000-01-01')
    ->end('2000-12-31')
    ->base('SGD')
    ->symbols('USD,EUR,GBP')
    ->time_series()
```
###### Example: Convert any value from one currency to another via "convert" endpoint
```
$res = $oerSdk
    ->value(10000)
    ->from('SGD')
    ->to('MYR')
    ->convert()
```
###### Example: Request the historical Open, High Low, Close and Average for a given time period via "ohlc" endpoint
```
$res = $oerSdk
    ->start_time('2017-07-17T00:00:00Z')
    ->period('1w')
    ->base('SGD')
    ->symbols('USD,EUR,GBP')
    ->ohlc()
```
###### Example: Request the plan information and usage statistics via "usage" endpoint
```
$res = $oerSdk
    ->usage()
```

Reference API Documentation
-----
Visit [https://docs.openexchangerates.org/reference/api-introduction](https://docs.openexchangerates.org/reference/api-introduction) for more details on each function
