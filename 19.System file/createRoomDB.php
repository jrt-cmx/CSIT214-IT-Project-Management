<?php

    include 'connection.php';

    $roomName = $_GET['roomName'];
    $price = $_GET['price'];
    $capacity = $_GET['capacity'];
    $availability = "off";
    $approved = "false";

    if(empty($roomName) || empty($price) || empty($capacity))
    {
        header("Location: createRoom.php?error=empty");
    }
    elseif (!is_numeric($price) || !is_numeric($capacity))
    {
        header("Location: createRoom.php?error=notnumeric");
    }
    else
    {
        $sql = "INSERT INTO room (name, price, capacity, availability, approved) VALUES('$roomName', '$price', '$capacity', '$availability', '$approved');";

        $result = mysqli_query($conn, $sql);
        
        if ($result == false)
        {
            header("Location: createRoom.php?error=failed");
        }
        else
        {
            header("Location: stfRoomAvailable.php");
        }
    }
    
?>
