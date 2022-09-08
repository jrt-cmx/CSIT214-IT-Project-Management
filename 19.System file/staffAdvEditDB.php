<?php

    include 'connection.php';

    $roomName = $_GET['roomName'];
    $date = $_GET['date'];
    $time = $_GET['time'];

    if (empty($date) && empty($time))
    {

        header("Location: staffAdvEdit.php?error=empty");
    }
    elseif (empty($time))
    {
        $sql = "INSERT INTO unavailable (roomID, unavail_date)
            VALUES ((SELECT roomID
            FROM room WHERE name = '$roomName'), '$date');";
        mysqli_query($conn, $sql);
        header("Location: stfRoomAvailable.php");
    }
    else
    {
        $sql = "INSERT INTO unavailable (roomID, unavail_date, unavail_time)
            VALUES ((SELECT roomID
            FROM room WHERE name = '$roomName'), '$date', '$time');";
        mysqli_query($conn, $sql);
        header("Location: stfRoomAvailable.php");
    }


?>
