<?php
	session_start();
?>	
	<head>
		<title>5Facts.com</title>
		<link rel="stylesheet" type="text/css" href="landing.css">
		<link rel="stylesheet" type="text/css" href="login.css">
		<link rel="stylesheet" type="text/css" href="searchResults.css">
	</head>
	<body>


		<div id="header">
			<?php 
				if(isset($_SESSION['valid']))
				{
					echo "<div id='logout'><a href='logout.php' style='text-decoration: none;'>" . $_SESSION['username'] . " (Logout)";
					echo "<br><a href='createEvent.php'> + Create Event</a></div>";
				}else{
					echo "<div id='login'><a href='login.php' style='text-decoration: none;'>Login/Register</a></div>";
				}
			?>
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
		
			//query for names of events
			$variable = $conn->prepare("SELECT name, factOne, factTwo, factThree, factFour, factFive, userCreated FROM Event");
			$variable->execute();
				
			//create array for search
			$searchResult = array();

			//create list of words of the search
			$searchWords = explode(" ", $_POST["search"]);

			//create array of extraneous words
			$extraneousSearch = array("the", "and", "or", "but", "a", "an", "g", "of", "admin", "on", "in");

			//create relevance variable
			$relevance = 55;

			while($table = $variable->fetch( PDO::FETCH_ASSOC ))
			{ 
				for($i = 0; $i < count($searchWords); $i++)
				{
					//if name matches an event
					//prioritize those first
					if(strpos(strtolower($table['name']), strtolower($searchWords[$i])) !== false)
					{
						//check if it is already in the search results array
						if(!in_array(strtolower($searchWords[$i]), $extraneousSearch))
						{
							if(!array_key_exists($table['name'], $searchResult))
							{
								$searchResult[$table['name']] = $relevance;
								$relevance--;
							}
							else
							{
								$searchResult[$table['name']] += $relevance;
								$relevance--;
							}
						}
					}

					//increase relevance if search has the user who submitted event
					if(strpos(strtolower($table['userCreated']), strtolower($searchWords[$i])) !== false)
					{
						if(!array_key_exists($table['name'], $searchResult))
						{
							$searchResult[$table['name']] = $relevance;
							$relevance--;
						}
					}

					//increase relevance if search has part of fact 1
					if(strpos(strtolower($table['factOne']), strtolower($searchWords[$i])) !== false)
					{
						if(!in_array(strtolower($searchWords[$i]), $extraneousSearch))
						{
							if(isset($searchResult[$table['name']]))
							{
								$searchResult[$table['name']] += 2;
							}
							else
							{
								$searchResult[$table['name']] = 2;
							}
						}
					}
					//increase relevance if search has part of fact 2
					if(strpos(strtolower($table['factTwo']), strtolower($searchWords[$i])) !== false)
					{
						if(!in_array(strtolower($searchWords[$i]), $extraneousSearch))
						{
							if(isset($searchResult[$table['name']]))
							{
								$searchResult[$table['name']] += 2;
							}
							else
							{
								$searchResult[$table['name']] = 2;
							}
						}
					}
					//increase relevance if search has part of fact 3
					if(strpos(strtolower($table['factThree']), strtolower($searchWords[$i])) !== false)
					{
						if(!in_array(strtolower($searchWords[$i]), $extraneousSearch))
						{
							if(isset($searchResult[$table['name']]))
							{
								$searchResult[$table['name']] += 2;
							}
							else
							{
								$searchResult[$table['name']] = 2;
							}
						}
					}
					//increase relevance if search has part of fact 4
					if(strpos(strtolower($table['factFour']), strtolower($searchWords[$i])) !== false)
					{
						if(!in_array(strtolower($searchWords[$i]), $extraneousSearch))
						{
							if(isset($searchResult[$table['name']]))
							{
								$searchResult[$table['name']] += 2;
							}
							else
							{
								$searchResult[$table['name']] = 2;
							}
						}
					}
					//increase relevance if search has part of fact 5
					if(strpos(strtolower($table['factFive']), strtolower($searchWords[$i])) !== false)
					{
						if(!in_array(strtolower($searchWords[$i]), $extraneousSearch))
						{
							if(isset($searchResult[$table['name']]))
							{
								$searchResult[$table['name']] += 2;
							}
							else
							{
								$searchResult[$table['name']] = 2;
							}
						}
					}
				}				
			}	
		
			//now sort the array by descending value
			arsort($searchResult);

			echo "<div id='searchTable'> <b>Events related to search: </b>". 
				htmlspecialchars(ucwords($_POST["search"]) );
			foreach($searchResult as $x => $x_value){
				echo "<form id='eventForm' action ='eventDetails.php' method='post'>";
				echo "<div id='searchResult'> <input type='submit' id='relevanceTag' value='" . min(round(($x_value / 68) * 100, 1), 95) . "%'/>";
				echo  "<input type='submit' id='searchResultInput' value='". $x . "'/>";
				echo "<input type='hidden' name='eventID' value='$x'/></div></form>";
			}
			//if there are no results
			if(empty($searchResult))
			{
				echo "<div id='searchTable'><form id='noResultsForm' action=''>"; 
				echo "<div id='searchResult'> <input type='submit' id='relevanceTag' value='0%' disabled/>";
				echo  "<input type='submit' id='searchResultInput' value='No Results :(' disabled/></div></div></form>";
			}
		?>
		
	</body>
</html>
