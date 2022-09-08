<?php

    if(isset($_POST['login']))
    {
        require 'connection.php';

        $username = $_POST['username'];
        $password = $_POST['password'];

        if(empty($username) || empty($password))
        {
            header("Location: staffLogIn.php?error=empty");
            exit();
        }
        else
        {
            $sql = "SELECT * FROM staff WHERE username=?;";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql))
            {
                header("Location: staffLogIn.php?error=sqlerror");
                exit();
            }
            else
            {
                mysqli_stmt_bind_param($stmt, "s", $username);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                //check if we got a result frm database
                if($row = mysqli_fetch_assoc($result))
                {
                    $pwdCheck = ($password == $row['password']);
                    if ($pwdCheck == false)
                    {
                        header("Location: staffLogIn.php?error=wrongpassword");
                        exit();
                    }
                    else if($pwdCheck==true)
                    {
                        //start the session
                        session_start();
                        $_SESSION['userID'] = $row ['stfID'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['userType'] = "staff";
                        $_SESSION['superuser'] = $row['superuser'];
                        header("Location: staffHeader.php");
                    }
                }
                else
                {
                    header("Location: staffLogIn.php?error=nouser");
                    exit();
                }
            }  
        }    
    }

  else if(isset($_POST['Back']))
    {
        header("Location: index.html");
    }

?>