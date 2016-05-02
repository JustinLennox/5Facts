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
    	<div id="container">
    		<form action= "eventConfirmation.php" method="post">
				<fieldset>
<!-- 					<legend></legend>
 -->						<input name="Name" type="text" placeholder="Name" autofocus="autofocus" id='Name' /> 
						<br><input name="Fact1" type="text" placeholder="Fact 1" id= 'Fact' />
						<br><input name="Fact2" type="text" placeholder="Fact 2" id= 'Fact'/>  
						<br><input name="Fact3" type="text" placeholder="Fact 3" id= 'Fact'/> 
						<br><input name="Fact4" type="text" placeholder="Fact 4" id= 'Fact'/> 
						<br><input name="Fact5" type="text" placeholder="Fact 5" id= 'Fact'/> 
						<br><input name="url" type="text" placeholder="Additional Info URL" id='Fact'/> 
						<br><input type="submit" value="Create Event" id = 'Submission'/>
				</fieldset>
			</form>
		</div>
	</body>
</html>