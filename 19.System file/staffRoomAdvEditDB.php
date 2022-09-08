<?php

    include 'connection.php';

    $roomID = $_GET['roomID'];
    $roomName = $_GET['name'];
    $date = $_GET['date'];
    $time = $_GET['time'];

    if (empty($time))
    {
        $sql = "INSERT INTO unavailable (roomID, unavail_date)
        VALUES ('$roomID', '$date');";
        mysqli_query($conn, $sql);
        header("Location: stfRoomAvailable.php");
    }
    else
    {
        $sql = "INSERT INTO unavailable (roomID, unavail_date, unavail_time)
        VALUES ('$roomID', '$date', '$time');";
        mysqli_query($conn, $sql);
        header("Location: stfRoomAvailable.php");
    }

    
?>
