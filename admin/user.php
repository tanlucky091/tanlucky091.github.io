<?php
session_start();
$_SESSION['noti']=0;
$_SESSION['noti1']=0;
$_SESSION['noti2']=0;
$_SESSION['noti3']=0;
$_SESSION['noti5']=0;
$_SESSION['noti6']=0;
include '../conn.php';
  if (!isset($_SESSION['username'])) {
      $_SESSION['msg'] = "You must log in first";
      header('location: index.php');
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
    <title>User</title>
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
    <script src="../assets/js//modernizr-2.8.3.min.js"></script>
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
            <?php if ($_SESSION['noti4'] == 1){?>
                <div class="alert alert-success" role="alert" id="success-alert">
                    <a id="close" href="#" class="close">&times;</a>
                    Add Successful!
                </div>
            <?php }elseif ($_SESSION['noti4'] == 2){ ?>
                <div class="alert alert-success" role="alert" id="success-alert">
                    <a id="close" href="#" class="close">&times;</a>
                    Edit Successful!
                </div>
            <?php }elseif ($_SESSION['noti4'] == 3){ ?>
                <div class="alert alert-success" role="alert" id="success-alert">
                    <a id="close" href="#" class="close">&times;</a>
                    Delete Successful!
                </div>
            <?php }else{$_SESSION['noti4'] = 0 ;} ?>
            <h1 style="text-align:center">User</h1>
            <div class="main-content-inner">
                <div class="row">
                    <!-- Contextual Classes start -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float: right">
                                    Add User
                                </button>
                                <div class="single-table">
                                    <div class="table-responsive">
                                        <table class="table text-dark text-center">
                                            <thead class="text-uppercase">
                                            <tr class="table-active">
                                                <th scope="col">No</th>
                                                <th scope="col">User Id</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Mobile</th>
                                                <th scope="col">Date Update</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $sql = "SELECT * FROM account";
                                            $result = $db->query($sql);
                                            $count=0;
                                            if ($result -> num_rows >  0) {
                                                while ($row = $result->fetch_assoc())
                                                {
                                                    $count=$count+1;
                                                    ?>
                                                    <tr>
                                                        <th><?php echo $count ?></th>
                                                        <th><?php echo $row['id'] ?></th>
                                                        <th><?php echo $row["username"] ?></th>
                                                        <th><?php echo $row['first_name'] ." ". $row['last_name'] ?></th>
                                                        <th><?php echo $row["email"] ?></th>
                                                        <th><?php echo $row['mobile'] ?></th>
                                                        <th><?php echo $row['date_update'] ?></th>
                                                        <th> <a href="up"Edit></a><a href="user_update/<?php echo $row["id"] ?>" class="btn btn-primary">Edit</a></th>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="exampleModalLabel">Add User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="adduser">
                    <body>
                    <div class="form-group">
                        <label for="name">User Type</label>
                        <select id="inputState" class="form-control" name="user_type">
                        <?php
                        $sql = "SELECT * FROM role";
                        $result = $db->query($sql);
                        $count=0;
                        if ($result -> num_rows >  0) {
                            while ($row = $result->fetch_assoc())
                            {
                                ?>
                                    <option value="<?php echo $row['rid'];?>"><?php echo $row['type'];?></option>
                                <?php
                            }
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input type="text" class="form-control" name="username">
                    </div>
                    <div class="form-group">
                        <label for="name">First Name</label>
                        <input type="text" class="form-control" name="first_name">
                    </div>
                    <div class="form-group">
                        <label for="name">Last Name</label>
                        <input type="text" class="form-control" name="last_name">
                    </div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="text" class="form-control" name="email">
                    </div>
                    <div class="form-group">
                        <label for="name">Mobile</label>
                        <input type="text" class="form-control" name="mobile">
                    </div>
                    <div class="form-group">
                        <label for="name">Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                </body>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-dark" name="submit" >Add user</button>
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
