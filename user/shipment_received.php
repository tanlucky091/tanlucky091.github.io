<?php
    include '../conn.php';

if (isset($_GET['shipment_id']) && is_numeric($_GET['shipment_id']) && $_GET['shipment_id'] > 0) {
    $date = date("Y-m-d");
    mysqli_query($db,"UPDATE shipment SET sdate_update = '$date',status=5 WHERE shipment_id =".$_GET['shipment_id']);
    header ('location:../shipment');
}

?>