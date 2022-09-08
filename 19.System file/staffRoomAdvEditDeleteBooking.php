<?php

    include 'connection.php';

    $roomID = $_GET['roomID'];
    $roomName = $_GET['name'];
    $date = $_GET['date'];
    $time = $_GET['time'];

    if (empty($time))
    {
        $sql = "DELETE FROM booking WHERE bookingDate = '$date' AND roomID='$roomID';";
        mysqli_query($conn, $sql);
        header("Location: staffRoomAdvEditDB.php?roomID=$roomID&date=$date&time=$time&name=$name");
    }
    else
    {
        $sql = "DELETE FROM booking WHERE bookingDate = '$date' AND bookingTime = '$time' AND roomID='$roomID';";
        mysqli_query($conn, $sql);
        header("Location: staffRoomAdvEditDB.php?roomID=$roomID&date=$date&time=$time&name=$name");
    }

    
?>
