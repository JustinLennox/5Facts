<?php
	session_start();
?>	
	<head>
		<title>5Facts.com</title>
		<link rel="stylesheet" type="text/css" href="landing.css">
	</head>
	<body>


		<div id="header">
			<div id="logout"> <a href="logout.php" style="text-decoration: none;">Logout</a></div>
			<img src='5FactsLogo.png' height='50px' width='50px'/>
        	<div id="headline"> FiveFacts </div>
        	<div id="tagline">Get the scoop on current events quick.</div>
    	</div>
    	<div id="container">
    		<form method="post">
				<fieldset>
					<legend>Event Details</legend>
						<input name="Name" type="text" placeholder="Name" autofocus="autofocus" /> 
						<br><input name="Fact1" type="text" placeholder="Fact 1" />
						<br><input name="Fact2" type="text" placeholder="Fact 2" />  
						<br><input name="Fact3" type="text" placeholder="Fact 3" /> 
						<br><input name="Fact4" type="text" placeholder="Fact 4" /> 
						<br><input name="Fact5" type="text" placeholder="Fact 5" /> 
						<br><input type="submit" value="Submit new event" />
				</fieldset>
			</form>
		</div>
	</body>
</html>