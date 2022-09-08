<?php

    include 'connection.php';

    $promoID = $_GET['promoID'];

    $sql = "DELETE FROM promo WHERE promoID = '$promoID';";

    mysqli_query($conn, $sql);
    header("Location: stfCodeAvailable.php");


?>