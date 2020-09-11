<?php
session_start();

// initializing variables
$receiver = "";
$address= "";

// connect to the database
include '../conn.php';

// Add item
if (isset($_POST['receiver']) && isset($_POST['address'])) {
    $receiver = $_POST['receiver'];
    $address = $_POST['address'];
    $id = $_SESSION['id'];
    $date = date("Y-m-d");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: ".mysqli_connect_error();
    }
    $sql="INSERT INTO address(user_id,receiver,address,date_update)VALUES('$id','$receiver','$address','$date')";

    if (!mysqli_query($db,$sql)) {
        die('Error :'.mysqli_error($db));
    }
    mysqli_close($db);
    header('location: address');
}
?>
