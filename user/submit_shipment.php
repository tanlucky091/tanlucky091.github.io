<?php
date_default_timezone_set("Asia/Kuala_Lumpur");
session_start();
include '../conn.php';
$rowCount = count((array)$_POST["checklist"]);
$id = $_SESSION['id'];
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
  if (isset($_POST['submit'])) {
    // receive all input values from the form
    $total = $_POST['total'];
    $id = $_SESSION['id'];
    $pid = $_POST['id'];
    $courier = $_POST['cour'];
    $address = $_POST['addres'];
    $kg = $_POST['weight'];
    $date = date("Y-m-d");
    $sid = date("ymdhis").$id.$total;
    for ($i=0;$i<$total;$i++){
        $query = "INSERT INTO shipment (shipment_id, user_id, item_id, courier_id,adres_id,total_weight,price,status,sdate_update) VALUES ('$sid','$id','$pid[$i]','$courier','$address',0,0,1,'$date')";
        mysqli_query($db, "UPDATE product SET pstatus = 3,date_update = '$date' WHERE product_id='$pid[$i]'");
        mysqli_query($db, $query);
    }
    header('location: shipment');
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Shipment Submit</title>
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
            <h1 style="text-align:center">Shipment Submit</h1>
            <div class="main-content-inner">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <!-- Contextual Classes start -->
                                <form method="post" action="submit_shipment" style="align-items: center">
                                    <?php
                                        $count=0;
                                        for($i=0;$i<$rowCount;$i++) {
                                        $count+=1;
                                        $result = mysqli_query($db, "SELECT * FROM product WHERE product_id='" . $_POST["checklist"][$i] . "'");
                                        $row[$i]= mysqli_fetch_array($result);
                                    ?>
                                    <input name="total" type="text" value="<?php echo $rowCount;?>" hidden>
                                    <div class="form-group">
                                        <h4 for="receiver">Parcel <?php echo $count?></h4>
                                        <input type="text" class="form-control" id="id" name="id[]" value="<?php echo $row[$i]['product_id']; ?>" hidden>
                                        <input type="text" class="form-control" id="item" name="item[]" value="<?php echo $row[$i]['parcel_number']; ?>" readonly>
                                        <input type="text" class="form-control" id="weight" name="weight[]" value="<?php echo $row[$i]['weight']; ?>"readonly>
                                    </div>
                                    <?php } ?>
                                    <h4 class="header-title">Courier</h4>
                                    <div class="single-table">
                                        <div class="table-responsive">
                                            <table class="table text-dark text-center">
                                                <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">Courier</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $sql = "SELECT * FROM courier";
                                                $result = $db->query($sql);
                                                if ($result -> num_rows >  0) {
                                                    while ($rows = $result->fetch_assoc())
                                                    {
                                                        ?>
                                                        <tr>
                                                            <th><?php echo $rows['cname'] ?></th>
                                                            <th><input class="form-check-input" type="radio" name="cour" id="cour" value="<?php echo $rows['cid']; ?>"></th>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <h4 class="header-title">Address</h4>
                                    <div class="single-table">
                                        <div class="table-responsive">
                                            <table class="table text-dark text-center">
                                                <thead class="text-uppercase">
                                                <tr class="table-active">
                                                    <th scope="col">Receiver</th>
                                                    <th scope="col">Address</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                $sql = "SELECT * FROM address where user_id = '$id'";
                                                $result = $db->query($sql);
                                                if ($result -> num_rows >  0) {
                                                    while ($res = $result->fetch_assoc())
                                                    {
                                                        ?>
                                                        <tr>
                                                            <th><?php echo $res['receiver'] ?></th>
                                                            <th><?php echo $res['address'] ?></th>
                                                            <th><input class="form-check-input" type="radio" name="addres" id="addres" value="<?php echo $res['aid'];?>"></th>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-dark" name="submit">Add Shipment</button>
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

