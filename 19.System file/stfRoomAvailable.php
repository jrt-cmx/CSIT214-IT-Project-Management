<?php
    include 'session.php';

    if($_SESSION['userType'] != "staff" || $_SESSION['superuser'] != "0")
    {
        header("Location: unauthorizedEntry.html");
    }
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <script defer src="theme.js"></script>
  <link rel="stylesheet" href="stfRoomAvailable.css"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700&display=swap"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
  <script src="https://kit.fontawesome.com/a076d05399.js"></script>
  <script type="text/javascript" src="student.js"></script>
  <title>Staff Portal</title>
</head>

<body>
	<div class="bg"> </div>
  <?php
      include 'staffNavBar.php';
  ?>

  <main>
    <div>
	  <h2>Room Available</h2>
	  <table id="generatedTable">
        <thead>
          <tr>
            <th>
              <form action="stfRoomAvailable.php" method="GET">
                <input type="date" name="date" id="date">
                <input type="submit" value="Check">
              </form>

              <?php
                if(isset($_GET['date']) && !empty($_GET['date']))
                {
                  echo '<script>
                        document.getElementById("date").defaultValue="'.$_GET['date'].'";
                        </script>';
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

            $sql = "SELECT * FROM room LEFT OUTER JOIN unavailable USING (roomID) LEFT OUTER JOIN booking USING (roomID);";
            $result = mysqli_query($conn, $sql);
            $numOfRows = mysqli_num_rows($result);
            $datas = array();

            $array = array();

            if ($numOfRows > 0)
            {
              while ($row = mysqli_fetch_assoc($result))
              {
                $datas[] = $row;
                $checker = "no";

                foreach ($array as $loopdata)
                {
                  if ($loopdata == $row['name'])
                  {
                    $checker = "yes";
                  }
                }

                if($checker == "no")
                {
                  array_push($array, $row['name']);
                }
              }
            }

            $arraySize = count($array);
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            if(isset($_GET['date']))
            {
              $getDate= $_GET['date'];
            }
            
            if ($arraySize > 0)
            {
              for ($j = 0; $j < $arraySize; $j++)
              {
                echo '<tr>';
                echo '<td class="room">'. $array[$j] . '</td>';


                for($i = 9; $i < 18; $i++)
                {
                  echo '<td class="';
                  $available = "yes";

                  for($x = 0; $x < count($datas); $x++)
                  {
                    //match table name to database roomname AND availability is on
                    if($datas[$x]['name'] == $array[$j] && $datas[$x]['availability'] == "on")
                    {
                      if(isset($getDate))
                      {
                        //date to be checked is equal to unavailable date in database
                        if($getDate == $datas[$x]['unavail_date'])
                        {
                          //if unavail time in the database is not null
                          if(is_null($datas[$x]['unavail_time']) != 1)
                          {
                            //set unavail time to var
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
                    elseif($datas[$x]['name'] == $array[$j] && $datas[$x]['availability'] == "off")
                    {
                      $available = "no";
                    }
                  }
                  echo $available. '"></td>';
                }

                echo '</tr>';
              }
            }

          ?>
      </table>
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