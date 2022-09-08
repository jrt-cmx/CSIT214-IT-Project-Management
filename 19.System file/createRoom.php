<?php
    include 'session.php';

    if($_SESSION['userType'] != "staff" || $_SESSION['superuser'] != "0")
    {
        header("Location: unauthorizedEntry.html");
    }

    if(isset($_GET['error']))
    {
      if($_GET['error'] == "failed")
      {
        echo '<script>alert("Creation Error! \nCheck for duplicate!")</script>';
      }
    }
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script defer src="theme.js"></script>
  <link rel="stylesheet" href="createRoom.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <title>New Room</title>
</head>

<body>
	<div class="bg"> </div>

  <?php
    include 'staffNavBar.php';
  ?>

<main>
    <h3>New Room Creation</h3>
    <form action="createRoomDB.php" method="GET" onsubmit="return checkInt()">
      <div class="gridContainer">
        </br></br>
        <label>Room Name: </label>
        <input type="text" name="roomName" id="roomName">
        <label>Price: </label>   
        <input type="text" name="price" id="price">
        <label>Room size: </label>
        <input type="text" name="capacity" id="capacity">
      </div>
	  </br>
      <button type="submit" name="create">
        <span></span>
		<span></span>
		<span></span>
		<span></span>
	    Create
	  </button>
	</form>

  <script>
    function checkInt()
    {
      var capacity = document.getElementById("capacity").value;
      var result = Number.isInteger(+capacity);
      if (result)
      {
        return true;
      }
      else 
      {
        alert("Please only enter whole numbers for room capacity!");
        return false;
      }
    }
  </script>
    <?php
      if(isset($_GET['error']))
      {
        $error = $_GET['error'];
        
        if($error == "empty")
        {
          echo '<script language="javascript">';
          echo 'alert("Please fill in all fields!")';
          echo '</script>';
        }
        elseif($error == "notnumeric")
        {
          echo '<script language="javascript">';
          echo 'alert("Please enter only numbers into price and capacity!")';
          echo '</script>';
        }
      }
    ?>

  </main>
</body>