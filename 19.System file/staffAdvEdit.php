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
                
    $sql = "SELECT * FROM room LEFT OUTER JOIN unavailable USING (roomID);";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $numOfRows = mysqli_num_rows($result);
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
              if(!is_null($row['unavailID']))
              {
                echo '<tr>';
                echo '<td>'. $row['name'] . '</td>';
                echo '<td>'. $row['unavail_date'] . '</td>';
                echo '<td>'. $row['unavail_time'] . '</td>';
                echo '<td><a href="deleteUnavailDB.php?unavailID='.$row['unavailID'].'"><input type="button" class="iButton2"></a></td>';
                echo '</tr>';
              }
            }
        }
      ?>
      </tbody>
  </table>
  
  <h3>Edit unavailable timings</h3>
    <form action="staffAdvEditCheck.php" method="GET">
        <?php
        $result = mysqli_query($conn, $sql);
        $roomArray = array();

        if ($numOfRows > 0)
        {
          while ($row = mysqli_fetch_assoc($result))
          {
            $checker = "no";

            foreach ($roomArray as $loopdata)
            {
              if ($loopdata == $row['name'])
              {
                $checker = "yes";
              }
            }

            if($checker == "no")
            {
              //populate array with list of room names
              array_push($roomArray, $row['name']);
            }
          }
        }

        ?>

        <label>Room Name</label>
        <select name="roomName">
          <?php
            foreach ($roomArray as $loopdata)
            {
              echo '<option value="'.$loopdata.'">'.$loopdata.'</option>';
            }
          ?>
        </select>
        </br>

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