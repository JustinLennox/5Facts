<!DOCTYPE html>
	<head>
		<link rel="stylesheet" type="text/css" href="landing.css"
	</head>
	<body>
		<div id="header">
			<img src='5FactsLogo.png' height='50px' width='50px'/>
        	<div id="headline"> FiveFacts </div>
        	<div id="tagline">Get the scoop on current events quick.</div>
    	</div>

    	<form id='SearchForm'>
  			<input id='SearchBar' type="text" name="firstname" placeholder='Search for something like GOP Debate or UGA G Day'  style='text-indent:40px;'/>
		</form>
		
		<?php echo "<h1>Results for " . htmlspecialchars($_POST["firstname"]) . "</h1>";
		 ?>
		
	</body>
</html>