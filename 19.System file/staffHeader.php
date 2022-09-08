<?php
    include 'session.php';

    if($_SESSION['userType'] != "staff")
    {
        header("Location: unauthorizedEntry.html");
    }
    elseif($_SESSION['superuser'] == "0")
    {
        include 'staff.php';
    }
    elseif($_SESSION['superuser'] == "1")
    {
        include 'superuser.php';
    }

?>