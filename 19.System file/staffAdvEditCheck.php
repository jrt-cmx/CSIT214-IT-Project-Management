<?php

    include 'connection.php';

    $roomName = $_GET['roomName'];
    $date = $_GET['date'];
    $time = $_GET['time'];

    echo '<form action="staffAdvEditBooking.php" method="GET" id="myForm">
            <input type="hidden" name="roomName" value="'.$_GET['roomName'].'">
            <input type="hidden" name="date" value="'.$_GET['date'].'">
            <input type="hidden" name="time" value="'.$_GET['time'].'">
        </form>';

    if (empty($date) && empty($time))
    {
        header("Location: staffAdvEdit.php?error=empty");
    }
    else
    {
        $sql = "SELECT * FROM unavailable RIGHT OUTER JOIN room USING (roomID);";
        $result = mysqli_query($conn, $sql);
        $numOfRows = mysqli_num_rows($result);

        while($row = mysqli_fetch_assoc($result))
        {

            //check if unavail date is same as selected date for that room
            if ($roomName == $row['name'] && $date == $row['unavail_date'])
            {
                if (is_null($row['unavail_time']))
                {
                    header("Location: staffAdvEdit.php?error=duplicate");
                    //echo '1';
                }
                else
                {
                    if(empty($time))
                    {
                        header("Location: staffAdvEdit.php?error=duplicate");
                        //echo '2';
                    }
                    elseif(!empty($time))
                    {
                        $timeStr = $time . ':00';
                        if($timeStr == $row['unavail_time'])
                        {
                            header("Location: staffAdvEdit.php?error=duplicate");
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
            else
            {
                
            }
        }

        echo '<script> document.getElementById("myForm").submit(); </script>';
        //echo '5';

    }
    
?>
