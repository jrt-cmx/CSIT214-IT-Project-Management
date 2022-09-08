<?php

    include 'connection.php';

    $roomID = $_GET['roomID'];
    $roomName = $_GET['roomName'];
    $price = $_GET['price'];
    $capacity = $_GET['capacity'];

    if(isset($_GET['roomID']))
    {
        if(empty($roomName) || empty($price) || empty($capacity))
        {
            header("Location: manageRoom.php?room=$roomID&error=empty");
        }
        elseif (!is_numeric($price) || !is_numeric($capacity))
        {
            header("Location: manageRoom.php?room=$roomID&error=notnumeric");
        }
        else
        {
            $sql = "UPDATE room 
            SET price = '$price', capacity = '$capacity', name = '$roomName'
            WHERE roomID = '$roomID';";

            $result = mysqli_query($conn, $sql);
            if($result == false)
            {
                header("Location: manageRoom.php?room=$roomID&error=failed");
            }
            else
            {
                header("Location: staffRoomDetails.php");
            }
            
        }
    }

?>
