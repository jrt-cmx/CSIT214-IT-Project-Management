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
  <div class="bg"></div>
  <?php
    include 'staffNavBar.php';
  ?>

  <main>
  <h2></h2>
  <?php

    require 'connection.php';

    $promoID = $_GET['promoID'];
                
    $sql = "SELECT * FROM promo WHERE promoID = $promoID;";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo '<h2>'. $row['code'] .'</h2>';


  ?>
  <h3>Edit Promo Code details</h3>
    <form action="managePromoCodeDB.php" method="GET">
      <?php
      echo '<input type="hidden" name="promoID" value="'.$row['promoID'].'">';
      ?>
      <div class="gridContainer">
        <label>Promo Code </label>
        <?php
          echo '<input type="text" name="promoCode" value="'.$row['code'].'">';
        ?>
        <label>Discount Amount</label>
        <?php
          echo '<input type="text" name="discountAmt"';

          if (isset($row['discount_amount']))
          {
            echo 'value="'.$row['discount_amount'].'">';
          }
          else
          {
            echo '>';
          }         
        ?>
        <label>Discount Percentage</label>
        <?php
          echo '<input type="text" name="discountPercent"';

          if (isset($row['discount_percentage']))
          {
            echo 'value="'.$row['discount_percentage'].'">';
          }
          else
          {
            echo '>';
          }

        ?>

      </div> 
    </br>
    <button type="submit" value="Set">
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		set
	</button>
    <button type="button" value="Back" onclick="goBack()">
		<span></span>
		<span></span>
		<span></span>
		<span></span>
		back
	</button>

    <script>
        function goBack()
        {
            window.history.back();
        }
    </script>
    
    </form>
	 <?php
      if(isset($_GET['error']))
      {
        if($_GET['error'] == "failed")
        {
          echo '<script>alert("Modification Error! \nCheck for duplicate!")</script>';
        }
        if($_GET['error'] == "empty")
        {
          echo '<script>alert("Modification error!\nPlease fill in empty fields!")</script>';
        }
        elseif($_GET['error'] == "both")
        {
          echo '<script>alert("Modification error!\nPlease only select either percentage or amount!")</script>';
        }
        elseif($_GET['error'] == "notnumeric")
        {
          echo '<script>alert("Modification error!\nPlease only numbers into percentage or amount!")</script>';
        }
        elseif($_GET['error'] == "zero")
        {
          echo '<script>alert("Please do not set discount to zero!\nDelete if no longer needed.")</script>';
        }
        elseif($_GET['error'] == "notinrange")
        {
          echo '<script>alert("Please enter a range of 0 to 100 for percentage!")</script>';
        }
      }
    ?>
  </main>
</body>