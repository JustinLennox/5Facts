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
			<a href="index.php"><img src='5FactsLogo.png' height='50px' width='50px'/></a>
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
			$eventID=htmlspecialchars($_POST["eventID"]);
			echo "<table> <tr><td></td><td><b>". $eventID . "</b></td><td><b>Vote Count: </b></td><td></td></tr>";
				
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
				for($i=1; $i<7; $i++){
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
								$vote1 = $vote2;
								$vote2 = $tempVote;
								$factOne = $factTwo;
								$factTwo = $tempFact;
						
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
								$vote2 = $vote3;
								$vote3 = $tempVote;
								$factTwo = $factThree;
								$factThree = $tempFact;
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
								$vote3 = $vote4;
								$vote4 = $tempVote;
								$factThree = $factFour;
								$factFour = $tempFact;
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
								$vote4 = $vote5;
								$vote5 = $tempVote;
								$factFour = $factFive;
								$factFive = $tempFact;
						}
					
				}
			}
			
			$variable = $conn->prepare('SELECT * FROM Event WHERE name = \'' . $event . '\'');
			$variable->execute();
			$count = 1;
			while($table = $variable->fetch( PDO::FETCH_ASSOC )){ 
				
				echo "<tr><td>Fact 1: </td><td>" . $factOne . "</td><td>" . $vote1 . "</td><td><form id='voteForm' action ='eventDetails.php' method='post'><select name='votes'><option value='5'>5</option><option value='4'>4</option><option value='3'>3</option><option value='2'>2</option><option value='1'>1</option></select></td></tr>";
				echo "<tr><td>Fact 2: </td><td>" . $factTwo . "</td><td>" . $vote2 . "</td><td></td></tr>";
				echo "<tr><td>Fact 3: </td><td>" . $factThree . "</td><td>" . $vote3 . "</td><td></tr>";
				echo "<tr><td>Fact 4: </td><td>" . $factFour . "</td><td>" . $vote4 . "</td><td></tr>";
				echo "<tr><td>Fact 5: </td><td>" . $factFive . "</td><td>" . $vote5 . "</td><td></td></tr>";
				echo "<tr><td>Additional Info: </td><td><a href=" . $table['linkOne'] . ">https://" . $table['linkOne'] ."</a></td><td></td></tr>";
 				$count++;
			}	
			echo "<tr><td></td><td></td><td></td><td><input type='hidden' name='eventID' value='$eventID'/><input type='submit' value='Select'/></form></td></tr>";
			echo "</table>";
			echo htmlspecialchars($_POST["votes"]);
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
