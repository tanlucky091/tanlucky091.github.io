<?php
session_start();
include '../conn.php';

if (isset($_GET['id']))
{

    $result = mysqli_query($db,"DELETE FROM courier WHERE cid=".$_GET['id']);
    if($result==true){
        header("Location:../courier");
        $_SESSION['noti4'] = 3;
        mysqli_close($db);
    }else{
        $_SESSION['noti4'] = 0;
    }

}

?>