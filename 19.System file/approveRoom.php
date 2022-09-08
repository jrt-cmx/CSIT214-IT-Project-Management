<?php

    include 'connection.php';

    $roomID = $_GET['roomID'];
    $avail = "on";
    $approved = "true";

    $sql = "UPDATE room 
    SET availability = '$avail', approved = '$approved'
    WHERE roomID = '$roomID';";

    echo $roomID;

    mysqli_query($conn, $sql);
    header("Location: supRoomList.php");


?>
