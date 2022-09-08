<?php
    include 'session.php';

    if($_SESSION['userType'] != "staff" || $_SESSION['superuser'] != "1")
    {
        header("Location: unauthorizedEntry.html");
    }
    if(empty($_GET['fromDate']) || empty($_GET['toDate']))
    {
        header("Location: supOverview.php?error=empty");
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

  <title>Staff Portal</title>
</head>

<body>
    <main>
	<div class="bg"> </div>
    <?php
        include 'supNavBar.php';
    ?>
    <table>
        <thead>
        <colgroup>
            <col span="8" style="width:150px">
        </colgroup>
            <tr>
                <th>Room ID: </th>
                <th>Room Name: </th>
                <th>Student ID: </th>
                <th>Booking ID: </th>
                <th>Booking Date: </th>
                <th>Booking Time: </th>
                <th>Price: </th>
                <th>Capacity: </th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                include 'connection.php';

                $fromDate = $_GET['fromDate'];
                $toDate = $_GET['toDate'];

                $sql = "SELECT * FROM booking JOIN room USING (roomID)
                WHERE '$fromDate' <= bookingDate
                AND '$toDate' >= bookingDate;";

                $result = mysqli_query($conn, $sql);
                $numOfRows = mysqli_num_rows($result);

                if ($numOfRows > 0)
                {
                    while ($row = mysqli_fetch_assoc($result))
                    {
                        echo '<td>'.$row['roomID'].'</td>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['stdID'].'</td>
                                <td>'.$row['bookingID'].'</td>
                                <td>'.$row['bookingDate'].'</td>
                                <td>'.$row['bookingTime'].'</td>
                                <td>'.$row['price'].'</td>
                                <td>'.$row['capacity'].'</td>';
                        echo '</tr>';
                    }
                    
                }
                ?>
		</tbody>
    </table>
    </main>
</body>