<?php
session_start();
include '../conn.php';
if (isset($_GET['id']))
{
    $result = mysqli_query($db,"DELETE FROM status WHERE stid=".$_GET['id']);
    if($result==true){
        header("Location:../status");
        $_SESSION['noti5'] =3;
        mysqli_close($db);
    }else{
        $_SESSION['noti5'] = 0;
    }
}
?>