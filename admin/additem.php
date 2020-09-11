<?php 
  session_start();

// connect to the database
include '../conn.php';

// Add item
if (isset($_POST['product_name']) && isset($_POST['weight']) && isset($_POST['quant'])) {

    $item = $_POST['product_name'];
    $itemweight = $_POST['weight'];
    $itemquan = $_POST['quant'];
    $parcel = $_POST['parcel'];
    $user = $_POST['user'];
    $status = $_POST['status'];
    $courier = $_POST['courier'];
    $date = date("Y-m-d");

    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: ".mysqli_connect_error();
    }
    $sql="INSERT INTO product(user_id,product_name,weight,quantity,parcel_number,pstatus,courier,date_update)VALUES('$user','$item','$itemweight','$itemquan',$parcel,'$status','$courier','$date')";

    if (!mysqli_query($db,$sql)) {
        die('Error :'.mysqli_error($db));
    }
    mysqli_close($db);
    header('location: inventorylist');
    $_SESSION['noti'] =1;
}else{
    $_SESSION['noti'] = 0;
}
?>
