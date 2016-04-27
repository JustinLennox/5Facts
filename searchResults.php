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
			$variable = $conn->prepare("SELECT name FROM Event");
			$variable->execute();

			//output results table
			//echo "<table> <tr> <td><b>Events related to search: </b>". 
				//htmlspecialchars($_POST["search"]) . "</td></tr>";
				
			//create array for search
			$searchResult = array();
			$count = 1;
			while($table = $variable->fetch( PDO::FETCH_ASSOC )){ 
				$eventID = $table['name'];

				//check if search matches the name of an event
				//then list those first
				//create list of words of search
				$searchWords = explode(" ", $_POST["search"]);
				for($i = 0; $i < count($searchWords); $i++)
				{
					if(strpos($table['name'], ucwords($searchWords[$i])) !== false)
					{
						//check if it is already in the search results array
						if(!in_array($table['name'], $searchResult))
						{
							$searchResult[count($searchResult) - 1] = $table['name'];
						}
						//echo "<tr><td>" . $table['name'];
					}
				}
				//echo "<tr><td>" . $table['name'] . "<form id='eventForm' action ='eventDetails.php' method='post'><input type='hidden' name='eventID' value='$eventID'/><input type='hidden' name='votes' value=''/><input type='submit' value='Select'/></form></td></tr>";
				
 				$count++;
			}	
			echo "</table>";

			$count = 1;
			echo "<table> <tr> <td><b>Events related to search: </b>". 
				htmlspecialchars($_POST["search"]) . "</td></tr>";
			foreach($searchResult as $x => $x_value){
				echo "<tr><td>" . $x_value . "<form id='eventForm' action ='eventDetails.php' method='post'><input type='hidden' name='eventID' value='$eventID'/><input type='hidden' name='votes' value=''/><input type='submit' value='Select'/></form></td></tr>";
				$count++;
			}
			echo "</table>";

			//if there are no results
			if(empty($searchResult))
			{
				echo "No Results<br><br>";	
			}
			
		
	
		if(isset($_SESSION['valid']))
		{
			echo "Currently logged in as " . $_SESSION['username'];
		}
		?>
		
	</body>
</html>
