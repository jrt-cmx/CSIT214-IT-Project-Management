<?php

    if(isset($_POST['login']))
    {
        require 'connection.php';

        $username = $_POST['username'];
        $password = $_POST['password'];

        if(empty($username) || empty($password))
        {
            header("Location: studentLogIn.php?error=empty");
            exit();
        }
        else
        {
            $sql = "SELECT * FROM student WHERE username=?;";
            $stmt = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt, $sql))
            {
                header("Location: studentLogIn.php?error=sqlerror");
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
                        header("Location: studentLogIn.php?error=wrongpassword");
                        exit();
                    }
                    else if($pwdCheck==true)
                    {
                        //start the session
                        session_start();
                        $_SESSION['userID'] = $row ['stdID'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['userType'] = "student";
                        header("Location: student.php");
                    }
                }
                else
                {
                    header("Location: studentLogIn.php?error=nouser");
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