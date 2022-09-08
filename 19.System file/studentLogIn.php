<?php
  session_start();
?>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="userType.css"/>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap"/>
    <title>Student Log In</title>
  </head>
  
  <body>
    <main>
      <img src="logo.png">
      <div class="headerText">
	<div class="cloud"></div>
        <h1>Welcome to UOW's Room Booking System!</h1>
      </div>
      <div class="displayText">
        <form action="studentLoginDB.php" method="POST">
          <p>Please enter your login details</p>
          <input type="text" class="txtbox" placeholder="Username" name="username" id="inputID">
          </br>
          <input type="password" class="txtbox" placeholder="Password" name="password" id="inputPW">
          </br> </br>
          <button type="submit" name="login" value="Login">
	        <span></span>
		    <span></span>
		    <span></span>
		    <span></span>
			Log in
	      </button>
          <button type="reset" value="Reset">
	        <span></span>
		    <span></span>
		    <span></span>
		    <span></span>
			Reset
	      </button>
	   </br> </br>
	  <button name="Back">
	        <span></span>
		    <span></span>
		    <span></span>
		    <span></span>
			Back
	      </button>
        </form>

        <?php
            $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

            if(strpos($fullUrl, "error=empty") == true)
            {
                echo '<script language="javascript">';
                echo 'alert("Please enter username and password!")';
                echo '</script>';
            }
            elseif(strpos($fullUrl, "error=sqlerror") == true)
            {
                echo '<script language="javascript">';
                echo 'alert("ERROR: SQL ERROR!")';
                echo '</script>';
            }
            elseif(strpos($fullUrl, "error=nouser") == true)
            {
                echo '<script language="javascript">';
                echo 'alert("Invalid user!")';
                echo '</script>';
            }
            elseif(strpos($fullUrl, "error=wrongpassword") == true)
            {
                echo '<script language="javascript">';
                echo 'alert("Invalid password!")';
                echo '</script>';
            }
        ?>

      </div>
    </main>
  </body>