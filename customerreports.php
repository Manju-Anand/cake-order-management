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
function showcustlist()
{
    global $connection;
    $query = "select * from customers";
    $select_posts = mysqli_query($connection, $query);
    $i = 0;
    while ($row = mysqli_fetch_assoc($select_posts)) {
        $id = $row['id'];
            $i = $i + 1;
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td>" . $row['address'] . "</td>";
        echo "<td>" . $row['contactno'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo "<td>" . $row['landmark'] . "</td>";
              echo "</tr>";
        
    
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
    <style>
 body {
    font-family: 'Roboto', sans-serif;
}
</style>
</head>

<body class="app sidebar-mini">


    <!-- Loader -->
    <!-- <div id="global-loader">
        <img src="assets/img/loader.svg" class="loader-img" alt="Loader">
    </div> -->
    <!-- End Loader -->

    <!-- Page -->
    <div class="page">
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
                            <h2 class="main-content-title tx-24 mg-b-5">Customers List</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Customers</li>
                            </ol>
                        </div>
                        <div class="btn-list">
                            <!-- <a class="btn ripple btn-primary" href="javascript:void(0);"><i class="fe fe-external-link"></i> Export</a> -->
                            <!-- <a class="btn ripple btn-success" href="add-order.php"><i class="fe fe-external-link"></i> &nbsp;&nbsp; Add New Order</a> -->
                            <!-- <a class="btn ripple btn-info" href="javascript:void(0);"><i class="fe fe-help-circle"></i> Help</a>
						<a class="btn ripple btn-danger dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown"
							aria-haspopup="true" aria-expanded="true">
							<i class="fe fe-settings"></i> Settings <i class="fa fa-caret-down ms-1"></i>
						</a>
						<div class="dropdown-menu tx-13">
							<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-eye me-2 float-start"></i>View</a>
							<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-plus-circle me-2 float-start"></i>Add</a>
							<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-mail me-2 float-start"></i>Email</a>
							<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-folder-plus me-2 float-start"></i>Save</a>
							<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-trash-2 me-2 float-start"></i>Remove</a>
							<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-settings me-2 float-start"></i>More</a>
						</div> -->
                        </div>
                    </div>
                    <!-- End Page Header -->

                    <!-- Row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card custom-card overflow-hidden">
                                <div class="card-body">
                                    <div class="card-header border-bottom-0 p-0">
                                        <h6 class="card-title mb-1">List of Customers </h6>
                                        <!-- <p class="text-muted card-sub-title">Searching, ordering and paging goodness will be
										immediately added to the table, as shown in this example.</p> -->
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table" id="exportexample">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                    <th>Contact No</th>
                                                    <th>Email</th>
                                                    <th>Land Mark</th>
                                                                                                  
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                showcustlist();
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