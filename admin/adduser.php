<?php
session_start();

// connect to the database
include '../conn.php';

// Add item
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $email = $_POST['email'];
    $firstname = $_POST['first_name'];
    $lastname = $_POST['last_name'];
    $mobile = $_POST['mobile'];
    $user_type = $_POST['user_type'];
    $date = date("Y-m-d");
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: ".mysqli_connect_error();
    }
    $user_check_query = "SELECT * FROM account WHERE username='$username' OR email='$email' LIMIT 1";
      $result = mysqli_query($db, $user_check_query);
      $user = mysqli_fetch_assoc($result);
    
    $sql="INSERT INTO account(username,first_name,last_name,mobile,email,password_1,role,date_update)VALUES('$username','$firstname','$lastname','$mobile','$email','$password','$user_type','$date')";

    if (!mysqli_query($db,$sql)) {
        die('Error :'.mysqli_error($db));
    }

    mysqli_close($db);
    header('location: userlist');
    $_SESSION['noti1'] = 1;
}else{
    $_SESSION['noti1'] = 0;
}
?>
