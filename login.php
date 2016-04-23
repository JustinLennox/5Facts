<?php
   session_start();
?> 
<?
   // error_reporting(E_ALL);
   // ini_set("display_errors", 1);
?>

<html lang = "en">
   
   <head>
      <title>Login and Register!</title>
      <link rel="stylesheet" type="text/css" href="landing.css">
      
   </head>
	
   <body>
      
      <div id="header">
         <img src='5FactsLogo.png' height='50px' width='50px'/>
         <div id="headline"> FiveFacts </div>
         <div id="tagline">Get the scoop on current events quick.</div>
      </div>

      <h2>Enter Username and Password</h2> 
      <div id = "dunno">
         
         <?php
            //needs to redirect on correct login
            $msg = '';
            
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
				
               //logic for querying sql goes here to authenticate
               //if username matches password
               if ($_POST['username'] == 'thacker' && $_POST['password'] == 'pass') 
               {
                  //set session to true
                  $_SESSION['valid'] = True;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = $_POST['username'];
                  
                  header("location: index.php");
                  exit();
               }
               else {
                  $msg = 'Incorrect username or password';
               }
            }
         ?>
      </div> <!-- /container -->
      
      <div class = "signin">
      
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control" 
               name = "username" placeholder = "username" 
               required autofocus></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "password" required>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">Login</button>
         </form>
         
      </div> 
      
   </body>
</html>