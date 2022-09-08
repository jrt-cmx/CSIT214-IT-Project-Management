<?php

    include 'connection.php';

    $roomID = $_GET['roomID'];
    $date = $_GET['date'];
    $time = $_GET['time'];
    $name = $_GET['name'];

    echo '<form action="staffRoomAdvEditBooking.php" method="GET" id="myForm">
            <input type="hidden" name="roomID" value="'.$_GET['roomID'].'">
            <input type="hidden" name="date" value="'.$_GET['date'].'">
            <input type="hidden" name="time" value="'.$_GET['time'].'">
            <input type="hidden" name="name" value="'.$_GET['name'].'">
        </form>';

    if (empty($date) && empty($time))
    {
        header("Location: staffRoomAdvEdit.php?roomID=$roomID&name=$name&error=empty");
    }
    else
    {
        $sql = "SELECT * FROM unavailable RIGHT OUTER JOIN room USING (roomID);";
        $result = mysqli_query($conn, $sql);
        $numOfRows = mysqli_num_rows($result);

        while($row = mysqli_fetch_assoc($result))
        {

            //check if unavail date is same as selected date for that room
            if ($roomID == $row['roomID'] && $date == $row['unavail_date'])
            {
                if (is_null($row['unavail_time']))
                {
                    header("Location: staffRoomAdvEdit.php?roomID=$roomID&name=$name&error=duplicate");
                    //echo '1';
                }
                else
                {
                    if(empty($time))
                    {
                        header("Location: staffRoomAdvEdit.php?roomID=$roomID&name=$name&error=duplicate");
                        //echo '2';
                    }
                    elseif(!empty($time))
                    {
                        $timeStr = $time . ':00';
                        if($timeStr == $row['unavail_time'])
                        {
                            header("Location: staffRoomAdvEdit.php?roomID=$roomID&name=$name&error=duplicate");
                            //echo '3';
                        }
                        else
                        {
                            echo '<script> document.getElementById("myForm").submit(); </script>';
                            //echo '4';
                        }
                    }
                }
            }

        }

        echo '<script> document.getElementById("myForm").submit(); </script>';
        //echo '5';

    }
    
?>
