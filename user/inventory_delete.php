<?php
include '../conn.php';

if (isset($_GET['product_id']))
{

    $result = mysqli_query($db,"DELETE FROM product WHERE product_id=".$_GET['product_id']);
    if($result==true){
        header("Location:../inventory");
    }

}

?>