<?php

require('vendor/autoload.php');

# Imports Auth libraries and Guzzle HTTP libraries.
use Google\Auth\Credentials\ServiceAccountCredentials;
use Google\Auth\Middleware\ScopedAccessTokenMiddleware;
use Google\Auth\Middleware\AuthTokenMiddleware;
use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;

$credentialsPath = 'iap-sample-359915-2dd0106521a3.json';
$url = 'https://iap-sample-359915.an.r.appspot.com/';
$clientId = '669155624520-ph9s9red5t2rkf83dluvupbs7raokt3l.apps.googleusercontent.com';

$serviceAccountCredentials = json_decode(file_get_contents($credentialsPath), true);
$creds = new ServiceAccountCredentials(null, $serviceAccountCredentials, null, $clientId);

// create middleware
$middleware = new AuthTokenMiddleware($creds);
$stack = HandlerStack::create();
$stack->push($middleware);

// create the HTTP client
$client = new Client([
  'handler' => $stack,
  'base_uri' => 'https://www.googleapis.com',
  'auth' => 'google_auth'  // authorize all requests
]);

// make the request
$response = $client->get($url);
echo $response->getBody() . "\n";
