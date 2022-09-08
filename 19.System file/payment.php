<?php

    require 'connection.php';

    $roomID = $_GET['roomID'];
    $bookingDate = $_GET['bookingDate'];
    $bookingTime = $_GET['bookingTime'];
    $stdID = $_GET['stdID'];
    $roomName = $_GET['roomName'];
    $price = $_GET['price'];
    $final;

    if(isset($_GET['promoInsert']))
    {
        $promoInsert = $_GET['promoInsert'];
    }

    $discount_amount = 0;

    $sql = "SELECT * FROM promo";
    $result = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($result))
    {
        if (isset($_GET['promoInsert']) && !empty($_GET['promoInsert']))
        {
            if ($row['code'] == $promoInsert)
            {
                if(isset($row['discount_amount']) && $row['discount_amount'] != 0)
                {
                    $discount_amount = $row['discount_amount'];
                    if ($discount_amount >= $price)
                    {
                        $final = 0;
                    }
                    else
                    {
                        $final = $price - $discount_amount;
                    }
                    
                }
                elseif(isset($row['discount_percentage']) && $row['discount_percentage'] != 0)
                {
                    $discount_percentage = $row['discount_percentage'];
                    $discount_amount = $price * ($discount_percentage / 100);
                    $final = $price - $discount_amount;
                }
                
            }
        }
        else
        {
            $final = $price;
        }
    }

?>

<html>
    <body>
        <form action="stdRoomAvailableDB.php" method="GET" id="myForm">
            <?php
                echo '<input type="hidden" name="roomID" value="'.$roomID.'">';
                echo '<input type="hidden" name="bookingDate" value="'.$bookingDate.'">';
                echo '<input type="hidden" name="bookingTime" value="'.$bookingTime.'">';
                echo '<input type="hidden" name="stdID" value="'.$stdID.'">';
                echo '<input type="hidden" name="price" value="'.$price.'">';
                echo '<input type="hidden" name="promoInsert" value="'.$promoInsert.'">';
            ?>

        </form>
    </body>
</html>

<?php
?>

