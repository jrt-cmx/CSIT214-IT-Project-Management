<?php

    include 'connection.php';

    $roomID = $_GET['roomID'];
    $date = $_GET['date'];
    $time = $_GET['time'];
    $name = $_GET['name'];

    echo '<form action="staffRoomAdvEditDB.php" method="GET" id="myForm">
            <input type="hidden" name="roomID" value="'.$_GET['roomID'].'">
            <input type="hidden" name="date" value="'.$_GET['date'].'">
            <input type="hidden" name="time" value="'.$_GET['time'].'">
        </form>';

    if (empty($date) && empty($time))
    {
        header("Location: staffRoomAdvEdit.php?roomID=$roomID&name=$name&error=empty");
    }
    else
    {
        $sql = "SELECT * FROM booking RIGHT OUTER JOIN room USING (roomID);";
        $result = mysqli_query($conn, $sql);
        $numOfRows = mysqli_num_rows($result);

        while($row = mysqli_fetch_assoc($result))
        {

            //check if booking date is same as selected date for that room
            if ($roomID == $row['roomID'] && $date == $row['bookingDate'])
            {

                if(empty($time))
                {
                    echo '<script>
                            if(confirm("Student has booked a slot at this timing.\nConfirm set?"))
                            {
                                alert("Room will be set to unavailable.\nPlease inform student that booking has been cancelled.");
                                location.href = "staffRoomAdvEditDeleteBooking.php?roomID='.$roomID.'&date='.$date.'&time='.$time.'&name='.$name.'";
                            }
                            else
                            {
                                location.href = "staffRoomAdvEdit.php?roomID='.$roomID.'&name='.$name.'";
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
                                location.href = "staffRoomAdvEditDeleteBooking.php?roomID='.$roomID.'&date='.$date.'&time='.$time.'&name='.$name.'";
                            }
                            else
                            {
                                location.href = "staffRoomAdvEdit.php?roomID='.$roomID.'&name='.$name.'";
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

        }

        echo '<script> document.getElementById("myForm").submit(); </script>';
        //echo '5';

    }
    
?>
