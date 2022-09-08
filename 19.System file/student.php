<?php
    include 'session.php';

    if($_SESSION['userType'] != "student")
    {
        header("Location: unauthorizedEntry.html");
    }
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="style.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script defer src="theme.js"></script>
  <title>Student Portal</title>
</head>

<body>
    
    <?php
      echo '<h1 align="center">Welcome back, '.$_SESSION['username'].'</h1>';
    ?>
	<div class="bird"> </div>
    <?php
      include 'studentNavBar.php';
    ?>

  <main>
    <div>
    <a href="stdRoomAvailable.php" style="text-decoration: none">
	    <button>
	      <span></span>
	      <span></span>
	      <span></span>
	      <span></span>
		  Show room available
	    </button>
	  </a>
	</div>
  </main>
</body>