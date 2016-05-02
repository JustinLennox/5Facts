<?php
	session_start();
?>	
	<head>
		<title>5Facts.com</title>
		<link rel="stylesheet" type="text/css" href="landing.css">
		<link rel="stylesheet" type="text/css" href="login.css">
		<link rel="stylesheet" type="text/css" href="createEvent.css">
	</head>
	<body>


		<div id="header">
			<?php 
				if(isset($_SESSION['valid']))
				{
					echo "<div id='logout'><a href='logout.php' style='text-decoration: none;'>" . $_SESSION['username'] . " (Logout)</div>";
				}else{
					echo "<div id='login'><a href='login.php' style='text-decoration: none;'>Login/Register</a></div>";
				}
			?>
			<a href="index.php"><img src='5FactsLogo.png' height='50px' width='50px'/></a>
        	<div id="headline"> FiveFacts </div>
        	<div id="tagline">Get the scoop on current events quick.</div>
    	</div>

  

		<?php 
		 
			//server details
			$servername = "localhost";
			$username = "root";
			$password = "";

			//connect to server
			try {
  			  $conn = new PDO("mysql:host=$servername;dbname=5facts", $username, $password);
			  //set the PDO error mode to exception
			  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			  //echo "Connected successfully"; 
		  		}
				
			catch(PDOException $e) {
			  echo "Connection failed: " . $e->getMessage();
    		  }
		
			//query
			try {
				$name = htmlspecialchars($_POST["Name"]);
				$factone = htmlspecialchars($_POST["Fact1"]);
				$facttwo = htmlspecialchars($_POST["Fact2"]);
				$factthree = htmlspecialchars($_POST["Fact3"]);
				$factfour = htmlspecialchars($_POST["Fact4"]);
				$factfive = htmlspecialchars($_POST["Fact5"]);
				$url = htmlspecialchars($_POST["url"]);
				$userCreated = $_SESSION['username'];
				$sql = "INSERT INTO Event (name, factOne, factTwo, factThree, factFour, factFive, linkOne, userCreated) VALUES ('$name', '$factone', '$facttwo', '$factthree', '$factfour', '$factfive', '$url', '$userCreated')";
				$conn->exec($sql);
				
				echo "<p id='eventSuccess'><b>Event successfully created!<b></p><br>";
			}
			
			catch (PDOException $e){
				echo $sql . "<br>" . $e->getMessage();
			}
			
			?>
	</body>
</html>