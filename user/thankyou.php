<?php
session_start();
include '../conn.php';
date_default_timezone_set("Asia/Kuala_Lumpur");
$date=date("Y-m-d h:i:s");
$shipment_id = $_SESSION['shipment_id'];
$transaction_id = $_GET['shipment_id'];

if (isset($_GET['shipment_id'])) {

    $result = mysqli_query($db, "SELECT * FROM shipment WHERE shipment_id ='$shipment_id' ");

    $row = mysqli_fetch_assoc($result);

    if ($row) {
        $amount = $row['price'];
        mysqli_query($db,"UPDATE shipment SET status = 3 WHERE shipment_id = '$shipment_id' ");
        require_once 'mail.php';
    } else {
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
    <title>Thank You payment</title>
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

<!-- page container area start -->
<div id="main" >
    <!-- main content area start -->
    <div class="main-content">
        <div>
            <h1 style="text-align:center">Thank You for Payment</h1>
            <div class="jumbotron text-center">
              <p class="lead" style="text-align:center"><strong>Transaction id :</strong> <?php echo $transaction_id; ?></p>
              <p class="lead" style="text-align:center"><strong>Shipment id :</strong> <?php echo $shipment_id; ?></p>
              <p class="lead" style="text-align:center"><strong>Payment Acount :</strong> <?php echo $amount; ?></p>
              <p class="lead" style="text-align:center"><strong>Payment Date :</strong> <?php echo $date; ?></p>
              <hr>
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