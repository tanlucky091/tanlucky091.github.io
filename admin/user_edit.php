<?php
session_start();
include '../conn.php';

if (isset($_POST['submit']))
{
    $id=$_POST['id'];
    $username=mysqli_real_escape_string($db, $_POST['username']);
    $firstname=mysqli_real_escape_string($db, $_POST['first_name']);
    $lastname=mysqli_real_escape_string($db, $_POST['last_name']);
    $mobile=mysqli_real_escape_string($db, $_POST['mobile']);
    $email=mysqli_real_escape_string($db, $_POST['email']);
    $pass=md5($_POST['password']);
    $password=mysqli_real_escape_string($db, $pass);
    $email=mysqli_real_escape_string($db, $_POST['email']);
    $date = date("Y-m-d");
    mysqli_query($db,"UPDATE account SET username='$username',first_name='$firstname',last_name='$lastname',mobile='$mobile',email='$email',password_1='$password',date_update = '$date' WHERE id='$id'");

    header("Location:../userlist");
    $_SESSION['noti1'] = 2;
    mysqli_close($db);
}else{
    $_SESSION['noti1'] = 0;
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
{

    $id = $_GET['id'];
    $result = mysqli_query($db,"SELECT * FROM account inner join role on account.role=role.rid WHERE id=".$_GET['id']);
    $row = mysqli_fetch_array($result);

    if($row)
    {
        $id = $row['id'];
        $username = $row['username'];
        $firstname = $row['first_name'];
        $lastname = $row['last_name'];
        $mobile = $row['mobile'];
        $email = $row['email'];
        $role = $row['type'];
        $password = md5($row['password_1']);
    }
    else
    {
        echo "No results!";
    }
    mysqli_close($db);
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
  if(isset($_SESSION['role'])){
      if ($_SESSION['role'] == 2){
          header('location: home');
      }
  }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>User Update</title>
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
                    <form method="post" action="user_update" style="align-items: center">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <div class="form-group">
                            <label for="name">Username</label>
                            <input type="text" class="form-control" name="username" value="<?php echo $username ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">First Name</label>
                            <input type="text" class="form-control" name="first_name" value="<?php echo $firstname ?>"readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">Last Name</label>
                            <input type="text" class="form-control" name="last_name" value="<?php echo $lastname ?>"readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">Email</label>
                            <input type="text" class="form-control" name="email" value="<?php echo $email ?>"readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">Mobile</label>
                            <input type="text" class="form-control" name="mobile" value="<?php echo $mobile ?>"readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">Password</label>
                            <input type="password" class="form-control" name="password" value="<?php echo $password ?>">
                        </div>
                        <div class="form-group">
                            <label for="user_type">User Type</label>
                            <input type="text" class="form-control" id="user_type" name="user_type" value="<?php echo $role ?>" readonly>
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

