<?php
    include 'session.php';

    if($_SESSION['userType'] != "staff" || $_SESSION['superuser'] != "0")
    {
        header("Location: unauthorizedEntry.html");
    }

    if(isset($_GET['error']))
    {
      if($_GET['error'] == "failed")
      {
        echo '<script>alert("Creation Error! \nCheck for duplicate!")</script>';
      }
    }
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script defer src="theme.js"></script>
  <link rel="stylesheet" href="promoCode.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <title>Room Details</title>
</head>

<body>
	<div class="bg"> </div>
  <?php
      include 'staffNavBar.php';
  ?>

  <main>
  <h3>Promotional Codes</h3>
    <form action="promoCodeDB.php" method="POST">
      <div class="gridContainer">
        <label>Code number</label>
            <input type = "text" name="code">
            </br>

            <label>Discount</label>
            <select name="discountType" id="discountType">
              <option value="amount">$</option>
              <option value="percentage">%</option>
            </select>
            <input type = "integer" name="discount">
            </br>

            <button type="submit" name="create">
			  <span></span>
		      <span></span>
		      <span></span>
		      <span></span>
	          Create
	        </button>
      </div> 
    </br>
    </form>

    <?php
      if(isset($_GET['success']))
      {
        echo '<script language="javascript">';
        echo 'alert("Promo code successfully created!")';
        echo '</script>';

      }
      elseif(isset($_GET['error']))
      {
        $error = $_GET['error'];
        
        if($error == "empty")
        {
          echo '<script language="javascript">';
          echo 'alert("Please fill in all fields!")';
          echo '</script>';
        }
        elseif($error == "notnumeric")
        {
          echo '<script language="javascript">';
          echo 'alert("Please enter only numbers into discount amount!")';
          echo '</script>';
        }
        elseif($error == "notinrange")
        {
          echo '<script language="javascript">';
          echo 'alert("Please enter a range of 0 to 100 for percentage!")';
          echo '</script>';
        }
      }

    ?>
  </main>
</body>