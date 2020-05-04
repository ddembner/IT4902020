<?php
session_start();
require_once("testClient.php.inc");
?>

<?php
if(isset($_POST['subdata']) && ($_POST['subdata']) == "Submit"){
	extract($_POST);

	if($restriction != 'pick'){
		$un = "Poopy";
		$client = new rabbitMQClient("testRabbitMQ.ini", "testServer");
		$request = array();
		$request['username'] = "Poopy";
		$request['type'] = 'Database';
		$request['queryType'] = 'insert';
		$request['query'] = "insert into restrictions(id, restriction) SELECT login.id, '$restriction' from login where login.username = '$un'";
		//$request['query'] = "SELECT * from restrictions";
		$request['message'] = "Here's your stink'in restrictions ya filthy animal";
		$response = $client->send_request($request);
		if($response){
			$result = "Successfully inserted restriction";
		}
		else{
			$result = "Could not insert restriction";
		}
	}
	else{
		$result = "Select a restriction";
	}	
}

?>

<?php
	if(isset($_POST['remdata']) && ($_POST['remdata']) == "Remove"){
		extract($_POST);

		if($restriction != 'pick'){
			$un = "Poopy";
			$client = new rabbitMQClient("testRabbitMQ.ini", "testServer");
			$request = array();
			$request['username'] = "Poopy";
			$request['type'] = 'Database';
			$request['queryType'] = 'insert';
			$request['query'] = "DELETE restrictions FROM restrictions INNER JOIN login ON login.id = restrictions.id WHERE restriction = '$restriction' and login.username = '$un'";
			//$request['query'] = "SELECT * from restrictions";
			$request['message'] = "Happy Birthday Brandon";
			$response = $client->send_request($request);
			if($response){
				$result = "Successfully deleted restriction";
			}
			else{
				$result = "Could not insert restriction";
			}
		}
		else{
			$result = "Select a restriction";
		}
	
}
?>
<!DOCTYPE html>
<html>
        <head>
                <title>BMI Calculator</title>
                <link rel="stylesheet" type="text/css" href="bmicalcstyle.css" />
        </head>

        <body>
                <h2> Restriction </h2>
                <div class="restrictions">
                        <form id="restrictForm" name="restrictForm" method="post">
				Restrictions: <select name="restriction">
					<option value="pick">Pick A Restriction</option>
					<option value="meat">Meat</option>
					<option value="gluten">Gluten</option>
					<option value="nuts">Nuts</option>
					</select><br /><br />

				<input type="submit" name="subdata" id="subdata" class="btn" value="Submit"/><br /><br />

				<input type="submit" name="remdata" id="remdata" class="btn" value="Remove"><br /><br />
				Result: <?php echo $result; ?> 
                        </form>
		</div>
        </body>
</html>

