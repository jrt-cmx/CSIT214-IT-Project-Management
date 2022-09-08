<?php
    include 'session.php';

    if($_SESSION['userType'] != "staff" || $_SESSION['superuser'] != "1")
    {
        header("Location: unauthorizedEntry.html");
    }
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script defer src="theme.js"></script>
  <link rel="stylesheet" href="suproom.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>

  <title>Staff Portal</title>
</head>

<body>
	<div class="bg"> </div>

    <?php
        include 'supNavBar.php';
    ?>

  <main>
    <div>
	  <h2>Room List</h2>
	  <table id="generatedTable">
    <colgroup>
      <col style="width:75">
      <col span="4" style="width:100">
    </colgroup>
        <thead>
          <tr>
            <th>RoomID: </th>
			      <th>Name: </th>
            <th>Price: </th>
            <th>Capacity: </th>
            <th>Availability: </th>
            <th colspan="2"></th>
                 
          </tr>
        </thead>
        <tbody></tbody>

          <?php
            require 'connection.php';

            $sql = "SELECT * FROM room;";
            $result = mysqli_query($conn, $sql);

            $numOfRows = mysqli_num_rows($result);

            if ($numOfRows > 0)
            {
              while ($row = mysqli_fetch_assoc($result))
              {
                
                if($row['approved'] == "true")
                {
                  echo '<tr>';
                  echo '<td class="roomID">'. $row['roomID'] . '</td>';
                  echo '<td class="name">'. $row['name'] . '</td>';
                  echo '<td class="price">'. $row['price'] . '</td>';
                  echo '<td class="capacity">'. $row['capacity'] . '</td>';
                  echo '<td class="availability">'. $row['availability'] . '</td>';

                  if($row['availability'] == "off")
                  {
                    echo '<td><a href="approveRoom.php?roomID='.$row['roomID'].'"><input type="button" value="Enable" style="width: 80px"></a></td>';
                    echo '<td><a href="rejectRoom.php?roomID='.$row['roomID'].'"><input type="button" value="Remove" style="width: 80px"></a></td>';
                  }
                  elseif($row['availability'] == "on")
                  {
                    echo '<td colspan="2"><a href="disableRoomDB.php?roomID='.$row['roomID'].'"><input type="button" value="Disable" style="width: 160px"></a></td>';
                  }

                }

                
                echo '</tr>';
              }
            }
          ?>

      </table>
	</div>
  </main>
</body>