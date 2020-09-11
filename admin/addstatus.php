<?php
session_start();

// connect to the database
include '../conn.php';

// Add item
if (isset($_POST['status_name'])) {

    $item = $_POST['status_name'];
    $date = date("Y-m-d");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: ".mysqli_connect_error();
    }
    $sql="INSERT INTO status(status_name,date_update)VALUES('$item','$date')";

    if (!mysqli_query($db,$sql)) {
        die('Error :'.mysqli_error($db));
    }
    mysqli_close($db);
    header('location: status');
    $_SESSION['noti5'] =1;
}else{
    $_SESSION['noti5'] = 0;
}
?>
