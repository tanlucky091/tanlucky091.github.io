<?php
session_start();

// connect to the database
include '../conn.php';

// Add item
if (isset($_POST['type'])) {

    $item = $_POST['type'];
    $date = date("Y-m-d");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: ".mysqli_connect_error();
    }
    $sql="INSERT INTO role(type,date_update)VALUES('$item','$date')";

    if (!mysqli_query($db,$sql)) {
        die('Error :'.mysqli_error($db));
    }
    mysqli_close($db);
    header('location: role');
    $_SESSION['noti6'] =1;
    }else{
        $_SESSION['noti6'] = 0;
    }
?>
