<?php
session_start();
include '../conn.php';

if (isset($_POST['submit']))
{
    $id=$_POST['id'];
    $receiver=mysqli_real_escape_string($db, $_POST['receiver']);
    $address=mysqli_real_escape_string($db, $_POST['address']);
    $date = date("Y-m-d");
    mysqli_query($db,"UPDATE address SET receiver='$receiver', address='$address',date_update = '$date' WHERE aid='$id'");

    header("Location:../address");
}


if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
{

    $id = $_GET['id'];
    $result = mysqli_query($db,"SELECT * FROM address WHERE aid=".$_GET['id']);
    $row = mysqli_fetch_array($result);

    if($row)
    {
        $id = $row['aid'];
        $receiver = $row['receiver'];
        $address = $row['address'];

    }
    else
    {
        echo "No results!";
    }
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
    <title>Address Update</title>
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
                    <form method="post" action="address_update" style="align-items: center">
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <div class="form-group">
                            <h4 for="receiver">Receiver</h4>
                            <input type="text" class="form-control" id="receiver" name="receiver" value="<?php echo $receiver; ?>">
                        </div>
                        <div class="form-group">
                            <h4 for="address">Address</h4>
                            <input type="text" class="form-control" id="address" name="address" value="<?php echo $address ?>">
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

