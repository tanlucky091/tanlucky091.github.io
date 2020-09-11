<?php
session_start();
include '../conn.php';

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0) {

    $result = mysqli_query($db, "SELECT * FROM product inner join courier on product.courier=courier.cid inner join account on product.user_id = account.id WHERE product_id=".$_GET['id']);

    $row = mysqli_fetch_array($result);

    if ($row) {
      $id = $row['product_id'];
      $name = $row['product_name'];
      $weight = $row['weight'];
      $quant=$row['quantity'];
      $user = $row['username'];
      $parcel_number = $row['parcel_number'];
      $courier = $row['cname'];
    } else {
        echo "No results!";
    }
}
if (isset($_POST['submit']))
{
    $id=$_POST['id'];
    $status = $_POST['status'];
    $weight=mysqli_real_escape_string($db, $_POST['weight']);
    $quant=mysqli_real_escape_string($db, $_POST['quantity']);
    $date = date("Y-m-d");
    mysqli_query($db,"UPDATE product SET weight='$weight' ,quantity='$quant',pstatus = '$status',date_update = '$date' WHERE product_id='$id'");
    header("Location:../inventorylist");
    $_SESSION['noti'] =2;
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
    <title>Product Update</title>
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
            <h1 style="text-align:center">Edit Item</h1>
            <div class="main-content-inner">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Contextual Classes start -->
                                <form method="post" action="inventory_update">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                                    <div class="form-group">
                                        <h4 for="product_name">Item Name</h4>
                                        <input type="text" class="form-control" id="product_name" name="product_name" value="<?php echo $name; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <h4 for="weight">Weight</h4>
                                        <input type="text" class="form-control" id="weight" name="weight" value="<?php echo $weight ?>">
                                    </div>
                                    <div class="form-group">
                                        <h4 for="quantity">Quantity</h4>
                                        <input type="text" class="form-control" id="quantity" name="quantity" value="<?php echo $quant ?>">
                                    </div>
                                    <div class="form-group">
                                        <h4 for="username">User</h4>
                                        <input type="text" class="form-control" id="username" name="username" value="<?php echo $user ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <h4 for="parcel_number">Parcel Number</h4>
                                        <input type="text" class="form-control" id="parcel_number" name="parcel_number" value="<?php echo $parcel_number ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <h4 for="courier">Courier</h4>
                                        <input type="text" class="form-control" id="courier" name="courier" value="<?php echo $courier ?>" readonly>
                                    </div>
                                    <h4 class="header-title">Status</h4>
                                    <div class="single-table">
                                        <div class="table-responsive">
                                            <table class="table text-dark text-center">
                                                <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $sql = "SELECT * FROM status";
                                                $result = $db->query($sql);
                                                if ($result -> num_rows >  0) {
                                                    while ($res = $result->fetch_assoc())
                                                    {
                                                        ?>
                                                        <tr>
                                                            <th><?php echo $res['status_name'] ?></th>
                                                            <th><input class="form-check-input" type="radio" name="status" id="status" value="<?php echo $res['stid'];?>"></th>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                                </form>
                                </div>
                            </div>
                        </div>
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

