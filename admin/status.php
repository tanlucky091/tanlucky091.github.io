<?php
session_start();
$_SESSION['noti1']=0;
$_SESSION['noti2']=0;
$_SESSION['noti3']=0;
$_SESSION['noti4']=0;
$_SESSION['noti6']=0;
include '../conn.php';
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
    <title>Status</title>
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
            <?php if ($_SESSION['noti5'] == 1){?>
                <div class="alert alert-success" role="alert" id="success-alert">
                    <a id="close" href="#" class="close">&times;</a>
                    Add Successful!
                </div>
            <?php }elseif ($_SESSION['noti5'] == 2){ ?>
                <div class="alert alert-success" role="alert" id="success-alert">
                    <a id="close" href="#" class="close">&times;</a>
                    Edit Successful!
                </div>
            <?php }elseif ($_SESSION['noti5'] == 3){ ?>
                <div class="alert alert-success" role="alert" id="success-alert">
                    <a id="close" href="#" class="close">&times;</a>
                    Delete Successful!
                </div>
            <?php }else{$_SESSION['noti5'] = 0 ;} ?>
            <h1 style="text-align:center">Status</h1>
            <div class="main-content-inner">
                <div class="row">
                    <!-- Contextual Classes start -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float: right">
                                    Add Status
                                </button>
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center">
                                            <thead class="text-uppercase">
                                            <tr class="table-active">
                                                <th scope="col">No</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Date Update</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $sql = "SELECT * FROM status";
                                            $result = $db->query($sql);
                                            $count=0;
                                            if ($result -> num_rows >  0) {
                                                while ($row = $result->fetch_assoc())
                                                {
                                                    $count=$count+1;
                                                    ?>
                                                    <tr>
                                                        <th><?php echo $count ?></th>
                                                        <th><?php echo $row["status_name"] ?></th>
                                                        <th><?php echo $row["date_update"] ?></th>
                                                        <th> <a href="up"Edit></a><a href="status_update/<?php echo $row["stid"] ?>" class="btn btn-primary">Edit</a>&nbsp;&nbsp;&nbsp;<a href="up"Edit></a><a href="status_delete/<?php echo $row["stid"] ?>" class="btn btn-danger">Delete</a></th>
                                                    </tr>
                                                    <?php
                                                }
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Add Status</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <body>
                <form method="POST" action="addstatus">
                    <div class="form-group">
                        <label for="name">Status Name</label>
                        <input type="text" class="form-control" name="status_name">
                    </div>
                </body>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-dark" name="submit" >Add status</button>
            </div>
            </form>
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
