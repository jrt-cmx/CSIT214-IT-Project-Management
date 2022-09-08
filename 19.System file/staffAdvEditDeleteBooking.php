<?php

    include 'connection.php';

    $roomName = $_GET['roomName'];
    $roomID = $_GET['roomID'];
    $date = $_GET['date'];
    $time = $_GET['time'];

    if (empty($time))
    {
        $sql = "DELETE FROM booking WHERE bookingDate = '$date' AND roomID = '$roomID';";
        mysqli_query($conn, $sql);
        header("Location: staffAdvEditDB.php?roomName=$roomName&date=$date&time=$time");
    }
    else
    {
        $sql = "DELETE FROM booking WHERE bookingDate = '$date' AND bookingTime = '$time' AND roomID = '$roomID';";
        mysqli_query($conn, $sql);
        header("Location: staffAdvEditDB.php?roomName=$roomName&date=$date&time=$time");
    }


?>
