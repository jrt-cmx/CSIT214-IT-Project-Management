<?php
    include 'session.php';
    include 'payment.php';

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
  <title>Book Room</title>
</head>

<body>
	<div class="bg"> </div>
  <?php
      include 'studentNavBar.php';
  ?>

  <main>
    <div class="displayText">
	  <h2>Confirm Booking</h2>
      <p>Room: 
        <?php
            echo $roomName;
        ?>
      </p>
      <p>Date: 
        <?php
            echo $bookingDate;
        ?>
      </p>
      <p>Time: 
        <?php
            echo $bookingTime;
        ?>
      </p>
      <p>Price: 
        <?php
            echo '$'. $price;
        ?>
      </p>
      <p>Promo Code Applied: 
        <?php
            if (isset($_GET['promoInsert']))
            {
                echo $promoInsert;
            }
        ?>
      </p>
      <p>Amount Deducted: 
        <?php
            if (isset($_GET['promoInsert']))
            {
                echo '$' . number_format($discount_amount, 2, ".", "");
            }
        ?>
      </p>
      <p>Amount to pay: 
        <?php
            echo '$'. number_format($final, 2, ".", "");
        ?>
      </p>
      <button onclick=submitFunc()>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
          Confirm Payment
      </button>
      <button onclick="goBack()">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
          Back
      </button>

      <script>
          function submitFunc()
          {
              document.getElementById("myForm").submit();
          }
          function goBack()
          {
            window.history.back();
          }
      </script>

	</div>
  </main>
</body>