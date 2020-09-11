<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Home</title>
    <meta charset="utf-8">
    <link rel="icon" href="assets/images/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/hover.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/modernizr-2.8.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" > </script> 
</head>


<body>
<!-- preloader area start -->
<div id="preloader">
    <div class="loader"></div>
</div>
<!-- preloader area end -->
<?php include 'header/header_index.php'?>
<!-- page container area start -->
<div id="main" >
    <!-- main content area start -->
    <div class="main-content">
        <div id="pg1">
            <div class="slider-area ">
                <div class="slider-active">
                    <!-- Single Slider -->
                    <div class="single-slider slider-height d-flex align-items-center">
                        <div class="container">
                            <div class="row">
                                <div>
                                    <div id="hero__caption">
                                        <label>Safe & Reliable <br><span>&nbsp;&nbsp;&nbsp;&nbsp;Logistic</span> Solutions!</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="background-color:#e6e6e6;">
        <div class="container mb-3" id="container1" >
        <div class="row ">
          <div class="col-lg-4">
            <img class="rounded-circle" src="assets/images/call.png" width="50" height="50">
            <h2>CALL US ANYTIME</h2>
            <p>+(60)123456789</p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="rounded-circle" src="assets/images/clock.png"  width="50" height="50">
            <h2>SUNDAY CLOSED</h2>
            <p>Monday - Sunday 10.00 - 22.00</p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="rounded-circle" src="assets/images/place.png"  width="50" height="50">
            <h2>Malaysia,Kuala Lumpur</h2>
            <p>MY,Bukit Bintang 55100</p>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
        </div>
    </div>
    
    <div class="categories-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Section Tittle -->
                    <div class="section-tittle text-center ">
                        <span>Our Services</span>
                        <h2>What We Can Do For You</h2>
                    </div>
                </div>
            </div>
            <div class="row" id="row1">
                <div class="col-lg-4 col-md-6 col-sm-6 hvr-sweep-to-right" >
                    <div class="single-cat text-center mb-50">
                        <div class="cat-icon">
                            <img class="rounded-circle" src="assets/images/land.png"  width="50" height="50">
                        </div>
                        <div class="cat-cap">
                            <h5>Land Transport</h5>
                            <h7>The sea freight service has grown conside rably in recent years.We spend timetting to know your processes to.</h7>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 hvr-sweep-to-right">
                    <div class="single-cat text-center mb-50">
                        <div class="cat-icon">
                            <img class="rounded-circle" src="assets/images/ship.png"  width="50" height="50">
                        </div>
                        <div class="cat-cap">
                            <h5>Ship Transport</h5>
                            <h7>The sea freight service has grown conside rably in recent years.<br> We spend timetting to know your processes to.</h7>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 hvr-sweep-to-right">
                    <div class="single-cat text-center mb-50">
                        <div class="cat-icon">
                            <img class="rounded-circle" src="assets/images/air.png"  width="50" height="50">
                        </div>
                        <div class="cat-cap">
                            <h5>Air Transport</h5>
                            <h7>The sea freight service has grown conside rably in recent years. <br>We spend timetting to know your processes to.</h7>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- main content area end -->
    <!-- footer area start-->
    <footer style="background-color:black;">
        <div class="footer-area">
            <p>© Copyright on <?php echo date("Y") ?>. All right reserved.</p>
        </div>
    </footer>
    <!-- footer area end-->
</div>
<!-- page container area end -->
<!-- bootstrap 4 js -->
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<!-- others plugins -->
<script src="assets/js/scripts.js"></script>
</body>
</html>
