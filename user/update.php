<?php
session_start();
include '../conn.php';
if (isset($_SESSION['username'])) {
    $id = $_SESSION['id'];
    $sql = "SELECT * FROM account WHERE id='$id'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($result);
        if ($row) {
            $id = $row['id'];
            $username = $row['username'];
            $firstname = $row['first_name'];
            $lastname = $row['last_name'];
            $mobile = $row['mobile'];
            $email = $row['email'];
            $password_1 = $row['password_1'];
        } else {
            echo "No results!";
        }
}

if (isset($_POST['submit']))
{
    $username=mysqli_real_escape_string($db, $_POST['username']);
    $firstname=mysqli_real_escape_string($db, $_POST['first_name']);
    $lastname=mysqli_real_escape_string($db, $_POST['last_name']);
    $mobile=mysqli_real_escape_string($db, $_POST['mobile']);
    $email=mysqli_real_escape_string($db, $_POST['email']);
    $pass = md5($_POST['password']);
    $password=mysqli_real_escape_string($db, $pass);
    $date = date("Y-m-d");
    if(($_POST['password'] == $password_1) || $pass == $password_1){
        mysqli_query($db,"UPDATE account SET mobile='$mobile',email='$email',date_update = '$date' WHERE username='$username'"); 
    }else{
        mysqli_query($db,"UPDATE account SET mobile='$mobile',email='$email',password_1 = '$password',date_update = '$date' WHERE username='$username'"); 
    }
    
    
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    header("Location:../home");
}



if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: index');
}
if (isset($_SESSION['time'])){
      if(time()-$_SESSION['time']>1800){
          session_unset();
          session_destroy();
          header('location: index');
      }else{
          $_SESSION['time']=time();
      }
  }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Update Profile</title>
    <link rel="icon" href="../assets/images/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/sidebar.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.css">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <!-- others css -->
    <link rel="stylesheet" href="../assets/css/typography.css">
    <link rel="stylesheet" href="../assets/css/default-css.css">
    <link rel="stylesheet" href="../assets/css/styles.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="../assets/js/modernizr-2.8.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" > </script>
</head>

<body>
<!-- preloader area start -->
<div id="preloader">
    <div class="loader"></div>
</div>
<!-- preloader area end -->
<?php include '../header/header.php'; ?>

<!-- page container area start -->
<div id="main" >
    <!-- main content area start -->
    <div class="main-content">
        <!-- page title area start -->
        <?php include '../header/page_title.php'?>
        <!-- page title area end -->
        <div>
            <h1 style="text-align:center">Edit User</h1>
            <div class="main-content-inner">
                <div class="row">
                    <!-- Contextual Classes start -->
                    <form method="post" action="update">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <div class="form-group">
                            <h4 for="username">Username</h4>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $username; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <h4 for="first_name">First Name</h4>
                            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $firstname ?>" readonly>
                        </div>
                        <div class="form-group">
                            <h4 for="last_name">Last Name</h4>
                            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $lastname ?>" readonly>
                        </div>
                        <div class="form-group">
                            <h4 for="mobile">Mobile</h4>
                            <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $mobile ?>">
                        </div>
                        <div class="form-group">
                            <h4 for="email">Email</h4>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email ?>">
                        </div>
                        <div class="form-group">
                            <h4 for="password">Password</h4>
                            <input type="password" class="form-control" id="password" name="password" value="<?php echo $password_1 ?>">
                        </div>
                        
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                    <!-- Contextual Classes end -->
                </div>
            </div>
        </div>
    </div>
    <!-- main content area end -->
</div>
<!-- page container area end -->
<!-- bootstrap 4 js -->
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/jquery.slimscroll.min.js"></script>
<!-- others plugins -->
<script src="../assets/js/plugins.js"></script>
<script src="../assets/js/scripts.js"></script>
</body>

</html>