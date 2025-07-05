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

    <!--- bootstrap css -->
    <link id="style" href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!--- FONT-ICONS CSS -->
    <link href="assets/css/icons.css" rel="stylesheet">

    <!--- Style css -->
    <link href="assets/css/style.css?v=1.0.0" rel="stylesheet">

    <!--- Plugins css -->
    <link href="assets/css/plugins.css" rel="stylesheet">

    <!-- Switcher css -->
    <link href="assets/switcher/css/switcher.css" rel="stylesheet">
    <link href="assets/switcher/demo.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .hidden-cell {
            display: none;
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
                            <h2 class="main-content-title tx-24 mg-b-5">Edit Customer</h2>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Administrator</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Customers</li>
                            </ol>
                        </div>
                        <div class="btn-list">
                            <a class="btn ripple btn-primary" href="javascript:void(0);"><i class="fe fe-external-link"></i> Export</a>
                            <a class="btn ripple btn-secondary" href="javascript:void(0);"><i class="fe fe-download"></i> Download</a>
                            <a class="btn ripple btn-info" href="javascript:void(0);"><i class="fe fe-help-circle"></i> Help</a>
                            <a class="btn ripple btn-danger dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <i class="fe fe-settings"></i> Settings <i class="fa fa-caret-down ms-1"></i>
                            </a>
                            <!-- <div class="dropdown-menu tx-13">
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

                    <!-- ROW-1 OPEN -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="card-title">Edit Customer</div>
                                </div>
                                <!-- <form id="editdept" method="post" action=""> -->
                                    <?php
                                    if (isset($_GET['edit'])) {
                                        $the_cat_id = $_GET['edit'];

                                        $query = "select * from customers WHERE id = {$the_cat_id}";
                                        $select_edits = mysqli_query($connection, $query);

                                        while ($row1 = mysqli_fetch_assoc($select_edits)) {



                                    ?>
                                            <input type="hidden" value="<?php echo $the_cat_id;  ?>" id="editid" name="editid">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="category">Customer Name :</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" id="customer" name="customer" value="<?php if (isset($row1['name'])) {
                                                                                                                                                    echo $row1['name'];
                                                                                                                                                } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="Customer">Customer Address :</label>
                                                            <div class="col-md-9">

                                                                <textarea class="form-control" name="cadd" id="cadd" rows="4"><?php if (isset($row1['address'])) {
                                                                                                                                    echo $row1['address'];
                                                                                                                                } ?></textarea>
                                                            </div>
                                                        </div>


                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="Customer">DOB :</label>
                                                            <div class="col-md-9">
                                                                <input type="date" class="form-control" name="cdob" id="cdob" placeholder="Date Of Birth" value="<?php if (isset($row1['dob'])) {
                                                                                                                                                                        echo $row1['dob'];
                                                                                                                                                                    } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="Customer">Anniversary Date :</label>
                                                            <div class="col-md-9">
                                                                <input type="date" class="form-control" name="canndate" id="canndate" placeholder="Anniversary Date" value="<?php if (isset($row1['anniversaryDate'])) {
                                                                                                                                                                                echo $row1['anniversaryDate'];
                                                                                                                                                                            } ?>">
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="Customer">Contact No :</label>
                                                            <div class="col-md-9">
                                                                <input type="number" class="form-control" name="cphoneno" id="cphoneno" value="<?php if (isset($row1['contactno'])) {
                                                                                                                                                    echo $row1['contactno'];
                                                                                                                                                } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="Customer">Email Id :</label>
                                                            <div class="col-md-9">
                                                                <input type="email" class="form-control" name="cemail" id="cemail" value="<?php if (isset($row1['email'])) {
                                                                                                                                                echo $row1['email'];
                                                                                                                                            } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="Customer">Landmark :</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" name="landmark" id="landmark" value="<?php if (isset($row1['landmark'])) {
                                                                                                                                                    echo $row1['landmark'];
                                                                                                                                                } ?>">
                                                            </div>
                                                        </div>
                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="Customer">Customer Remarks:</label>
                                                            <div class="col-md-9">
                                                                <input type="text" class="form-control" name="cremarks" id="cremarks" placeholder="Customer Remarks" value="<?php if (isset($row1['custRemarks'])) {
                                                                                                                                                                                echo $row1['custRemarks'];
                                                                                                                                                                            } ?>">
                                                            </div>
                                                        </div>



                                                        <div class="row mb-4">
                                                            <label class="col-md-3 form-label" for="status">Status :</label>
                                                            <div class="col-md-9">
                                                                <select name="status" id="status" class="form-control form-select select2" data-bs-placeholder="Select Status">
                                                                    <option value="<?php if (isset($row1['status'])) {
                                                                                        echo $row1['status'];
                                                                                    } ?>"> <?php if (isset($row1['status'])) {
                                                                                                                                                        echo $row1['status'];
                                                                                                                                                    } ?> </option>

                                                                    <option value="Active">Active</option>
                                                                    <option value="Inactive">Inactive</option>

                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- ***************** relatives *********************** -->
                                                <div class="row">
                                                    <div class="card custom-card" style="border: 1.5px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 1, 1, 0.1);">
                                                        <div class="card-header justify-content-between">
                                                            <div class="card-title">
                                                                Edit or Add Relatives Details Here
                                                            </div>
                                                        </div>
                                                        <div class="card-body d-sm-flex align-items-center justify-content-between">


                                                            <div class="row mb-4">


                                                                <div class="col-md-2">
                                                                    <label class="form-label" for="staff">Relation:</label>
                                                                    <select class="form-select mb-3" aria-label="Default select example" name="relation" id="relation" required>
                                                                        <option value="" disabled selected>Select Relation</option>

                                                                        <option value="Husband" >Husband</option>
                                                                        <option value="Wife" >Wife</option>
                                                                        <option value="Son">Son</option>
                                                                        <option value="Daughter">Daughter</option>
                                                                        <option value="Father">Father</option>
                                                                        <option value="Mother">Mother</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-label" for="deadline">Name :</label>
                                                                    <input type="text" class="form-control" id="rname" name="rname" placeholder="Enter Name" required>

                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-label" for="assignwork">Age :</label>
                                                                    <input type="number" class="form-control" id="rage" name="rage" placeholder="Enter Age" required>

                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-label" for="deadline">DOB :</label>
                                                                    <input type="date" class="form-control" id="rdob" name="rdob" placeholder="Enter DOB" required>

                                                                </div>

                                                                <div class="col-md-2">
                                                                    <label class="form-label" for="dept" style="color:transparent">Transparent Label :</label>
                                                                    <button type="button" name="submit" class="btn btn-primary" onclick="addProduct()" style="color:white;cursor:pointer;">Add Relative</button>

                                                                </div>
                                                                <hr>

                                                                <div class="table-responsive">

                                                                    <table class="table table-bordered mg-b-0" id="productTable">
                                                                        <thead>
                                                                            <tr style="background-color: #add8e6;">
                                                                                <th>#</th>
                                                                                <th>Relation</th>
                                                                                <!-- <th class="hidden-cell">product Id</th> -->
                                                                                <th class="qty">Name</th>
                                                                                <th class="mrp">Age</th>

                                                                                <th>DOB</th>

                                                                                <th>Action</th>
                                                                                <th class="hidden-cell">status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="ajaxstaffallocateresults">
                                                                            <?php

                                                                            $querypay = "select * from crelatives where custid ='" . $the_cat_id . "'";
                                                                            $select_postspay = mysqli_query($connection, $querypay);
                                                                            $r = 0;
                                                                            while ($rowpay = mysqli_fetch_assoc($select_postspay)) {
                                                                                $r = $r + 1;
                                                                                $rowId1 = "row1_" . $rowpay['id'] . round(microtime(true) * 1000);
                                                                            ?>
                                                                                <tr data-rowid="<?php echo $rowId1; ?>">
                                                                                    <td><?php echo $r; ?></td>
                                                                                    <td><?php echo $rowpay['relation']; ?></td>
                                                                                    <td><?php echo $rowpay['rname']; ?></td>
                                                                                    <td><?php echo $rowpay['rage']; ?></td>
                                                                                    <td><?php echo $rowpay['rdob']; ?></td>
                                                                                    <td><a class='btn btn-sm btn-primary edit-btn' data-bs-target='#paymentmodal' data-bs-toggle='modal' title='Edit' style='color:white'>
                                                                                            <span class='fe fe-edit'> </span></a>&nbsp;&nbsp;
                                                                                        <a class='btn btn-sm btn-danger delete-btn' id='qusdelete' title='Delete' data-toggle='tooltip' style='color:white'>
                                                                                            <span class='fe fe-trash-2'> </span></a>
                                                                                    </td>
                                                                                    <!--class="hidden-cell" -->
                                                                                    <td >Saved</td>
                                                                                    <td ><?php echo $rowpay['id']; ?></td>
                                                                                </tr>

                                                                            <?php } ?>
                                                                        </tbody>

                                                                    </table>

                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- ****************  ****************** -->
                                                <!-- ====================================== -->






                                            </div>
                                            <div class="card-footer">
                                                <!--Row-->
                                                <div class="row">
                                                    <div class="col-md-3"></div>
                                                    <div class="col-md-9">
                                                        <button type="submit" name="submit" class="btn btn-primary" onclick="saveDataToDatabase()" style="color:white;cursor:pointer;">Edit Customer</button>
                                                        <a href="javascript:void(0)" class="btn btn-default float-end" id="cancel">Discard</a>
                                                    </div>
                                                </div>
                                                <!--End Row-->
                                            </div>

                                        
                                    <?php }
                                    } ?>
                                <!-- </form> -->
                            </div>
                        </div>
                    </div>
                    <!-- /ROW-1 CLOSED -->
                </div>
            </div>
        </div>
        <!-- End Main Content-->

        <div class="modal fade" id="paymentmodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit Payment Details -</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" class="form-control" id="modalpayrowid" name="modalpayrowid" required>

                            <div class="col-md-6">
                                <label class="form-label" for="paytype">Relationship :</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="modalrelation" id="modalrelation" required>
                                    <option value="" disabled selected>Select Relation</option>

                                    <option value="Husband" data-questions="Husband" data-answers="Husband">Husband</option>
                                    <option value="Wife" data-questions="Wife" data-answers="Wife">Wife</option>
                                    <option value="Son">Son</option>
                                    <option value="Daughter">Daughter</option>
                                    <option value="Father">Father</option>
                                    <option value="Mother">Mother</option>
                                </select>
                            </div>




                            <div class="col-md-6">
                                <label class="form-label" for="paymentamt">Name :</label>
                                <input type="text" class="form-control" id="modalname" name="modalname" placeholder="" required>

                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="paymentamt">Age :</label>
                                <input type="number" class="form-control" id="modalage" name="modalage" placeholder="" required>

                            </div>


                            <div class="col-md-6">
                                <label class="form-label" for="paycustbillno">Date of Birth :</label>
                                <input type="date" class="form-control" id="modaldob" name="modaldob" placeholder="" required>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="savepayChangesBtn" type="button">Save changes</button>
                        <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Footer-->
        <?php include 'includes/footer.php'; ?>
        <!--End Footer-->

    </div>
    <!-- End Page -->

    <!-- Back-to-top -->
    <a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

    <!-- Jquery js-->
    <script src="assets/plugins/jquery/jquery.min.js"></script>

    <!-- Bootstrap js-->
    <script src="assets/plugins/bootstrap/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- INTERNAL SELECT2 JS -->
    <script src="assets/plugins/select2/js/select2.full.min.js"></script>
    <script src="assets/js/select2.js"></script>

    <!-- Chart.Bundle js-->
    <script src="assets/plugins/chart.js/Chart.bundle.min.js"></script>

    <!-- Perfect-scrollbar js-->
    <script src="assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/p-scroll-1.js"></script>

    <!-- Sidemenu js-->
    <script src="assets/plugins/sidemenu/sidemenu.js"></script>

    <!-- Sidebar js-->
    <script src="assets/plugins/sidebar/sidebar.js"></script>

    <!-- INTERNAL WYSIWYG Editor JS -->
    <script src="assets/plugins/wysiwyag/jquery.richtext.js "></script>
    <script src="assets/plugins/wysiwyag/wysiwyag.js "></script>

    <!-- INTERNAL File-Uploads Js-->
    <script src="assets/plugins/fancyuploder/jquery.ui.widget.js"></script>
    <script src="assets/plugins/fancyuploder/jquery.fileupload.js"></script>
    <script src="assets/plugins/fancyuploder/jquery.iframe-transport.js"></script>
    <script src="assets/plugins/fancyuploder/jquery.fancy-fileupload.js"></script>
    <script src="assets/plugins/fancyuploder/fancy-uploader.js"></script>

    <!-- Sticky js-->
    <script src="assets/js/sticky.js"></script>

    <!-- Custom-Switcher js -->
    <script src="assets/js/custom-switcher.js"></script>

    <!-- Custom js-->
    <script src="assets/js/custom.js"></script>
    
    <script src="edit-customers.js"></script>
    <!-- Switcher js -->
    <script src="assets/switcher/js/switcher.js"></script>
    <script>
        $(document).ready(function(e) {
            $('#cancel').delegate('', 'click change', function() {
                window.location = "customerlist.php";
                return false;
            });
        });
    </script>
    <script>
        function capitalizeFirstLetter(str) {
            return str.replace(/\b\w/g, function(char) {
                return char.toUpperCase();
            });
        }

        window.addEventListener('DOMContentLoaded', function() {
            let formInputs = document.querySelectorAll('#addcateg input[type="text"], #addcateg select');
            formInputs.forEach(function(input) {
                input.addEventListener('input', function(event) {
                    let currentValue = event.target.value;
                    event.target.value = capitalizeFirstLetter(currentValue);
                });
            });
        });
    </script>
</body>

</html>