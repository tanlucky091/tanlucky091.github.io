<?php
session_start();
$_SESSION['noti']=0;
$_SESSION['noti1']=0;
$_SESSION['noti2']=0;
$_SESSION['noti4']=0;
$_SESSION['noti5']=0;
$_SESSION['noti6']=0;
include '../conn.php';
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
    <title>Shipment</title>
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
    <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'rel='stylesheet'>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" > </script> 
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" > </script>
      
    
    
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
            <?php if ($_SESSION['noti3'] == 1){?>
                <div class="alert alert-success" role="alert" id="success-alert">
                    <a id="close" href="#" class="close">&times;</a>
                    Add Successful!
                </div>
            <?php }elseif ($_SESSION['noti3'] == 2){ ?>
                <div class="alert alert-success" role="alert" id="success-alert">
                    <a id="close" href="#" class="close">&times;</a>
                    Edit Successful!
                </div>
            <?php }elseif ($_SESSION['noti3'] == 3){ ?>
                <div class="alert alert-success" role="alert" id="success-alert">
                    <a id="close" href="#" class="close">&times;</a>
                    Delete Successful!
                </div>
            <?php }else{$_SESSION['noti3'] = 0 ;} ?>
            <h1 style="text-align:center">Shipment</h1>
            <div class="main-content-inner">
                <div class="row">
                    <div class="col-md-9">
                        
                    </div>
                    <div class="col-md-1" class="form-group">
                        <form action="user_shipment" method="POST">
                            Start : <input type="text" name="from_date" id="from_date" class="form-control" placeholder="D/M/Y">
                    </div>
                    <div class="col-md-1" class="form-group">
                        End : <input type="text" name="to_date" id="to_date" class="form-control" placeholder="D/M/Y">
                    </div>
                    <div class="col-md-1" class="form-group">
                        <br><input type="submit" name="search" value="Search" class="btn btn-primary">
                        </form>
                    </div>
                    <!-- Contextual Classes start -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center">
                                            <thead class="text-uppercase">
                                            <tr class="table-active">
                                                <th scope="col">No</th>
                                                <th scope="col">Ship_ID</th>
                                                <th scope="col">Parcel Number</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Courier</th>
                                                <th scope="col">Product</th>
                                                <th scope="col">Weight</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Date</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if ((isset($_POST['search'])) && (isset($_POST['start'])) && (isset($_POST['end']))) {
                                              $start = $_POST['start'];
                                              $end = $_POST['end'];
                                              list($fid,$fim,$fiy) = explode("-",$start);
                                              list($tid,$tim,$tiy) = explode("-",$end);
                                              $start_date = "$fiy-$fim-$fid 00:00:00";
                                              $end_date = "$tiy-$tim-$tid 23:59:59";
                                              $sql = "SELECT *,group_concat(product.parcel_number) as  item_list FROM shipment inner join account on shipment.user_id = account.id inner join courier on shipment.courier_id = courier.cid inner join status on shipment.status = status.stid inner join product on shipment.item_id = product.product_id inner join address on shipment.adres_id = address.aid where sdate_create BETWEEN '".$start_date."' AND '".$end_date."' group by shipment_id";
                                            }else {
                                            $sql = "SELECT *,group_concat(product.parcel_number) as  item_list FROM shipment inner join account on shipment.user_id = account.id inner join courier on shipment.courier_id = courier.cid inner join status on shipment.status = status.stid inner join product on shipment.item_id = product.product_id group by shipment_id";
                                            }
                                            $result = $db->query($sql);
                                            $count=0;
                                            while ($row = $result->fetch_assoc())
                                            {
                                                $count=$count+1;
                                                $image = $row['image'];
                                                ?>
                                                <tr>
                                                    <th><?php echo $count ?></th>
                                                    <th><?php echo $row["shipment_id"] ?></th>
                                                    <th><?php echo $row["parcel_num"] ?></th>
                                                    <th><?php echo $row["username"]  ?></th>
                                                    <th><?php echo $row["cname"] ?></th>
                                                    <th><?php echo $row["item_list"] ?></th>
                                                    <th><?php echo $row["total_weight"] ?></th>
                                                    <th><?php echo $row["price"] ?></th>
                                                    <th><?php echo $row["status_name"] ?></th>
                                                    <th><?php echo $row["sdate_create"]  ?></th>
                                                    <th>
                                                        <?php
                                                            if ($row['status_name'] != "Received") {
                                                        ?>
                                                            <a href="user_shipment_update/<?php echo $row["shipment_id"] ?>" class="btn btn-primary">Edit</a>
                                                        <?php
                                                        }
                                                            if (($row['status_name'] != "Shipped") && ($row['status_name'] != "Received")) {
                                                        ?>
                                                            <a href="user_shipment_delete/<?php echo $row["shipment_id"] ?>" class="btn btn-danger">Delete</a>
                                                        <?php
                                                        }
                                                            if (($row["parcel_num"] != "") && ($row['status_name'] == "Shipped")){
                                                        ?>
                                                            <a onclick="linkTrack(this.innerText)" class="btn btn-info"><?php echo $row["parcel_num"] ?></a>
                                                        <?php
                                                        }
                                                        ?>
                                                    </th>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
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
<script src="//www.tracking.my/track-button.js"></script>
<script>
    $(document).ready(function() { 
            $(function() { 
                $( "#from_date" ).datepicker({
                    dateFormat: 'dd-mm-yy',
                }); 
                $( "#to_date" ).datepicker({
                    dateFormat: 'dd-mm-yy',
                }); 
            }); 
        })
</script>
</body>

</html>
