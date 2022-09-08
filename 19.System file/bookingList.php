<?php
    include 'session.php';

    if($_SESSION['userType'] != "student")
    {
        header("Location: unauthorizedEntry.html");
    }
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script defer src="theme.js"></script>
  <link rel="stylesheet" href="bookRoom.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script type="text/javascript" src="student.js"></script>
  <title>Modify Booking</title>
</head>

<body>
  <div class="bg"> </div>
    <?php
      include 'studentNavBar.php';
    ?>

  <main>
    <div>
    <h2>Your Bookings</h2>
      <input type="hidden" id="bookingID" name="bookingID">
	  <table id="generatedTable">
    <colgroup>
      <col span="2" style="width:75">
      <col span="3" style="width:100">
    </colgroup>
        <thead>
          <tr>
            <th>Booking ID</th>
            <th>Room ID</th>
            <th>Room Name</th>
            <th>Date</th>
            <th>Time</th>  
            <th></th>               
          </tr>
        </thead>
        <tbody>
        <?php
            require 'connection.php';

            $sql = "SELECT * FROM booking JOIN room USING (roomID);";
            $result = mysqli_query($conn, $sql);

            $numOfRows = mysqli_num_rows($result);

            if ($numOfRows > 0)
            {
              while ($row = mysqli_fetch_assoc($result))
              {
                if ($row['stdID'] == $_SESSION['userID'])
                {
                echo '<tr>';
				        echo '<td>'. $row['bookingID'] . '</td>';
                echo '<td>'. $row['roomID'] . '</td>';
                echo '<td>'. $row['name'] . '</td>';
				        echo '<td>'. $row['bookingDate'] . '</td>';
                echo '<td>'. $row['bookingTime'] . '</td>';
                echo '<td><a href="deleteBookingDB.php?bookingID='.$row['bookingID'].'"><input type="button" class="iButton2"></a></td>';
                echo '</tr>';
                }
              }
            }
          ?>
        </tbody>
      </table>
	</div>
  </main>
</body>