<?php
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>IT490 - SFW</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta charset="UTF-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<script>
function HandleAPIResponse(response)
{
 var text = JSON.parse(response);
 
 document.getElementById("RecipeResponse").innerHTML = text+"<p>";
}

function PullRandomRecipes()
{
	var request = new XMLHttpRequest();
	
	var un = document.getElementById("username").value;
	var pw = document.getElementById("password").value;
	
	request.open("POST","pullRecipeTest.php",true);
	request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	request.onreadystatechange= function ()
	{
		console.log("Ready state " + this.readyState);
		console.log("Status " + this.status);
		
		
		HandleAPIResponse(this.responseText);
			
		document.getElementById("RecipeResponse").innherHTML = this.responseText;
		
		
	};
		
	request.onerror= function()
	{
		document.getElementById("RecipeResponse").value = "Failure!";
	};
	
	request.onload = function () {
		console.log("Loaded");
	};
	request.send();	
}
</script>

<body>
	<div class="jumbotron text-center">
		<h1>IT490 - SFW</h1>
	</div>
	
	<nav class="navbar navbar-expand-sm bg-primary navbar-dark">
		<ul class="navbar-nav">
			<li class="nav-item">
			  <a class="nav-link active" href="#">Home</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="loginPage.php">Login</a>
			</li>
			<li class="nav-item">
			  <a class="nav-link" href="registerPage.php">Register</a>
			</li>
			<?php
				if(!empty($_SESSION['user']))
				{	
					if($_SESSION['user'] != "guest")
					{	
						echo("<li class='nav-item'>
									 <a class='nav-link' href='logout.php'>Logout</a>
								 </li>");	
								 
						echo("<li class='nav-item'>
									 <a class='nav-link' active' href='profilePage.php'>My Profile</a>
								 </li>
								  </ul>
								 </nav>");	
					}
					else
					{
						echo("<li class='nav-item'>
							<a class='nav-link disabled' href='logout.php'>Logout</a>
						 </li>");				
						
						echo("<li class='nav-item'>
									 <a class='nav-link disabled'  href='profilePage.php'>My Profile</a>
								 </li>
								  </ul>
								 </nav>");	
					}
				}	
				else
				{
					echo("<li class='nav-item'>
							<a class='nav-link disabled' href='logout.php'>Logout</a>
						 </li>");		

					echo("<li class='nav-item'>
									 <a class='nav-link disabled'  href='profilePage.php'>My Profile</a>
								 </li>
								  </ul>
								 </nav>");	
				}				
		
			if(!empty($_SESSION['user']))
			{	
				if($_SESSION['user'] != 'guest')
				{
					echo ("<br><br><div>Welcome, ".$_SESSION['user']."!</div><br><br>".PHP_EOL);
				}
				else
				{
					echo ("<br><br><div>Welcome, guest!</div><br><br>".PHP_EOL);
				}
			}
			else
			{
				echo ("<br><br><div>Welcome, guest!</div><br><br>".PHP_EOL);
			}
	?>
	
	 <div class="row">
	  <div class="col-3">
		<h1>
			<?php echo $_SESSION['user']."'s profile"?>
		</h1>
		<div>
			BMI: 
		</div>
		<div>
			BMR: 
		</div>
		<div class = "text-center" id = "RecipeResponse">
			
		</div>
	  </div>
	  <div class="col-6">
		<div>
			Liked Recipes:
			<ul>
			
			</ul>
		</div>
	  </div>
	  <div class="col-3">
		<div>
			Disliked Recipes:
			<ul>
			
			</ul>
		</div>
	  </div>
	</div> 
	
	<div class = "col">
		<h2>Random Recipe Generator</h2>
		
		<div class="container-sm">
			<div class="text-center">
				<form name = "recipeGen" method="POST" action="getRandomRecipe.php" onsubmit="GetRandomRecipe()">
					<label for="tags">Tags:</label>
					<input type="text" id="tags" name ="tags">
					<p>
						*Valid tags include examples like: vegetarian, kosher, pescatarian
						<br>
						**Enter a comma-separated list.
					</p>
					<br>
					<br>
					<input type="submit" id="button" value="Get Recipe!">
				</form>
			</div>
		</div>
	</div>
	
	<div class="text-center" id="RecipeResponse">
		
	</div>
	
</body>
</html>