<?php
ob_start();
session_start();

if (!isset($_SESSION['adminname'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: signin.php');
}

if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['adminname']);
    header("location: signin.php");
}

include "includes/connection.php";
function showcustomer()
{
    global $connection;
    $query = "select * from orders order by id desc";
    $select_posts = mysqli_query($connection, $query);
    $i = 0;
    while ($row = mysqli_fetch_assoc($select_posts)) {
        $id = $row['id'];
        $post_title = $row['custid'];
        $post_custname = "";
        $post_address = "";
        $post_contactno = "";
        $querycust = "select * from customers where id ='" . $post_title . "'";
        $select_postscust = mysqli_query($connection, $querycust);
        while ($rowcust = mysqli_fetch_assoc($select_postscust)) {
            $post_custname = $rowcust['name'];
           
            $post_contactno = $rowcust['contactno'];
        }



        $post_container_status = $row['container_status'];
        $post_containers = $row['containers'];
        $post_delivery_date = $row['delivery_date'];
        $post_delivery_time = $row['delivery_time'];
        $post_order_date = $row['order_date'];
        $post_total_amount = $row['total_amount'];
        // $post_modified = $row['modified'];
        if ($post_containers !== "") {
            $i = $i + 1;
            echo "<tr>";
            echo "<td>$i</td>";
            echo "<td>$post_custname</td>";
            echo "<td>$post_contactno</td>";
            echo "<td>$post_order_date</td>";
            echo "<td>$post_containers</td>";
            if ($post_container_status == "Regained") {

            echo "<td style='font-size:20px'><span class='badge bg-success'>$post_container_status</span></td>";
            }
            if ($post_container_status == "Dispatched") {

                echo "<td style='font-size:20px'><span class='badge bg-danger'>$post_container_status</span></td>";
                }

            echo "<td>$post_delivery_date</td>";
            echo "<td>$post_delivery_time</td>";

            echo "<td>$post_total_amount</td>";



            echo "</tr>";
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">

    <!-- Favicon -->
    <link rel="icon" href="assets/img/favicon.png" type="image/x-icon">

    <!-- Title -->
    <title>Indulge in Culinary Excellence: Explore Our Quality Foods | Divyas Kouzina</title>

    <!---bootstrap css-->
    <link id="style" href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!--- FONT-ICONS CSS -->
    <link href="assets/css/icons.css" rel="stylesheet">

    <!---Style css-->
    <link href="assets/css/style.css" rel="stylesheet">

    <!---Plugins css-->
    <link href="assets/css/plugins.css" rel="stylesheet">

    <!-- Switcher css -->
    <link href="assets/switcher/css/switcher.css" rel="stylesheet">
    <link href="assets/switcher/demo.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        /* body {
            background-image: url('assets/img/dbluelogo.svg'); 
            background-size: cover; 
            background-position: center; 
            background-repeat: no-repeat;
            height: 100vh; 
            margin: 0; 
            padding: 0;
        }


        .content {
            padding: 20px;
            color: white;
            text-align: center;
        } */
    </style>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>

<body class="app sidebar-mini">


    <!-- Loader -->
    <div id="global-loader">
        <img src="assets/img/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- End Loader -->

    <!-- Page -->
    <div class="page content">
        <div>
            <?php include 'includes/header.php'; ?>
        </div>
        <!-- Main Content-->
        <div class="main-content side-content pt-0">
            <div class="side-app">

                <div class="main-container container-fluid">

                    <!-- Page Header -->
                    <div class="page-header">
                        <div>
                            <h2 class="main-content-title tx-24 mg-b-5">ASSETS LIST</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                                <li class="breadcrumb-item active" aria-current="page">List of Asset's</li>
                            </ol>
                        </div>
                        <div class="btn-list">


                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="card-header border-bottom-0 p-0">
                                        <h6 class="card-title mb-1">List of Asset's</h6>
                                        <!-- <p class="text-muted card-sub-title">Searching, ordering and paging goodness will be
										immediately added to the table, as shown in this example.</p> -->
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table" id="exportexample">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Customer Name</th>
                                                    <th>Contact No</th>
                                                    <th>Order Date</th>
                                                    <th>Assets Description</th>
                                                    <th>Assets Status</th>
                                                    <th>Delivery Date</th>
                                                    <th>Delivery time</th>
                                                    <th>Total Amount</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                showcustomer();
                                                ?>



                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Row -->


                </div>
            </div>
        </div>
        <!-- End Main Content-->


        <!-- Main Footer-->
        <?php include 'includes/footer.php'; ?>
        <!--End Footer-->

    </div>
    <!-- Back-to-top -->
    <a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

    <!-- Jquery js-->
    <script src="assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap js-->
    <script src="assets/plugins/bootstrap/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- Select2 js-->
    <script src="assets/plugins/select2/js/select2.min.js"></script>

    <!-- DATA TABLE JS-->
    <script src="assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
    <script src="assets/plugins/datatable/js/dataTables.buttons.min.js"></script>
    <script src="assets/js/table-data.js"></script>
    <script src="assets/plugins/datatable/js/buttons.bootstrap5.min.js"></script>
    <script src="assets/plugins/datatable/js/jszip.min.js"></script>
    <script src="assets/plugins/datatable/pdfmake/pdfmake.min.js"></script>
    <script src="assets/plugins/datatable/pdfmake/vfs_fonts.js"></script>
    <script src="assets/plugins/datatable/js/buttons.html5.min.js"></script>
    <script src="assets/plugins/datatable/js/buttons.print.min.js"></script>
    <script src="assets/plugins/datatable/js/buttons.colVis.min.js"></script>
    <script src="assets/plugins/datatable/dataTables.responsive.min.js"></script>
    <script src="assets/plugins/datatable/responsive.bootstrap5.min.js"></script>

    <!-- Perfect-scrollbar js-->
    <script src="assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/p-scroll-1.js"></script>

    <!-- Sidemenu js-->
    <script src="assets/plugins/sidemenu/sidemenu.js"></script>

    <!-- Sidebar js-->
    <script src="assets/plugins/sidebar/sidebar.js"></script>

    <!-- Sticky js-->
    <script src="assets/js/sticky.js"></script>
    <!-- Select2 js-->
    <script src="assets/plugins/select2/js/select2.min.js"></script>
    <script src="assets/js/select2.js"></script>
    <!-- Custom-Switcher js -->
    <script src="assets/js/custom-switcher.js"></script>

    <!-- Custom js-->
    <script src="assets/js/custom.js"></script>

    <!-- Switcher js -->
    <script src="assets/switcher/js/switcher.js"></script>
   

</body>

</html>