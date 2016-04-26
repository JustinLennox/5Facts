<?php
	session_start();
?>	
	<head>
		<title>5Facts.com</title>
		<link rel="stylesheet" type="text/css" href="landing.css">
	</head>
	<body>


		<div id="header">
			<div id="login"> <a href="login.php">Login/Register</a></div>
			<div id="logout"> <a href="logout.php">Logout</a></div>
			<img src='5FactsLogo.png' height='50px' width='50px'/>
        	<div id="headline"> FiveFacts </div>
        	<div id="tagline">Get the scoop on current events quick.</div>
    	</div>

    	<form id='SearchForm' action="searchResults.php" method="post">
  			<input id='SearchBar' type="text" name="search" placeholder='Search for something like GOP Debate or UGA G Day'  style='text-indent:40px;'/>
		</form>

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
			$event = htmlspecialchars($_POST['eventID']);
			$variable = $conn->prepare('SELECT * FROM Event WHERE name = \'' . $event . '\'');
			$variable->execute();

			//output results table
			echo "<table> <tr><td></td><td><b>". htmlspecialchars($_POST["eventID"]) . "</b></td><td><b>Vote Count: </b></td></tr>";
				
			$count = 1;
			while($table = $variable->fetch( PDO::FETCH_ASSOC )){ 
				
				//initialize vote variables
				$vote1 = $table['vote1'];
				$vote2 = $table['vote2'];
				$vote3 = $table['vote3'];
				$vote4 = $table['vote4'];
				$vote5 = $table['vote5'];
				
				//initialize fact variables
				$factOne = $table['factOne'];
				$factTwo = $table['factTwo'];
				$factThree = $table['factThree'];
				$factFour = $table['factFour'];
				$factFive = $table['factFive'];
				
				//orders 
				for($i=1; $i<6; $i++){
					for($j=1; $j<6; $j++){
						if($vote2 > $vote1){
							$tempVote = $vote1;
							$tempFact = $factOne;
							
							try {
							    $sql = 'UPDATE Event SET factOne = \'' . $factTwo . '\', factTwo= \'' . $tempFact . '\', vote1= \'' . $vote2 . '\',vote2= \'' . $tempVote . '\'WHERE name = \'' . $event . '\'';
							    $stmt = $conn->prepare($sql);
							    $stmt->execute();
							    }
							catch(PDOException $e)
							    {
							    echo $sql . "<br>" . $e->getMessage();
							    }
						}
						if($vote3 > $vote2){
							$tempVote = $vote2;
							$tempFact = $factTwo;
							
							try {
							    $sql = 'UPDATE Event SET factTwo = \'' . $factThree . '\', factThree= \'' . $tempFact . '\', vote2= \'' . $vote3 . '\',vote3= \'' . $tempVote . '\'WHERE name = \'' . $event . '\'';
							    $stmt = $conn->prepare($sql);
							    $stmt->execute();
							    }
							catch(PDOException $e)
							    {
							    echo $sql . "<br>" . $e->getMessage();
							    }
						}
						if($vote4 > $vote3){
							$tempVote = $vote3;
							$tempFact = $factThree;
							
							try {
							    $sql = 'UPDATE Event SET factThree = \'' . $factFour . '\', factFour= \'' . $tempFact . '\', vote3= \'' . $vote4 . '\',vote4= \'' . $tempVote . '\'WHERE name = \'' . $event . '\'';
							    $stmt = $conn->prepare($sql);
							    $stmt->execute();
							    }
							catch(PDOException $e)
							    {
							    echo $sql . "<br>" . $e->getMessage();
							    }
						}
						if($vote5 > $vote4){
							$tempVote = $vote4;
							$tempFact = $factFour;
							
							try {
							    $sql = 'UPDATE Event SET factFour = \'' . $factFive . '\', factFive= \'' . $tempFact . '\', vote4= \'' . $vote5 . '\',vote5= \'' . $tempVote . '\'WHERE name = \'' . $event . '\'';
							    $stmt = $conn->prepare($sql);
							    $stmt->execute();
							    }
							catch(PDOException $e)
							    {
							    echo $sql . "<br>" . $e->getMessage();
							    }
						}
					}
				}
			}
			
			$variable = $conn->prepare('SELECT * FROM Event WHERE name = \'' . $event . '\'');
			$variable->execute();
			$count = 1;
			while($table = $variable->fetch( PDO::FETCH_ASSOC )){ 
				
				echo "<tr><td>Fact 1: </td><td>" . $factOne . "</td><td>" . $vote1 . "</td></tr>";
				echo "<tr><td>Fact 2: </td><td>" . $factTwo . "</td><td>" . $vote2 . "</td></tr>";
				echo "<tr><td>Fact 3: </td><td>" . $factThree . "</td><td>" . $vote3 . "</td></tr>";
				echo "<tr><td>Fact 4: </td><td>" . $factFour . "</td><td>" . $vote4 . "</td></tr>";
				echo "<tr><td>Fact 5: </td><td>" . $factFive . "</td><td>" . $vote5 . "</td></tr>";
				echo "<tr><td>Additional Info: </td><td><a href=" . $table['linkOne'] . ">" . $table['linkOne'] ."</a></td><td></td></tr>";
 				$count++;
			}	
			echo "</table>";
			if($count == 1)
			{
				echo "No Results";	
			}
			
		
	
		if(isset($_SESSION['valid']))
		{
			echo "Currently logged in as " . $_SESSION['username'];
		}
		?>
		
	</body>
</html>
