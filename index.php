<?php
	session_start();
?>	
	<head>
		<title>5Facts.com</title>
		<link rel="stylesheet" type="text/css" href="landing.css">
		<link rel="stylesheet" type="text/css" href="login.css">
		<link rel='shortcut icon' href='favicon.ico' type='image/x-icon'/ >
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

    	<form id='SearchForm' action="searchResults.php" method="POST">
  			<input id='SearchBar' type="text" name="search" placeholder='Search for something like GOP Debate or UGA G Day'  style='text-indent:40px;'/>
		</form>
	</body>
</html>
