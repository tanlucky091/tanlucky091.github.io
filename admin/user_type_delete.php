<?php
session_start();
include '../conn.php';
if (isset($_GET['id']))
{
    $result = mysqli_query($db,"DELETE FROM role WHERE rid=".$_GET['id']);
    if($result==true){
        header("Location:../role");
        $_SESSION['noti6'] =3;
        mysqli_close($db);
    }else{
        $_SESSION['noti6'] = 0;
    }
}
?>