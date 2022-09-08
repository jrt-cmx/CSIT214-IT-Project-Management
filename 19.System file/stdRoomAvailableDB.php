<?php

    require 'connection.php';

    $roomID = $_GET['roomID'];
    $bookingDate = $_GET['bookingDate'];
    $bookingTime = $_GET['bookingTime'];
    $stdID = $_GET['stdID'];

    

    $sql = "INSERT INTO booking (roomID, bookingDate, bookingTime, stdID)
    VALUES ('$roomID', '$bookingDate', '$bookingTime', $stdID);";

    mysqli_query($conn, $sql);
    header("Location: bookingList.php");


?>