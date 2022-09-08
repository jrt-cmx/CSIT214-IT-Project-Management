<?php

    include 'connection.php';

    $bookingID = $_GET['bookingID'];

    $sql = "DELETE FROM booking WHERE bookingID = '$bookingID';";

    mysqli_query($conn, $sql);
    header("Location: bookingList.php");


?>