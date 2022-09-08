<?php

    if(isset($_POST['create']))
    {
        require 'connection.php';

        $code = $_POST['code'];
        $type = $_POST['discountType'];
        $discount = $_POST['discount'];

        if(empty($code) || empty($discount))
        {
            header("Location: promoCode.php?error=empty");
        }
        elseif (!is_numeric($discount))
        {
            header("Location: promoCode.php?error=notnumeric");
        }
        else {

            if ($type == "amount")
            {
                $sql = "INSERT INTO promo(code, discount_amount) VALUES('$code', '$discount');";
                $result = mysqli_query($conn, $sql);
                if($result == false)
                {
                    header("Location: promoCode.php?error=failed");
                }
                else
                {
                    header("Location: promoCode.php?success=codeCreated");
                }
            }
            elseif ($type == "percentage")
            {
                if($discount > 0 && $discount <= 100)
                {
                    $sql = "INSERT INTO promo(code, discount_percentage) VALUES('$code', '$discount');";
                    $result = mysqli_query($conn, $sql);
                    if($result == false)
                    {
                        header("Location: promoCode.php?error=failed");
                    }
                    else
                    {
                        header("Location: promoCode.php?success=codeCreated");
                    }
                }
                else
                {
                    header("Location: promoCode.php?error=notinrange");
                }
                
            }
            else {
                echo 'error';
            }
            
        }
        
    }
    else {
        header("Location: unauthorizedEntry.html");
    }

?>