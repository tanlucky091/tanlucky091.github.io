<?php
session_start();
include '../conn.php';

if (isset($_GET['shipment_id']) && is_numeric($_GET['shipment_id']) && $_GET['shipment_id'] > 0) {

    $result = mysqli_query($db, "SELECT * FROM shipment inner join address on shipment.adres_id = address.aid inner join courier on shipment.courier_id=courier.cid WHERE shipment_id=".$_GET['shipment_id']);

    $row = mysqli_fetch_array($result);

    if ($row) {
        $shipment_id = $row['shipment_id'];
        $receiver = $row['receiver'];
        $address = $row['address'];
        $cname = $row['cname'];
        $parcel_weight = $row['total_weight'];
        $price = $row['price'];
        $parcel_num = $row['parcel_num'];
    } else {
        echo "No results!";
    }
}
if (isset($_POST['submit']))
{
    $shipment_id = $_POST['id'];
    $status = $_POST['status'];
    $price=$_POST['price'];
    $weight=$_POST['weight'];
    $parcel_num=$_POST['parcel_num'];
    $date = date("Y-m-d");
    mysqli_query($db,"UPDATE shipment SET price='$price',status='$status',total_weight='$weight',parcel_num='$parcel_num',sdate_update = '$date' WHERE shipment_id ='$shipment_id'");
    header("Location:../user_shipment");
    $_SESSION['noti3'] = 2;
    mysqli_close($db);
}else{
    $_SESSION['noti3'] = 0;
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
    <title>Shipment Update</title>
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
                                    <?php
                                    if (isset($_GET['shipment_id']) && is_numeric($_GET['shipment_id']) && $_GET['shipment_id'] > 0)
                                    {
                                    $id = $_GET['shipment_id'];
                                    $sql = "SELECT * FROM shipment inner join product on shipment.item_id = product.product_id WHERE shipment_id=".$_GET['shipment_id'];
                                    $result = $db->query($sql);
                                    $count=0;
                                    if ($result -> num_rows >  0) {
                                        while ($row = $result->fetch_assoc())
                                        {
                                            $_SESSION['user_id'] = $row['user_id'];
                                            $count=$count+1;
                                            ?>
                                            <div class="form-group">
                                                <h4 for="product_name">Parcel <?php echo $count?></h4>
                                                <input type="text" class="form-control" id="item" name="item[]" value="<?php echo $row['parcel_number']; ?>" readonly>
                                                <input type="text" class="form-control" id="weight" name="weight[]" value="<?php echo $row['weight']; ?>"readonly>
                                            </div>
                                            <?php
                                        }
                                    }
                                    }
                                    ?>
                                    <h4 class="header-title">Address</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="receiver" name="receiver" value="<?php echo $receiver; ?>" readonly>
                                        <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>"readonly>
                                    </div>
                                    <h4 class="header-title">Courier</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="courier" name="courier" value="<?php echo $cname; ?>" readonly>
                                    </div>
                                <form method="post" action="user_shipment_update">
                                    <input type="hidden" name="id" value="<?php echo $shipment_id; ?>"/>
                                    <h4 class="header-title">Parcel Number</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="parcel_num" name="parcel_num" value="<?php echo $parcel_num; ?>" >
                                    </div>
                                    <h4 class="header-title">Parcel Weight</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="weight" name="weight" value="<?php echo $parcel_weight; ?>" >
                                    </div>
                                    <h4 class="header-title">Price</h4>
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="price" name="price" value="<?php echo $price; ?>" >
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

