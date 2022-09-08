<?php
    include 'session.php';

    if($_SESSION['userType'] != "staff")
    {
        header("Location: unauthorizedEntry.html");
    }
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script defer src="theme.js"></script>
  <link rel="stylesheet" href="manageRoom.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <title>Room Details</title>
</head>

<body>
  <div class="bg"> </div>
  <?php
      include 'staffNavBar.php';
  ?>

  <main>
  <h2></h2>
  <?php

    require 'connection.php';

    $roomID = $_GET['room'];
                
    $sql = "SELECT * FROM room WHERE roomID = $roomID;";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo '<h2 id="nameDisplayBox"><span id="nameDisplay">'. $row['name'] .'</span>&nbsp&nbsp&nbsp<button id="editButton" class="iButton" onclick="edit()"></button></h2>';
  ?>



  <h3>Edit room details</h3>
    <form action="manageRoomDB.php" method="GET" onsubmit="return checkInt()">
      <?php
      echo '<input type="hidden" name="roomName" id="roomName">';
      echo '<input type="hidden" name="roomID" value="'.$row['roomID'].'">';
      ?>
      <div class="gridContainer">
        <label>Price: </label>
        <?php
          echo '<input type="text" name="price" value="'.$row['price'].'">';
        ?>
        <label>Room size: </label>
        <?php
          echo '<input type="text" name="capacity" id="capacity" value="'.$row['capacity'].'">';
        ?>
      </div> 
    </br>
    <button type="submit" value="Set">
	  <span></span>
	  <span></span>
	  <span></span>
	  <span></span>
	  Set
	</button>
    <?php
      echo '<a href="staffRoomAdvEdit.php?roomID='. $row['roomID'] .'&name='.$row['name'].'">';
      echo '<button type="button" value="Edit specific date/time">';
	  echo '<span></span>';
	  echo '<span></span>';
	  echo '<span></span>';
	  echo '<span></span>';
	  echo 'Edit specific date/time';
	  echo '</button>';
      echo '</a>';
	  echo '&nbsp';
      echo '<a href="deleteRoomDB.php?roomID='.$row['roomID'].'">';
	  echo '<button type="button" value="Delete">';
	  echo '<span></span>';
	  echo '<span></span>';
	  echo '<span></span>';
	  echo '<span></span>';
	  echo 'Delete';
	  echo '</button>';
      echo '</a>';
    ?>
    
    </form>

    <script>
      function checkInt()
      {
        var capacity = document.getElementById("capacity").value;
        var result = Number.isInteger(+capacity);
        setName();
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
      echo '<script>
            function edit()
            {
              document.getElementById("nameDisplayBox").innerHTML = "<input type=\"text\" name=\"roomName\" id=\"nameEdit\"> <button onclick=\"done()\">Done</button>";
              
            }
            function done()
            {
              //get value of keyed in name
              var newName = document.getElementById("nameEdit").value;
              document.getElementById("nameDisplayBox").innerHTML = "<span id=\"nameDisplay\"></span>&nbsp&nbsp&nbsp<button id=\"editButton\" class=\"iButton\" onclick=\"edit()\"></button>";
              document.getElementById("nameDisplay").innerHTML = newName;
            }
            function setName()
            {
              var nameData = document.getElementById("nameDisplay").innerHTML;
              var nameInput = document.getElementById("roomName");
              nameInput.setAttribute("value", nameData);
            }
            </script>';

            if(isset($_GET['error']))
            {
              if($_GET['error'] == "empty")
              {
                echo '<script>alert("Error! Please ensure all fields are filled in!")</script>';
              }
              elseif($_GET['error'] == "notnumeric")
              {
                echo '<script>alert("Please enter only numbers into price and capacity!")</script>';
              }
              elseif($_GET['error'] == "failed")
              {
                echo '<script>alert("Modification error! Check for duplicates!")</script>';
              }

            }
    ?>
  </main>
</body>