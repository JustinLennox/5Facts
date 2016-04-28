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
         <a href="index.php"><img src='5FactsLogo.png' height='50px' width='50px'/></a>
         <div id="headline"> FiveFacts </div>
         <div id="tagline">Get the scoop on current events quick.</div>
      </div>

      <div id = "loginPost">
         
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
            
            //needs to redirect on correct login
            $msg = '';
            
            if (isset($_POST['login']) && !empty($_POST['username']) 
               && !empty($_POST['password'])) {
				
               //logic for querying sql goes here to authenticate
               //if username matches password
               $username = htmlspecialchars($_POST['username']);
               $variable = $conn->prepare('SELECT password FROM User WHERE userName =  \'' . $username . '\'');
               $variable->execute();

               $count = 1;
               $dbPassword = "";
            while($userList = $variable->fetch( PDO::FETCH_ASSOC )){ 
               $dbPassword = $userList['password'];
               $count++;
            }  

            if(isset($variable))
            {
               $count = 0;
               if ($_POST['password'] == $dbPassword) 
               {
                  //set session to true
                  $_SESSION['valid'] = True;
                  $_SESSION['timeout'] = time();
                  $_SESSION['username'] = $_POST['username'];
                  
                  header("location: index.php");
                  exit();
               }
               else
               {
                  echo "Incorrect username or password";
               }
            }
         }
            
            if (isset($_POST['register']) && !empty($_POST['newusername']) 
               && !empty($_POST['newpassword'])) {
            
               //logic for querying sql to see
               //if username already exists
                  try {
                        $username = htmlspecialchars($_POST["newusername"]);
                        $password = htmlspecialchars($_POST["newpassword"]);
                        $sql = "INSERT INTO User (userName, password, isAdmin) VALUES ('$username', '$password', 0)";
                        $conn->exec($sql);
            
                        echo "Account successfully created!";

                        //save the new info to the user database
                        $_SESSION['valid'] = True;
                        $_SESSION['timeout'] = time();
                        $_SESSION['username'] = $_POST['newusername'];
                     }
         
               catch (PDOException $e){
               echo "Error: Username already exists";
               }
            }
         ?>
      </div> <!-- /container -->

      <div class = "signin">
         <p>Existing member? Sign in here:</p>
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
         
         <p>Register new account here:</p>
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control" 
               name = "newusername" placeholder = "username" ></br>
            <input type = "password" class = "form-control"
               name = "newpassword" placeholder = "password" required>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "register">Register</button>
         </form>

      </div> 
      
   </body>
</html>