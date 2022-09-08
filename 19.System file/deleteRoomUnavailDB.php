<?php

    include 'connection.php';

    $unavailID = $_GET['unavailID'];

    $sql = "DELETE FROM unavailable WHERE unavailID = '$unavailID';";

    mysqli_query($conn, $sql);
    header("Location: roomList.php");


?>