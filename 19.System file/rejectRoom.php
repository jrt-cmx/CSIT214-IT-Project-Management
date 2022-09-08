<?php

    include 'connection.php';

    $roomID = $_GET['roomID'];

    $sql = "DELETE FROM room WHERE roomID = '$roomID';";

    mysqli_query($conn, $sql);
    header("Location: supRoomList.php");


?>