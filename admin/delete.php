<?php
session_start();
include '../conn.php';
if (isset($_GET['id']))
{
    $result = mysqli_query($db,"DELETE FROM product WHERE product_id=".$_GET['id']);
        if($result==true){
        header("Location:../inventorylist");
        $_SESSION['noti'] =3;
        mysqli_close($db);
        }else{
            $_SESSION['noti'] = 0;
        }
}
?>