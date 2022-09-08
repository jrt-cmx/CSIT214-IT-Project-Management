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
  <link rel="stylesheet" href="bookRoom.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script type="text/javascript" src="student.js"></script>
  <title>Student Portal</title>
</head>

<body>
<main>
	<div class="bg"> </div>
  <?php
    include 'staffNavBar.php';

    require 'connection.php';

    $sql= "SELECT * FROM room;";
    $result = mysqli_query($conn, $sql);
    $numOfRows = mysqli_num_rows($result);

    if($numOfRows > 0)
    {
        while($row = mysqli_fetch_assoc($result))
        {
            echo '<table>
                    <thead>
                        <tr>
                            <th colspan="3">'.$row['name'].'</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th>Price</td>
                            <td>'.$row['price'].'</td>
                        </tr>
                        <tr>
                            <th>Capacity</td>
                            <td>'.$row['capacity'].'</td>
                        </tr>
                        <tr>
                            <th>Availability</td>
                            <td>'.$row['availability'].'</td>
                        </tr>
                    </tbody>

            </table>';
        }
    }


  ?>
  </main>
</body>