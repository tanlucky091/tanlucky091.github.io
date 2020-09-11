<?php
session_start();
include '../conn.php';

if (isset($_GET['shipment_id']) && is_numeric($_GET['shipment_id']) && $_GET['shipment_id'] > 0) {

    $result = mysqli_query($db, "SELECT * FROM shipment inner join status on shipment.status=status.stid inner join address on shipment.adres_id = address.aid inner join courier on shipment.courier_id=courier.cid WHERE shipment_id =".$_GET['shipment_id']);

    $row = mysqli_fetch_assoc($result);

    if ($row) {

        $receiver = $row['receiver'];
        $address = $row['address'];
        $cname = $row['cname'];
        $parcel_weight = $row['total_weight'];
        $price = $row['price'];
        $_SESSION['price'] = $price;
        $image = $row['image'];
        $_SESSION['shipment_id'] = $row['shipment_id'];
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
          header('location: ../index');
      }else{
          $_SESSION['time']=time();
      }
  }

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Shipment Payment</title>
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
            <h1 style="text-align:center">Shipment Payment</h1>
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
                                            $count=$count+1;
                                            ?>
                                            <div class="form-group">
                                                <h4 for="product_name">Parcel <?php echo $count?></h4l>
                                                <input type="text" class="form-control" id="item" name="item[]" value="<?php echo $row['parcel_number']; ?>" readonly>
                                            </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                                <h4 class="header-title">Receiver</h4>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="receiver" name="receiver" value="<?php echo $receiver; ?>" readonly>
                                </div>
                                <h4 class="header-title">Address</h4>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?>"readonly>
                                </div>
                                <h4 class="header-title">Courier</h4>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="courier" name="courier" value="<?php echo $cname; ?>" readonly>
                                </div>
                                <h4 class="header-title">Parcel Weight</h4>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="total" name="total" value="<?php echo $parcel_weight; ?>" readonly>
                                </div>
                                <h4 class="header-title">Price</h4>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="price" name="price" value="<?php echo $price; ?>" readonly>
                                </div>
                                <br/>
                                <br/>
                                <!-- Set up a container element for the button -->
                                <div id="paypal-button-container" style="padding-left:30%;"></div>
                
                                <!-- Include the PayPal JavaScript SDK -->
                                <script src="https://www.paypal.com/sdk/js?client-id=AQtmFBK_WX-IR3oclJl-Bwbkt7KvCa2lgwMpctbf43rB_0Zt-NbZn5NBcuIW-FSq7rDASCXBFuqEkAfU&currency=MYR"></script>
                
                                <script>
                                    // Render the PayPal button into #paypal-button-container
                                    paypal.Buttons({
                                        style: {
                                            layout: 'horizontal'
                                        },
                                        // Set up the transaction
                                        
                                        createOrder: function(data, actions) {
                                            return actions.order.create({
                                                purchase_units: [{
                                                    amount: {
                                                        value: '<?= $price ?>'
                                                    }
                                                }]
                                            });
                                        },
                
                                        // Finalize the transaction
                                        onApprove: function(data, actions) {
                                            return actions.order.capture().then(function(details) {
                                                // Show a success message to the buyer
                                                alert('Transaction completed by ' + details.payer.name.given_name + '!');
                                                window.location.href="http://dress-purposes.000webhostapp.com/shipment";
                                                window.open( "http://dress-purposes.000webhostapp.com/thankyou/<?php echo md5($_SESSION['shipment_id'])?>", "_blank"); 
                                            });
                                        }
                                    }).render('#paypal-button-container');
                                </script>
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
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TnG QRCode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="../assets/images/tng.jpeg">
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payment Proof</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="../user/<?php echo $image ?>" data-toggle="modal" data-target="#exampleModal2"/>
            </div>
        </div>
    </div>
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

