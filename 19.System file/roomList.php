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
    <h3>Room List</h3>

    <?php
      require 'connection.php';

      $sql = "SELECT * FROM room;";
      $result = mysqli_query($conn, $sql);

      $numOfRows = mysqli_num_rows($result);

      if ($numOfRows > 0)
      {
        while ($row = mysqli_fetch_assoc($result))
        {
          echo '<a href="manageRoom.php?room='. $row['roomID'] .'">';
          echo '<button type="button">';
		  echo '<span></span>';
		  echo '<span></span>';
		  echo '<span></span>';
		  echo '<span></span>';
		  echo $row['name'];
		  echo '</button>';
          echo '</a>';
            
        }
      }
    ?>

  </main>
</body>