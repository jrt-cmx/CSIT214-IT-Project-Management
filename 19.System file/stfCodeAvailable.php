<?php
    include 'session.php';

    if($_SESSION['userType'] != "staff" || $_SESSION['superuser'] != "0")
    {
        header("Location: unauthorizedEntry.html");
    }

    if(isset($_GET['error']))
    {
      if($_GET['error'] == "empty")
      {
        echo '<script>alert("Creation error!\nPlease fill in empty fields!")</script>';
      }
      elseif($_GET['error'] == "both")
      {
        echo '<script>alert("Creation error!\nPlease only select either percentage or amount!")</script>';
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
	<div class="bg"> </div>
  <?php
    include 'staffNavBar.php';
  ?>

  <main>
    <div>
	  <h2>PromoCode Available</h2>
	  <table id="generatedTable">
        <thead>
          <tr>
            <th>PromoID: </th>
			<th>Code: </th>
            <th>Discount Amount: </th>
            <th>Discount Percentage: </th>
            <th></th>
          </tr>
        </thead>
        <tbody></tbody>

          <?php
            require 'connection.php';

            $sql = "SELECT * FROM promo;";
            $result = mysqli_query($conn, $sql);

            $numOfRows = mysqli_num_rows($result);

            if ($numOfRows > 0)
            {
              while ($row = mysqli_fetch_assoc($result))
              {
                echo '<tr>';
				        echo '<td class="promo" style="height:50px">'. $row['promoID'] . '</td>';
                echo '<td class="promo">'. $row['code'] . '</td>';
				        echo '<td class="promo">'. $row['discount_amount'] . '</td>';
                echo '<td class="promo">'. $row['discount_percentage'] . '</td>';
                echo '<td>&nbsp<a href="managePromoCode.php?promoID='.$row['promoID'].'"><input type="button" class="iButton1" ></a>&nbsp';
                echo '<a href="deletePromoCodeDB.php?promoID='.$row['promoID'].'"><input type="button" class="iButton2" ></a></td>';
                echo '</tr>';
              }
            }
          ?>

      </table>
	</div>
  </main>
</body>