<?php
    include 'session.php';

    if($_SESSION['userType'] != "student")
    {
        header("Location: unauthorizedEntry.html");
    }
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script defer src="theme.js"></script>
  <link rel="stylesheet" href="bookRoom.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script type="text/javascript" src="student.js"></script>
  <title>Student Portal</title>
</head>

<body>
	<div class="bg"> </div>
  <?php
      include 'studentNavBar.php';
  ?>

  <main>
    <div>
	  <h2>Room Available</h2>
	  <table id="generatedTable">
        <thead>
          <tr>
            <th>
              <form action="stdRoomAvailable.php" method="GET">
                <input type="date" name="date" id="date">
             
                <input type="submit" value="Check">
              </form>

              <?php
                if(isset($_GET['date']) && !empty($_GET['date']))
                {
                  echo '<script>
                        document.getElementById("date").defaultValue="'.$_GET['date'].'";
                        </script>';

                  $getDate = $_GET['date'];
                }
              ?>

            </th>
            <th>09:00am</th>
            <th>10:00am</th>
            <th>11:00am</th>
            <th>12:00pm</th>
            <th>01:00pm</th>
            <th>02:00pm</th>
            <th>03:00pm</th>
            <th>04:00pm</th>
            <th>05:00pm</th>                   
          </tr>
        </thead>
        <tbody></tbody>
          <?php
            require 'connection.php';

            //sql statement
            $sql = "SELECT * FROM room LEFT OUTER JOIN unavailable USING (roomID) LEFT OUTER JOIN booking USING (roomID);";
            $result = mysqli_query($conn, $sql);
            $numOfRows = mysqli_num_rows($result);

            //create arrays
            $datas = array();
            $array = array();
            $roomID = array();
            $priceArray = array();

            if ($numOfRows > 0)
            {
              while ($row = mysqli_fetch_assoc($result))
              {
                //populate datas array with data from sql statement
                $datas[] = $row;
                $checker = "no";

                foreach ($array as $loopdata)
                {
                  if ($loopdata == $row['name'])
                  {
                    $checker = "yes";
                  }
                }

                if($checker == "no" && $row['availability'] == "on")
                {
                  //populate push "array" array with list of room names
                  array_push($array, $row['name']);
                  array_push($roomID, $row['roomID']);
                  array_push($priceArray, $row['price']);
                }
              }
            }

            $arraySize = count($array);

            //call the query again
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
                      
            if ($arraySize > 0)
            {
              //loop through each room
              for ($j = 0; $j < $arraySize; $j++)
              {
                echo '<tr>';
                echo '<td class="room">'. $array[$j] . '</td>';

                //for time 09:00 till 18:00
                for($i = 9; $i < 18; $i++)
                {
                  echo '<td class="';
                  //echo '<td>';
                  $available = "yes";
                  //echo 'yes';

                  //loop through the "datas" array
                  for($x = 0; $x < count($datas); $x++)
                  {
                    if($datas[$x]['name'] == $array[$j])
                    {
                      if(isset($getDate))
                      {
                        //if selected date is equal to unavailable date in the table
                        if($getDate == $datas[$x]['unavail_date'])
                        {
                          //if time is not null
                          if(is_null($datas[$x]['unavail_time']) != 1)
                          {
                            $unavail_time = $datas[$x]['unavail_time'];

                            if ($i == 9)
                            {
                              $cellTime = '0' . $i . ':00:00';
                            }
                            else
                            {
                              $cellTime = $i . ':00:00';
                            }
                            
                            if($unavail_time == $cellTime && $getDate == $datas[$x]['unavail_date'])
                            {
                              $available = "no";
                              //echo 'no';
                            }
                            //if booked date happens to be an unavailable date too ,  check for booking time
                            else if($datas[$x]['bookingDate'] == $datas[$x]['unavail_date'])
                            {
                              if($cellTime == $datas[$x]['bookingTime'])
                              {
                                $available = "booked";
                              }
                              
                            }
                          }
                          elseif(is_null($datas[$x]['unavail_time']) == 1)
                          {
                            $available = "no";
                          }
                        }
                        //else if selected date is equal to booked date
                        elseif($getDate == $datas[$x]['bookingDate'])
                        {
                          $bookingTime = $datas[$x]['bookingTime'];

                          if ($i == 9)
                          {
                            $cellTime = '0' . $i . ':00:00';
                          }
                          else
                          {
                            $cellTime = $i . ':00:00';
                          }

                          if($cellTime == $datas[$x]['bookingTime'])
                          {
                            $available = "booked";
                            //echo 'booked2';
                          }
                        }        
                      }
                    }
                  }

                  //set class = yes or no (available to book or not)
                  //set id = time_roomname_roomID
                  echo $available. '"';
                  echo 'id = "' . $i . '_' . $array[$j] . '_' . $roomID[$j].'_'. $priceArray[$j] .'" ';

                  if ($available == "yes" && !empty($_GET['date']))
                  {
                    echo 'onclick="myFunction(this)"></td>';
                  }
                  else
                  {
                    echo '></td>';
                  }

                  //ignore this comment, left there for checking & debugging
                  //will display what i set above as id as table data instead

                  //echo $available. '">'.$i. '_' .$array[$j]. '_'. $roomID[$j].'_'. $priceArray[$j] .'</td>';
                  //echo '</td>';

                }
                echo '</tr>';
              }
            }
          ?>
      </table>

      <?php
      if(!empty($_GET['date']))
      { ?>

      <form action="paymentBody.php" method="GET" id="myForm">
        <input type="hidden" name="roomName" id="roomName">
        <input type="hidden" name="roomID" id="roomID">
      <?php
        echo '<input type="hidden" name="bookingDate" id="bookingDate" value="'.$getDate.'">';
      ?>
        <input type="hidden" name="bookingTime" id="bookingTime">
        <input type="hidden" name="stdID" id="stdID">
        <input type="hidden" name="promoInsert" id="promoInsert">
        <input type="hidden" name="price" id="price">
      </form>


      <?php
      } ?>

      <?php
        echo '<script>
              function myFunction(cell)
              {
                var str = cell.id;
                var index = str.indexOf("_");
                var timeStr = str.substr(0, index) + ":00:00";

                var remaindingStr = str.substr(index + 1);
                var indexB = remaindingStr.indexOf("_");
                var roomStr = remaindingStr.substr(0, indexB);

                var lastStr= remaindingStr.substr(indexB + 1);
                var indexC = lastStr.indexOf("_");
                var roomIDstr = lastStr.substr(0, indexC);
                var priceStr = lastStr.substr(indexC + 1);

                var bookingTime = document.getElementById("bookingTime");
                bookingTime.setAttribute("value", timeStr);

                var roomName = document.getElementById("roomName");
                roomName.setAttribute("value", roomStr);

                var roomID = document.getElementById("roomID");
                roomID.setAttribute("value", roomIDstr);
                
                var stdID = document.getElementById("stdID");
                stdID.setAttribute("value", ' .$_SESSION['userID']. ');

                var price = document.getElementById("price");
                price.setAttribute("value", priceStr);

                var confirmStr = "Confirm Booking? \n\n" +    "Time: " + timeStr + "\nRoom: " + roomStr + "\n\nEnter Promo Code";
                var check = prompt(confirmStr);
                if (check == null)
                {
                  alert("Booking cancelled!");
                }
                else if(check == "")
                {
                  document.getElementById("myForm").submit(); 
                }
                else
                {
                  var promoInsert = document.getElementById("promoInsert");
                  promoInsert.setAttribute("value", check);
                  document.getElementById("myForm").submit(); 
                }
              }
              </script>';

      ?>
      <div>
            </br>
        <table class="legend">
        <tbody>
          <tr class="legend">
            <th class="legend">Available</th>
            <td style="background-color: greenyellow" class="legend"> </td>
            <td style="background-color: transparent" class="legend"></td>
            <th class="legend">Unavailable</th>
            <td style="background-color: gray" class="legend"> </td>
            <td style="background-color: transparent" class="legend"></td>
            <th class="legend">Booked</th>
            <td style="background-color: red" class="legend"> </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  </main>
</body>