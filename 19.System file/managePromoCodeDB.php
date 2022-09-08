<?php

    require 'connection.php';
    $promoID = $_GET['promoID'];
	$code = $_GET['promoCode'];
    
    if(!empty($_GET['discountAmt']) && !empty($_GET['discountPercent']))
    {
        header("Location: stfCodeAvailable.php?promoID=$promoID&error=both");
    }
    elseif(empty($_GET['discountAmt']) && empty($_GET['discountPercent']))
    {
        header("Location: managePromoCode.php?promoID=$promoID&error=empty");
    }
    elseif(!empty($_GET['discountAmt']))
    {
        $discount_amount = $_GET['discountAmt'];

        if(!is_numeric($discount_amount))
        {
            header("Location: managePromoCode.php?promoID=$promoID&error=notnumeric");
        }
        elseif($discount_amount == 0)
        {
            header("Location: managePromoCode.php?promoID=$promoID&error=zero");
        }
        else
        {
            $sql = "UPDATE promo 
            SET code = '$code', discount_amount = '$discount_amount', discount_percentage = NULL
            WHERE promoID = '$promoID';";
            $result = mysqli_query($conn, $sql);
            if($result == false)
            {
                header("Location: managePromoCode.php?promoID=$promoID&error=failed");
            }
            else
            {
                header("Location: stfCodeAvailable.php");
            }
        }    
    }
    elseif(!empty($_GET['discountPercent']))
    {
        $discount_percentage = $_GET['discountPercent'];

        if(!is_numeric($discount_percentage))
        {
            header("Location: managePromoCode.php?promoID=$promoID&error=notnumeric");
        }
        else
        {
            if($discount_percentage > 0 && $discount_percentage <= 100)
            {
                $sql = "UPDATE promo 
                SET code = '$code', discount_percentage = '$discount_percentage', discount_amount = NULL
                WHERE promoID = '$promoID';";
                $result = mysqli_query($conn, $sql);
                if($result == false)
                {
                    header("Location: managePromoCode.php?promoID=$promoID&error=failed");
                }
                else
                {
                    header("Location: stfCodeAvailable.php");
                }
            }
            else
            {
                header("Location: managePromoCode.php?promoID=$promoID&error=notinrange");
            }
            
        }

    }
?>