#!/usr/bin/php
<?php

require_once('rabbitMQLib.inc');

function SendToLogger($message){
		
	$client = new rabbitMQClient("testRabbitMQ.ini", "logServer");
	$date = date_create('now', timezone_open('America/New_York'));	
	$timeMessage = date_format($date, 'H:i:sa') . ':';
	$client->publish($timeMessage . $message, 30000);
}

?>
