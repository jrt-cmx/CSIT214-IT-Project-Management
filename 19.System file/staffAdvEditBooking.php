<?php

    include 'connection.php';

    $roomName = $_GET['roomName'];
    $date = $_GET['date'];
    $time = $_GET['time'];

    echo '<form action="staffAdvEditDB.php" method="GET" id="myForm">
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
        $sql = "SELECT * FROM booking RIGHT OUTER JOIN room USING (roomID);";
        $result = mysqli_query($conn, $sql);
        $numOfRows = mysqli_num_rows($result);

        while($row = mysqli_fetch_assoc($result))
        {

            //check if unavail date is same as selected date for that room
            if ($roomName == $row['name'] && $date == $row['bookingDate'])
            {
                $roomID = $row['roomID'];

                if(empty($time))
                {
                    echo '<script>
                            if(confirm("Student has booked a slot at this timing.\nConfirm set?"))
                            {
                                alert("Room will be set to unavailable.\nPlease inform student booking had been cancelled");
                                location.href = "staffAdvEditDeleteBooking.php?roomName='.$roomName.'&roomID='.$roomID.'&date='.$date.'&time='.$time.'";
                            }
                            else
                            {
                                location.href = "staffAdvEdit.php";
                            }
                        </script>';
                }
                elseif(!empty($time))
                {
                    $timeStr = $time . ':00';
                    if($timeStr == $row['bookingTime'])
                    {
                        echo '<script>
                            if(confirm("Student has booked a slot at this timing.\nConfirm set?"))
                            {
                                alert("Room set to unavailable.\nPlease inform student to cancel booking.");
                                location.href = "staffAdvEditDeleteBooking.php?roomName='.$roomName.'&roomID='.$roomID.'&date='.$date.'&time='.$time.'";
                            }
                            else
                            {
                                location.href = "staffAdvEdit.php";
                            }
                        </script>';
                    }
                    else
                    {
                        echo '<script> document.getElementById("myForm").submit(); </script>';
                        //echo '4';
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
