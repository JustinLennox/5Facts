<?php
	session_start();
?>	
	<head>
		<title>5Facts.com</title>
		<link rel="stylesheet" type="text/css" href="landing.css">
	</head>
	<body>


		<div id="header">
			<div id="login"> <a href="login.php" style="text-decoration: none;">Login/Register</a></div>
			<div id="logout"> <a href="logout.php" style="text-decoration: none;">Logout</a></div>
			<img src='5FactsLogo.png' height='50px' width='50px'/>
        	<div id="headline"> FiveFacts </div>
        	<div id="tagline">Get the scoop on current events quick.</div>
    	</div>

    	<form id='SearchForm' action="searchResults.php" method="POST">
  			<input id='SearchBar' type="text" name="search" placeholder='Search for something like GOP Debate or UGA G Day'  style='text-indent:40px;'/>
		</form>

		<?php 
		if(isset($_SESSION['valid']))
		{
			echo "Currently logged in as " . $_SESSION['username'];
			echo "<br>" . "Submit a new event " . "<a href='createEvent.php'>here</a>";
		}
		?>
		
	</body>
</html>
