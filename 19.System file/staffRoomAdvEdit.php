<?php
    include 'session.php';

    if($_SESSION['userType'] != "staff" || $_SESSION['superuser'] != "0")
    {
        header("Location: unauthorizedEntry.html");
    }
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script defer src="theme.js"></script>
  <link rel="stylesheet" href="stfRoomAvailable.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <title>Advanced Room Edit</title>
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

    $roomID = $_GET['roomID'];
    $name = $_GET['name'];
                
    $sql = "SELECT * FROM unavailable RIGHT OUTER JOIN room USING (roomID) WHERE roomID = $roomID;";
    $result = mysqli_query($conn, $sql);
    $numOfRows = mysqli_num_rows($result);

      echo '<h2>'. $_GET['name'] .'</h2>';
    

  ?>
  <table>
    <thead>
      <tr>
        <th>Room Name</th>
        <th>Date</th>
        <th>Time</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      
      <?php          
        if ($numOfRows > 0)
        {
            $result = mysqli_query($conn, $sql);
            while ($row = mysqli_fetch_assoc($result))
            {
              if($row['unavail_date'] != NULL)
              {             
                echo '<tr>';
                echo '<td>'. $row['name'] . '</td>';
                echo '<td>'. $row['unavail_date'] . '</td>';
                echo '<td>'. $row['unavail_time'] . '</td>';
                echo '<td><a href="deleteRoomUnavailDB.php?unavailID='.$row['unavailID'].'"style="text-decoration:none">&nbsp<input type="button" class="iButton2"></a></td>';
                echo '</tr>';
              }
              elseif($row['unavail_date'] == NULL)
              {
                echo '<h3>No unavailable timings set!</h3>';
              }
            }
        }
        

      ?>
      
    </tbody>
  </table>
      
  
  <h3>Edit unavailable timings</h3>
    <form action="staffRoomAdvEditCheck.php" method="GET">
        <?php
            echo '<input type="hidden" name="roomID" id="roomID" value="'.$roomID.'">';
            echo '<input type="hidden" name="name" id="name" value="'.$name.'">';
        ?>

        <label>Date</label>    
        <input type="date" name="date">
        </br>

        <label>Time</label>
        <input type="time" name="time">
        </br> </br>

		<button type="submit" value="Set">
		    <span></span>
		    <span></span>
		    <span></span>
		    <span></span>
			Set
		</button>
    </form>
    <?php
      if(isset($_GET['error']))
    {
      if($_GET['error'] == "empty")
      {
        echo '<script>
              alert("Please enter unavailable date / date and time");
            </script>';
      }
      elseif($_GET['error'] == "duplicate")
      {
        echo '<script>
              alert("Error! Duplicate data exists!");
            </script>';
      }
    }
    ?>
  </main>
</body>