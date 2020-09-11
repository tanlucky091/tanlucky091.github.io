<?php
session_start();
$_SESSION['noti']=0;
$_SESSION['noti1']=0;
$_SESSION['noti2']=0;
$_SESSION['noti3']=0;
$_SESSION['noti4']=0;
$_SESSION['noti5']=0;
$_SESSION['noti6']=0;

include 'conn.php';
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
if (isset($_GET['logout'])) {
    session_destroy();
    session_unset();
    header("location: index");
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Summary</title>
    <link rel="icon" href="assets/images/icon.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/sidebar.css">
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <!-- others css -->
    <link rel="stylesheet" href="assets/css/typography.css">
    <link rel="stylesheet" href="assets/css/default-css.css">
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <!-- modernizr css -->
    <script src="assets/js/modernizr-2.8.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" > </script> 
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        <?php if ($_SESSION['role'] == 1) { ?>
        var data;
        var chart;

        // Load the Visualization API and the piechart package.
        google.charts.load('current', {'packages':['corechart']});

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {

            // Create our data table.
            data = new google.visualization.DataTable();
            data.addColumn('string', 'Month');
            data.addColumn('number', 'Parcel');
            data.addRows([
                <?php
                $sql = "SELECT COUNT(product_id),CONCAT_WS('/',YEAR(date_create),MONTH(date_create)) AS Month FROM product GROUP BY Month";
                $result = $db->query($sql);
                while ($row =  mysqli_fetch_array($result))
                {
                    echo "['".$row['Month']."',".$row['COUNT(product_id)']."],";
                }
                ?>
            ]);

            // Set chart options
            var options = {'title':'Total Parcel',
                backgroundColor: 'none',
                hAxis: {title: "Month"},
                vAxis:{title: "Total",format: 'decimal'}
            };
            // Instantiate and draw our chart, passing in some options.
            chart = new google.visualization.LineChart(document.getElementById('linechart'));
            chart.draw(data, options);

            // Create our data table.
            data1 = new google.visualization.DataTable();
            data1.addColumn('string', 'Month');
            data1.addColumn('number', 'Parcel');
            data1.addRows([
                <?php
                $sql = "SELECT COUNT(shipment_id),CONCAT_WS('/',YEAR(sdate_update),MONTH(sdate_update)) AS Month FROM shipment WHERE status=3 GROUP BY Month";
                $result = $db->query($sql);
                while ($row =  mysqli_fetch_array($result))
                {
                    echo "['".$row['Month']."',".$row['COUNT(shipment_id)']."],";
                }
                ?>
            ]);

            // Set chart options
            var options1 = {'title':'Total Parcel Ship',
                backgroundColor: 'none',
                hAxis: {title: "Month"},
                vAxis:{title: "Total",format: 'decimal'}
            };
            // Instantiate and draw our chart, passing in some options.
            chart = new google.visualization.LineChart(document.getElementById('linechart1'));
            chart.draw(data1, options1);

            // Create our data table.
            data2 = new google.visualization.DataTable();
            data2.addColumn('string', 'Month');
            data2.addColumn('number', 'Sales');
            data2.addRows([
                <?php
                $sql = "SELECT SUM(price),CONCAT_WS('/',YEAR(sdate_update),MONTH(sdate_update)) AS Month FROM shipment WHERE status=3 GROUP BY Month";
                $result = $db->query($sql);
                while ($row =  mysqli_fetch_array($result))
                {
                    echo "['".$row['Month']."',".$row['SUM(price)']."],";
                }
                ?>
            ]);

            // Set chart options
            var options2 = {'title':'Total Sales',
                backgroundColor: 'none',
                hAxis: {title: "Month"},
                vAxis:{title: "Total",format: 'decimal'}
            };
            // Instantiate and draw our chart, passing in some options.
            chart = new google.visualization.LineChart(document.getElementById('linechart2'));
            chart.draw(data2, options2);

            // Create our data table.
            data3 = new google.visualization.DataTable();
            data3.addColumn('string', 'Month');
            data3.addColumn('number', 'Parcel');
            data3.addRows([
                <?php
                $sql = "SELECT SUM(total_weight),CONCAT_WS('/',YEAR(sdate_update),MONTH(sdate_update)) AS Month FROM shipment WHERE status=3 GROUP BY Month";
                $result = $db->query($sql);
                while ($row =  mysqli_fetch_array($result))
                {
                    echo "['".$row['Month']."',".$row['SUM(total_weight)']."],";
                }
                ?>
            ]);

            // Set chart options
            var options3 = {'title':'Total Weight Ship',
                backgroundColor: 'none',
                hAxis: {title: "Month"},
                vAxis:{title: "Total",format: 'decimal'}
            };
            // Instantiate and draw our chart, passing in some options.
            chart = new google.visualization.LineChart(document.getElementById('linechart3'));
            chart.draw(data3, options3);
            <?php } else { ?>
            var data;
            var chart;

            // Load the Visualization API and the piechart package.
            google.charts.load('current', {'packages':['corechart']});

            // Set a callback to run when the Google Visualization API is loaded.
            google.charts.setOnLoadCallback(drawChart);

            // Callback that creates and populates a data table,
            // instantiates the pie chart, passes in the data and
            // draws it.
            function drawChart() {

                // Create our data table.
                data = new google.visualization.DataTable();
                data.addColumn('string', 'Month');
                data.addColumn('number', 'Parcel');
                data.addRows([
                    <?php
                    $sql = "SELECT COUNT(product_id),CONCAT_WS('/',YEAR(date_create),MONTH(date_create)) AS Month FROM product where user_id='".$_SESSION['id']."'  GROUP BY Month";
                    $result = $db->query($sql);
                    while ($row =  mysqli_fetch_array($result))
                    {
                        echo "['".$row['Month']."',".$row['COUNT(product_id)']."],";
                    }
                    ?>
                ]);

                // Set chart options
                var options = {'title':'Total Parcel',
                    backgroundColor: 'none',
                    hAxis: {title: "Month"},
                    vAxis:{title: "Total",format: 'decimal'}
                };
                // Instantiate and draw our chart, passing in some options.
                chart = new google.visualization.LineChart(document.getElementById('linechart4'));
                chart.draw(data, options);

                // Create our data table.
                data1 = new google.visualization.DataTable();
                data1.addColumn('string', 'Month');
                data1.addColumn('number', 'Parcel');
                data1.addRows([
                    <?php
                    $sql = "SELECT COUNT(shipment_id),CONCAT_WS('/',YEAR(sdate_create),MONTH(sdate_create)) AS Month FROM shipment inner join status on shipment.status = status.stid WHERE status_name='Shipped' AND user_id='".$_SESSION['id']."' GROUP BY Month";
                    $result = $db->query($sql);
                    while ($row =  mysqli_fetch_array($result))
                    {
                        echo "['".$row['Month']."',".$row['COUNT(shipment_id)']."],";
                    }
                    ?>
                ]);

                // Set chart options
                var options1 = {'title':'Total Parcel Ship',
                    backgroundColor: 'none',
                    hAxis: {title: "Month"},
                    vAxis:{title: "Total",format: 'decimal'}
                };
                // Instantiate and draw our chart, passing in some options.
                chart = new google.visualization.LineChart(document.getElementById('linechart5'));
                chart.draw(data1, options1);
                <?php } ?>


            }

    </script>
</head>

<body>
<!-- preloader area start -->
<div id="preloader">
    <div class="loader"></div>
</div>
<!-- preloader area end -->
<?php include 'header/header.php'; ?>

<!-- page container area start -->
<div id="main" >
    <!-- main content area start -->
    <div class="main-content">
        <!-- page title area start -->
        <?php include 'header/page_title.php'?>
        <!-- page title area end -->
        <div>
            <h1 style="text-align:center">Summary</h1>
            <div class="main-content-inner">
                <div class="row">
                    <!-- Contextual Classes start -->
                    <div class="card">
                        <div class="card-body">
                            <div class="single-table">
                                <div class="table-responsive">
                                    <table class="table text-dark text-center">
                                        <tbody>
                                        <?php if ($_SESSION['role'] == 1) { ?>
                                            <tr>
                                                <td id ="chart1">
                                                    <div id="linechart" style="width:900px;height:350px;"></div>
                                                </td>
                                                <td id ="chart2">
                                                    <div id="linechart1" style="width:900px;height:350px;"></div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td id ="chart2">
                                                    <div id="linechart2" style="width:900px;height:350px;"></div>
                                                </td>
                                                <td id ="chart1">
                                                    <div id="linechart3" style="width:900px;height:350px;"></div>
                                                </td>
                                            </tr>
                                        <?php } else { ?>
                                            <tr>
                                                <td id ="chart1">
                                                    <div id="linechart4" style="width:900px;height:350px;"></div>
                                                </td>
                                                <td id ="chart2">
                                                    <div id="linechart5" style="width:900px;height:350px;"></div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
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
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.slimscroll.min.js"></script>
<!-- others plugins -->
<script src="assets/js/plugins.js"></script>
<script src="assets/js/scripts.js"></script>
</body>
</html>
