<?php
    include 'session.php';

    if($_SESSION['userType'] != "staff" || $_SESSION['superuser'] != "1")
    {
        header("Location: unauthorizedEntry.html");
    }
    if(isset($_GET['error']))
    {
      if($_GET['error'] == "empty")
      {
        echo '<script>alert("Please select start and end dates!")</script>';
      }
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
    <h2>View Room Usage</h2>
        <form action="supOverviewResults.php" method="GET">
            <label>From: </label>
            <input type="date" name="fromDate">
            <label>To: </label>
            <input type="date" name="toDate">
			&nbsp;&nbsp;
            <button type="submit" value="Search">
			    <span></span>
			    <span></span>
			    <span></span>
			    <span></span>
				Search
			</button>
        </form>
    </main>
</body>