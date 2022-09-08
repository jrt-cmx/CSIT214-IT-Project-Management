<?php

    include 'connection.php';

    $roomID = $_GET['roomID'];
    $avail = "off";

    $sql = "UPDATE room 
    SET availability = '$avail'
    WHERE roomID = '$roomID';";

    echo $roomID;

    mysqli_query($conn, $sql);
    header("Location: supRoomList.php");


?>
