<?php
	session_start();
	if(isset($_GET["eventID"])){
		$eventID=htmlspecialchars($_GET["eventID"]);
	
	} else{
		$eventID=htmlspecialchars($_POST["eventID"]);
	}
	
?>	
	<head>
		<title>5Facts.com</title>
		<link rel="stylesheet" type="text/css" href="landing.css">
		<link rel="stylesheet" type="text/css" href="event.css">
		<script src="//code.jquery.com/jquery-1.10.2.js"></script>
 		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>		
		<!-- A script for sorting the facts -->
		<script>
 			$(function() {
    			$( "#sortable" ).sortable();
    			$( "#sortable" ).disableSelection();
			});
  		</script>
  		<script>	//This is the script we use for getting the indexs when the user sorts
			var eventID = "<?php echo $eventID ?>";
			$(document).ready(function() {
  				$('#sortable').sortable({
				    start: function(e, ui) {
				        // creates a temporary attribute on the element with the old index
				        $(this).attr('data-previndex', ui.item.index());
				        //UI.ITEM.INDEX HERE IS THE FACT'S STARTING INDEX
				    },
				    update: function(e, ui) {
				        // gets the new and old index then removes the temporary attribute
				        var newIndex = ui.item.index();	//The place we've moved it to
				        var oldIndex = $(this).attr('data-previndex');	//The previous position it was at
						
				        $(this).removeAttr('data-previndex');
				        //UI.ITEM.INDEX HERE IS THE FACT'S ENDING INDEX AFTER THE USER MOVES IT
						var link = "eventDetails.php?newIndex=";
						link = link.concat(newIndex);
						link = link.concat("&oldIndex=");
						link = link.concat(oldIndex);
						link = link.concat("&eventID=");
						link = link.concat(eventID);
						window.location.href=link;
				    }
					
				});
  			});
			
  		</script>
		
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
			try 
			{
  			  $conn = new PDO("mysql:host=$servername;dbname=5facts", $username, $password);
			  //set the PDO error mode to exception
			  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			  //echo "Connected successfully"; 
		  	}
				
			catch(PDOException $e) {
			  echo "Connection failed: " . $e->getMessage();
    		 }
		
			 //vote logic
			if(isset($_GET["eventID"])){
				$fact = $_GET["oldIndex"] + 1;
				$fact = (string) "vote" . $fact;
				$vote = 4 - $_GET["newIndex"];
				
				$variable = $conn->prepare('SELECT * FROM Event WHERE name = \'' . $eventID . '\'');
				$variable->execute();
				while($table = $variable->fetch( PDO::FETCH_ASSOC )){ 
					$newVote = $table[$fact] + $vote;
					try {
					    $sql = 'UPDATE Event SET ' . $fact . ' = \'' . $newVote . '\' WHERE name = \'' . $eventID . '\'';
					    $stmt = $conn->prepare($sql);
					    $stmt->execute();
					    }
					catch(PDOException $e)
					    {
					    echo $sql . "<br>" . $e->getMessage();
					    }
				}
				
			}
			
			//query
			$variable = $conn->prepare('SELECT * FROM Event WHERE name = \'' . $eventID . '\'');
			$variable->execute();
			
			echo "<div class='event'><div id='eventTitle'><p>". $eventID . "</p></div>";
				
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
							    $sql = 'UPDATE Event SET factOne = \'' . $factTwo . '\', factTwo= \'' . $tempFact . '\', vote1= \'' . $vote2 . '\',vote2= \'' . $tempVote . '\'WHERE name = \'' . $eventID . '\'';
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
							    $sql = 'UPDATE Event SET factTwo = \'' . $factThree . '\', factThree= \'' . $tempFact . '\', vote2= \'' . $vote3 . '\',vote3= \'' . $tempVote . '\'WHERE name = \'' . $eventID . '\'';
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
							    $sql = 'UPDATE Event SET factThree = \'' . $factFour . '\', factFour= \'' . $tempFact . '\', vote3= \'' . $vote4 . '\',vote4= \'' . $tempVote . '\'WHERE name = \'' . $eventID . '\'';
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
							    $sql = 'UPDATE Event SET factFour = \'' . $factFive . '\', factFive= \'' . $tempFact . '\', vote4= \'' . $vote5 . '\',vote5= \'' . $tempVote . '\'WHERE name = \'' . $eventID . '\'';
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
			
			$variable = $conn->prepare('SELECT * FROM Event WHERE name = \'' . $eventID . '\'');
			$variable->execute();
			$count = 1;
			while($table = $variable->fetch( PDO::FETCH_ASSOC )){ 
				
				echo "<ol id='sortable'><li>" . $factOne . "</li>";
				echo "<li>" . $factTwo . "</li>";
				echo "<li>" . $factThree . "</li>";
				echo "<li>" . $factFour . "</li>";
				echo "<li>" . $factFive . "</li></ol>";
				echo "<p id='AdditionalInfo'>Additional Info: <a href=" . $table['linkOne'] . ">" . $table['linkOne'] ."</a><p>";
 				$count++;

		}
		
		echo "<p id='AdditionalInfo'>Drag facts to cast your vote!<p>";
		if(isset($_GET["newIndex"])){
			echo "Vote Cast!";
		}
		
			if($count == 1)
			{
				echo "No Results";	
			}
			
		
	
		if(isset($_SESSION['valid']))
		{
			echo "<p id='AdditionalInfo'>Currently logged in as " . $_SESSION['username'] . "<p>";
		}
		?>
	</body>
</html>
