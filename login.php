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
      <link rel="stylesheet" type="text/css" href="login.css">
      <script src="//code.jquery.com/jquery-1.10.2.js"></script>
      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
      <script>
          $(function() {
            $( "#dialog" ).dialog();
         });
      </script>
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
                  echo "<div id='dialog' title=''>Sorry, we do not have a user with that username and password.</div>";
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
            
                        echo "<div id='dialog' title=''>Account successfully created!</div>";

                        //save the new info to the user database
                        $_SESSION['valid'] = True;
                        $_SESSION['timeout'] = time();
                        $_SESSION['username'] = $_POST['newusername'];
                     }
         
               catch (PDOException $e){
               echo "<div id='dialog' title=''>Sorry, this username already exists.</div>";
               }
            }
         ?>
      </div> <!-- /container -->

      <div class = "signin">
         <p>Existing member? Sign in here.</p>
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control" 
               name = "username" placeholder = "Username" 
               required autofocus/></br>
            <input type = "password" class = "form-control"
               name = "password" placeholder = "Password" required /><br/>
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "login">Login</button>
         </form>
         
         <p>Or register a new account.</p>
         <form class = "form-signin" role = "form" 
            action = "<?php echo htmlspecialchars($_SERVER['PHP_SELF']); 
            ?>" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control" 
               name = "newusername" placeholder = "Username" ></br>
            <input type = "password" class = "form-control"
               name = "newpassword" placeholder = "Password" required><br />
            <button class = "btn btn-lg btn-primary btn-block" type = "submit" 
               name = "register">Register</button>
         </form>

      </div> 
      
   </body>
</html>