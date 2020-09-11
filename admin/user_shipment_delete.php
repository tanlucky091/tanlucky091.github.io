<?php
include '../conn.php';

if (isset($_GET['shipment_id']))
{

    $result = mysqli_query($db,"DELETE FROM shipment WHERE shipment_id=".$_GET['shipment_id']);
    if($result==true){
        header("Location:../user_shipment");
        $_SESSION['noti3'] = 3;
    }else{
        $_SESSION['noti3'] = 0;
    }

}
?>