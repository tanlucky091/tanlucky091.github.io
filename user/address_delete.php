<?php
include '../conn.php';

if (isset($_GET['id']))
{

    $result = mysqli_query($db,"DELETE FROM address WHERE aid=".$_GET['id']);
    if($result==true){
        header("Location:../address");
    }

}

?>