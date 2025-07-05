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
    $query = "select * from customers order by id desc";
    $select_posts = mysqli_query($connection, $query);
    $i = 0;
    while ($row = mysqli_fetch_assoc($select_posts)) {
        $id = $row['id'];
        $post_title = $row['name'];
        $post_address = $row['address'];
        $post_contactno = $row['contactno'];
        $post_email = $row['email'];
        $post_landmark = $row['landmark'];
        $post_dis = $row['status'];
        $post_created = $row['created'];
        $post_modified = $row['modified'];

        $i = $i + 1;
        echo "<tr>";
        echo "<td>$i</td>";
        echo "<td>$post_title</td>";
        echo "<td>$post_address</td>";
        echo "<td>$post_contactno</td>";
        echo "<td>$post_email</td>";
        echo "<td>$post_landmark</td>";
        echo "<td> <a href='orderHistory.php?view={$id}'><button type='button' class='gradient-button gradient4'>Order History</button></a></td>";
        // echo "<td>$post_dis</td>";
        // echo "<td>$post_created</td>";
        // echo "<td>$post_modified </td>";<button type="button" class="btn btn-danger-gradient btn-wave waves-effect waves-light">Danger</button>
        echo "<td><a class='btn btn-sm btn-warning  view-details-btn'   data-bs-target='#viewmodal' data-bs-toggle='modal' data-recordid={$id} title='View Customers Details' style='color:white'>
        <span class='fe fe-eye'> </span></a>&nbsp;
       
        <a class='btn btn-sm btn-primary' href='edit-customer.php?edit={$id}' title='Edit' style='color:white'>
        <span class='fe fe-edit'> </span></a>&nbsp;
        <a class='btn btn-sm btn-danger' onclick='javascript:confirmationDelete($(this));return false;' href='customerlist.php?delete={$id}' class='text-inverse' id='qusdelete' title='Delete' data-toggle='tooltip' style='color:white'>
        <span class='fe fe-trash-2'> </span></a>
        </td>";

        // echo "<td><button id='qusedit' type='button' class='btn btn-sm btn-primary' > <a class='btn btn-sm btn-primary' href='edit-department.php?edit={$id}' title='Edit' style='color:white'>

   

        echo "</tr>";
    }
}

function deletecustomer()
{
    global $connection;
    if (isset($_GET['delete'])) {
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM customers WHERE id = '" . $the_cat_id . "'";
        $delete_query = mysqli_query($connection, $query);
        if (!$delete_query) {
            die('QUERY FAILED' . mysqli_error($connection));
        }

        header("Location: customerlist.php");
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
    <link href="assets/css/gradientbutton.css" rel="stylesheet">
    <!---Plugins css-->
    <link href="assets/css/plugins.css" rel="stylesheet">

    <!-- Switcher css -->
    <link href="assets/switcher/css/switcher.css" rel="stylesheet">
    <link href="assets/switcher/demo.css" rel="stylesheet">
  
   
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
                            <h2 class="main-content-title tx-24 mg-b-5">Customers</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                                <li class="breadcrumb-item active" aria-current="page">List of Customers</li>
                            </ol>
                        </div>
                        <div class="btn-list">
                            <!-- <a class="btn ripple btn-primary" href="javascript:void(0);"><i class="fe fe-external-link"></i> Export</a> -->
                            <a class="btn ripple btn-success" href="add-customer.php"><i class="fe fe-external-link"></i> &nbsp;&nbsp; Add New Customers</a>
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
                                        <h6 class="card-title mb-1">List of Customers</h6>
                                        
                                        <!-- <a href="buttons.html"><button type="button" class="btn btn-danger-light btn-wave waves-effect waves-light">Danger</button></a>
                                        <button class="btn btn-sm instagram-gradient-button">Click Me</button>
                                        <button class="gradient-button gradient1">Order History</button>
    <button class="gradient-button gradient2">Order History</button>
    <button class="gradient-button gradient3">Order History</button>
    <button class="gradient-button gradient4">Order History</button>
    <button class="gradient-button gradient5">Order History</button> -->
                                       
                                        <!-- <p class="text-muted card-sub-title">Searching, ordering and paging goodness will be
										immediately added to the table, as shown in this example.</p> -->
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table" id="example1">
                                            <thead>
                                                <tr>
                                                <th>#</th>
                                                    <th>Name</th>
                                                    <th>Address</th>
                                                    <th>Contact No</th>
                                                    <th>Email</th>
                                                    <th>Landmark</th>
                                                    <th>History</th>
                                                    <!-- <th>Status</th>
                                                    <th>Created</th>
                                                    <th>Modified</th> -->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                showcustomer();
                                                ?>
                                                <?php
                                                deletecustomer();
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
        <div class="modal fade" id="viewmodal">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">View Customer Details</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="postercontent">Customer Name :</label>
                                <input class="form-control" type="text" id="vcustname" name="vcustname" value="" readonly>
                       
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="posteridea">Customer Address :</label>
                                <textarea class="form-control" name="vcadd" id="vcadd" rows="5" readonly> </textarea>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="postercontent">Contact No :</label>
                                <input class="form-control" type="text" id="vcno" name="vcno" value="" readonly>
                       
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="postercontent">Email Id :</label>
                                <input class="form-control" type="text" id="vemail" name="vemail" value="" readonly>
                       
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="postercontent">Land Mark :</label>
                                <input class="form-control" type="text" id="vlandmark" name="vlandmark" value="" readonly>
                       
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="postercontent">Status :</label>
                                <input class="form-control" type="text" id="vstatus" name="vstatus" value="" readonly>
                       
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="postercontent">Created Date & Time :</label>
                                <input class="form-control" type="text" id="vcreated" name="vcreated" value="" readonly>
                       
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="pdeadline">Modified Date & Time :</label>
                                <input class="form-control" type="text" id="vmodified" name="vmodified" value="" readonly>
                            </div>
                           

                            <!-- </div> -->
                        </div>
                        <div class="modal-footer">

                            <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

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

   
            <script>

                function confirmationDelete(anchor)
                {
                var conf = confirm('Are you sure want to delete this record?');
                if(conf)
                    window.location=anchor.attr("href");
                }
              


                $('.view-details-btn').on('click', function() {
                    var recordId = $(this).data('recordid');

                    // Make AJAX request to fetch data based on recordId
                    $.ajax({
                        type: 'POST',
                        url: 'viewcustdetails.php', // Replace with the actual path to your PHP script
                        data: {
                            recordId: recordId
                        },
                        dataType: 'json',
                        success: function(response) {
                            // Populate fields in viewmodal
                           
                           
                            $('#vcustname').val(response.name);
                            $('#vcadd').val(response.address);
                            $('#vcno').val(response.contactno);
                            $('#vemail').val(response.email);
                            $('#vstatus').val(response.status);
                            $('#vlandmark').val(response.landmark);
                            $('#vcreated').val(response.created);
                            $('#vmodified').val(response.modified);
                            // Add similar lines for other fields
                        },
                        error: function(error) {
                            console.error('Error fetching data:', error);
                        }
                    });
                });
            </script>

</body>

</html>