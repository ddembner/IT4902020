#!/usr/bin/php
<?php
require_once('path.inc');
require_once('get_host_info.inc');
require_once('rabbitMQLib.inc');
require_once('handleUsers.php.inc');
require_once('sendDisLog.php');

function doLogin($username,$password)
{
    // lookup username in databas
    // check password
    $login = new DatabaseAccess();
    return $login->validateLogin($username,$password);
    //return false if not valid
}

function doRegisterUser($username, $password)
{
    $login = new DatabaseAccess();
    return $login->RegisterUser($username, $password);
}

function doLogoutUser($username, $password)
{
    $login = new DatabaseAccess();
    return $login->LogoutUser($username, $password);
}

function doQueryRestrictions($username)
{
	$login = new DatabaseAccess();
	return $login->queryRestrictions();
}

function doDatabaseTransaction($request){
  $client = new rabbitMQClient("testRabbitMQ.ini","dbServer");
  $response = $client->send_request($request);
  return $response;

}

function doDmzTransaction($request){
	$client = new rabbitMQClient("testRabbitMQ.ini", "dmzServer");
	$response = $client->send_request($request); //First we get the information from api
	for($i = 0; $i < 3; $i++){
		var_dump($response[$i], true);
	}
	$db_response = doDatabaseTransaction($response); //Then send information to database
	return $db_response;
}

function requestProcessor($request)
{
  echo "received request".PHP_EOL;
  var_dump($request);
  if(!isset($request['type']))
  {
    return "ERROR: unsupported message type";
  }

  SendToLogger("Rabbit " . $request['message']);

  switch ($request['type'])
  {
    case "Login":
    	return doLogin($request['username'],$request['password']);
    case "Register":
    	return doRegisterUser($request['username'], $request['password']);
   case "Logout":
   	return doLogoutUser($request['username'], $request['password']);
   case "Database":
   	return doDatabaseTransaction($request);
   case "DMZ":
	return doDmzTransaction($request);
   default:
   	 break;
  }
  return array("returnCode" => '0', 'message'=>"Server received request and processed");
}

$server = new rabbitMQServer("testRabbitMQ.ini","testServer");
SendToLogger("Rabbit Machine Start");
echo "testRabbitMQServer BEGIN".PHP_EOL;
$server->process_requests('requestProcessor');
SendToLogger("Rabbit Machine shutdown");
echo "testRabbitMQServer END".PHP_EOL;
exit();
?>
 
