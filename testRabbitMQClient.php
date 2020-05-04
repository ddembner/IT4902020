#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');

$client = new rabbitMQClient("testRabbitMQ.ini","testServer");


//$request = array();
//$request['type'] = "DMZ";
//$request['username'] = $argv[1];
//$request['password'] = $argv[2];
//$request['message'] = "Test DMZ";
//$response = $client->send_request($request);
//$response = $client->publish($request);

$request = array();
$request['type'] = "Database";
$request['query'] = "select vegan, vegetarian, dairyFree, glutenFree, calories from restrictions join calbudget where restrictions.id = 5 and calbudget.id = 5";
$request['queryType'] = "select";
$request['username'] = "5";
$request['message'] = "getting restrictions";

$response = $client->send_request($request);

print_r($response[0]['vegan']);
print_r($response[0]['vegetarian']);
print_r($response[0]['dairyFree']);
print_r($response[0]['glutenFree']);

echo "client received response: ".PHP_EOL;
print_r($response);
echo "\n\n";

echo $argv[0]." END".PHP_EOL;

