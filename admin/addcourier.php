<?php
session_start();

// connect to the database
include '../conn.php';

// Add item
if (isset($_POST['courier_name'])) {
    $name = $_POST['courier_name'];
    $date = date("Y-m-d");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: ".mysqli_connect_error();
    }
    $sql="INSERT INTO courier(cname,date_update)VALUES('$name','$date')";

    if (!mysqli_query($db,$sql)) {
        die('Error :'.mysqli_error($db));
    }
    mysqli_close($db);
    header('location: courier');
    $_SESSION['noti4'] = 1;
}else{
    $_SESSION['noti4'] = 0;
}
?>
