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
if (isset($_GET['edit'])) {
    $the_cat_id = $_GET['edit'];

    $query = "select * from orders WHERE id = {$the_cat_id}";
    $select_edits = mysqli_query($connection,$query);
        
    while($row1 = mysqli_fetch_assoc($select_edits))
    {


    
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
    <link href="assets/css/style.css" rel="stylesheet">

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
        .form-label{
            font-weight: bolder;
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

                  

                    <!-- ROW-1 OPEN -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-header">
                                <!-- <div>
                                    <h2 class="main-content-title tx-24 mg-b-5">Add New Order</h2>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Administrator</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Order</li>
                                    </ol>
                                </div> -->
                                    <div class="card-title"><h2>Edit Order</h2>
                                <input type="hidden" value="<?php echo $the_cat_id;  ?>" id="editid" name="editid">
                                </div>
                                </div>
                                <form id="addcateg" method="post" action="">
                                    <div class="card-body">
                                        <!-- ============================================================ -->
                                        <div class="row mb-4">
                                            <div class="col-md-6 mb-4">
                                                <label class="col-md-6 form-label" for="Order">Customer Name :</label>
                                                <select name="custname" id="custname" class="form-control form-select select2" data-bs-placeholder="Select Customer" required>
                                                 
                                                    <?php
                                                    $querycust = "select * from customers order by id desc";
                                                    $select_editscust = mysqli_query($connection, $querycust);
                                                    while ($rowcust = mysqli_fetch_assoc($select_editscust)) {
                                                    ?>
                                                        <option value="<?php echo $rowcust['id']; ?>" 
                                                        <?php if($row1['custid'] == $rowcust['id']){ ?> selected  <?php } ?>
                                                        ><?php echo $rowcust['name']; ?></option>
                                                    <?php } ?>

                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="col-md-6 form-label" for="Order">Order Date:</label>
                                                <input type="date" class="form-control" name="odate" id="odate" placeholder="Enter Order Date" value="<?php echo $row1['order_date']  ?>" required>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="col-md-6 form-label" for="Order">Order Type :</label>
                                                <select name="ordertype" id="ordertype" class="form-control form-select select2"  required>
                                                        <option value="<?php echo $row1['orderType'] ?>"><?php echo $row1['orderType'] ?></option>
                                                   
                                                        <option value="Domestic">Domestic</option>
                                                        <option value="International">International</option>

                                                </select>
                                                <br>&nbsp;&nbsp;
                                                <label class="col-md-6 form-label" for="Order">Branch :</label>
                                                <select name="branch" id="branch" class="form-control form-select select2"  required>
                                                        <option value="<?php echo $row1['branch'] ?>"><?php echo $row1['branch'] ?></option>
                                                   
                                                        <option value="Kumbanad">Kumbanad</option>
                                                        <option value="Pulimootil">Pulimootil</option>

                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="col-md-13 form-label" for="Order">Additional Contact Information [ Names & Numbers ] </label>
                                                <textarea class="form-control" name="cinfo" id="cinfo" placeholder="Enter Additional Contact Information" rows="5"><?php echo $row1['additional_contact']  ?></textarea>

                                            </div>
                                            <div class="col-md-12 mb-4">
                                                <div class="card custom-card" style="border: 1.5px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 1, 1, 0.1);">
                                                    <div class="card-header justify-content-between">
                                                        <div class="card-title">
                                                           Add Product Details Here
                                                        </div>
                                                    </div>
                                                    <div class="card-body d-sm-flex align-items-center justify-content-between">


                                                        <div class="row mb-4">

                                                            
                                                            <div class="col-md-2">
                                                                <label class="form-label" for="staff">Select Products:</label>
                                                                <select class="form-select mb-3" aria-label="Default select example" name="prod" id="prod" required>
                                                                    <option value="" disabled selected>Select Products</option>
                                                                    <?php
                                                                    $query = "select * from products order by id desc";
                                                                    $select_posts = mysqli_query($connection, $query);
                                                                    while ($row = mysqli_fetch_assoc($select_posts)) {
                                                                    ?>
                                                                        <option value="<?php echo $row['id'] ?>" data-questions="<?php echo $row['mrp'] ?>" data-answers="<?php echo $row['marketing_price'] ?>"><?php echo $row['pname'] ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-label" for="deadline">Quantity :</label>
                                                                <input type="number" class="form-control" id="pqty" name="pqty" placeholder="Enter Quantity" max="1000" oninput="calculateGST()"  value="1" required>

                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-label" for="assignwork">Selling Price [MRP] :</label>
                                                                <input type="text" class="form-control" id="mrp" name="mrp" placeholder="Enter Selling Price / Mrp" oninput="calculateGST()" required>

                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-label" for="deadline">GST (5%) :</label>
                                                                <input type="text" class="form-control" id="pgst" name="pgst" placeholder="GST Amount" required readonly>

                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-label" for="deadline">Total :</label>
                                                                <input type="number" class="form-control" id="ptot" name="ptot" placeholder="Total Amount" required readonly>

                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-label" for="dept" style="color:transparent">Transparent Label :</label>
                                                                <button type="button" name="submit" class="btn btn-primary" onclick="addProduct()" style="color:white;cursor:pointer;">Add Product</button>

                                                            </div>
                                                            <hr>

                                                            <div class="table-responsive">

                                                                <table class="table table-bordered mg-b-0" id="productTable">
                                                                    <thead>
                                                                        <tr style="background-color: #add8e6;">
                                                                            <th>#</th>
                                                                            <th>Product Name</th>
                                                                            <th class="hidden-cell">product Id</th>
                                                                            <th class="qty">Qty</th>
                                                                            <th class="mrp">Selling Price</th>
                                                                           
                                                                            <th>GST </th>
                                                                            <th class="total">Total</th>
                                                                            <th>Action</th>
                                                                            <th class="hidden-cell">status</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="ajaxstaffallocateresults">
                                                                    <?php

                                                                        $queryproduct = "select * from order_products where order_id ='" . $the_cat_id . "'";
                                                                        $select_postsproduct = mysqli_query($connection, $queryproduct);
                                                                        $r = 0;
                                                                        while ($rowproduct = mysqli_fetch_assoc($select_postsproduct)) {
                                                                            $r = $r + 1;
                                                                            $productid = $rowproduct['product_id'];
                                                                            $productname = "";
                                                                            $queryproductname = "select * from products where id ='" . $productid . "'";
                                                                            $select_postsproductname = mysqli_query($connection, $queryproductname);
                                                                            while ($rowproductname = mysqli_fetch_assoc($select_postsproductname)) {
                                                                                $productname = $rowproductname['pname'];
                                                                            }
                                                                          $rowId = "row_" . $rowproduct['product_id'] . $rowproduct['id'] ."_". round(microtime(true) * 1000);

                                                                        ?>
                                                                            <tr data-rowid="<?php echo $rowId; ?>">
                                                                                <td><?php echo $r; ?></td>
                                                                                <td><?php echo $productname; ?></td>
                                                                                <!-- class="hidden-cell" -->
                                                                                <td class="hidden-cell"><?php echo $rowproduct['product_id']; ?></td>
                                                                                <td class="qty"><?php echo $rowproduct['qty']; ?></td>
                                                                                <td class="mrp"><?php echo $rowproduct['mrp']; ?></td>
                                                                                <td><?php echo $rowproduct['gst']; ?></td>
                                                                                <td class="total"><?php echo $rowproduct['total']; ?></td>
                                                                                <td><a class='btn btn-sm btn-primary edit-btn'  data-bs-target='#suppliermodal' data-bs-toggle='modal' title='Edit' style='color:white'>
                                                                                        <span class='fe fe-edit'> </span></a>&nbsp;&nbsp;
                                                                                        <a class='btn btn-sm btn-danger delete-btn'  id='qusdelete' title='Delete' data-toggle='tooltip' style='color:white'>
                                                                                        <span class='fe fe-trash-2'> </span></a>
                                                                                </td>
                                                                                <!-- class="hidden-cell" -->
                                                                                <td class="hidden-cell">Saved</td>
                                                                                <td class="hidden-cell"><?php echo $rowproduct['id']; ?></td>
                                                                            </tr>

                                                                        <?php } ?>

                                                                    </tbody>
                                                                    <tfoot>
                                                                        <td colspan="2">Total</td>
                                                                        <td ></td>
                                                                        <td></td>
                                                                        <td></td>
                                                                        <td id='total'><?php echo $row1['total_amount']  ?></td>
                                                                        <td></td>
                                                                    </tfoot>
                                                                </table>
                                                                <input type="hidden" id="total_amount" name="total_amount"  value="<?php echo $row1['total_amount']  ?>">
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="col-md-6 form-label" for="Order">Delivery Date:</label>
                                                <input type="date" class="form-control" name="ddate" id="ddate" placeholder="Enter Delivery Date" value="<?php echo $row1['delivery_date']  ?>" required>
                                            <!-- &nbsp; -->
                                            <label class="col-md-6 form-label" for="Order">Delivery Time:</label>
                                                <input type="time" class="form-control" name="dtime" id="dtime" placeholder="Enter Delivery Time" value="<?php echo $row1['delivery_time']  ?>" required>
                                                <label class="col-md-6 form-label" for="Order">Google Map Location <Link:touch></Link:touch>:</label>
                                                <input type="text" class="form-control" name="dgoogle" id="dgoogle" placeholder="Enter Google Map Location" value="<?php echo $row1['gmaplocation']  ?>" required>
                                            
                                            
                                            </div>
                                           
                                            <div class="col-md-6 mb-4">
                                                <label class="col-md-13 form-label" for="Order">Additional Location </label>
                                                <textarea class="form-control" name="addlocation" id="addlocation" placeholder="Enter Additional Location Details If any" rows="7"><?php echo $row1['additinal_location']  ?></textarea>

                                            </div>

                                            <div class="col-md-12 mb-4">
                                                <div class="card custom-card"  style="border: 1.5px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 1, 1, 0.1);">
                                                    <div class="card-header justify-content-between">
                                                        <div class="card-title">
                                                            Add Payment Details Here
                                                        </div>
                                                    </div>
                                                    <div class="card-body d-sm-flex align-items-center justify-content-between">


                                                        <div class="row mb-4">

                                                            
                                                            <div class="col-md-3">
                                                                <label class="form-label" for="staff">Payment Type:</label>
                                                                <select class="form-select mb-3" aria-label="Default select example" name="ptype" id="ptype" required>
                                                                    <option value="" disabled selected>Select Payment Type</option>
                                                                   
                                                                    <option value="Advance Payment">Advance Payment</option>
                                                                    <option value="Intrim Payment">Intrim Payment</option>
                                                                    <option value="Final Payment">Final Payment</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label" for="staff">Mod of Pay:</label>
                                                                <select class="form-select mb-3" aria-label="Default select example" name="modofpay" id="modofpay" required>
                                                                    <option value="" disabled selected>Select Payment Type</option>
                                                                   
                                                                        <option value="Cash" data-questions="Cash">Cash</option>
                                                                        <option value="Gpay" data-questions="Gpay">Gpay</option>
                                                                        <option value="Bank Transfer" data-questions="Bank Transfer">Bank Transfer</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-label" for="deadline">Amount</label>
                                                                <input type="number" class="form-control" id="paytotal" name="paytotal" placeholder="Total Amount" required>

                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-label" for="Order">Paid Date:</label>
                                                                <input type="date" class="form-control" name="pdate" id="pdate" placeholder="Enter Paid Date" required>
                                                            </div>
                                                                            
                                                            <div class="col-md-2">
                                                                <label class="form-label" for="dept" style="color:transparent">Transparent Label :</label>
                                                                <button type="button" name="submit" class="btn btn-primary" onclick="addPayment()" style="color:white;cursor:pointer;">Add Payment</button>

                                                            </div>
                                                            <hr>

                                                            <div class="table-responsive">

                                                                <table class="table table-bordered mg-b-0" id="paymentTable">
                                                                    <thead>
                                                                        <tr style="background-color: #add8e6;">
                                                                            <th>#</th>
                                                                            <th>Payment Type</th>
                                                                           
                                                                            <th>Mode of Pay</th>
                                                                            <th>Amount Paid</th>
                                                                            <th>Paid Date </th>
                                                                            
                                                                            <th>Action</th>
                                                                            <!-- class="hidden-cell" -->
                                                                            <th class="hidden-cell">status</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="ajaxpaymentresults">
                                                                    <?php

                                                                    $querypay = "select * from order_payments where order_id ='" . $the_cat_id . "'";
                                                                    $select_postspay = mysqli_query($connection, $querypay);
                                                                    $r = 0;
                                                                    while ($rowpay = mysqli_fetch_assoc($select_postspay)) {
                                                                        $r = $r + 1;
                                                                        $rowId1 = "row1_" . round(microtime(true) * 1000);
                                                                    ?>
                                                                        <tr data-rowid="<?php echo $rowId1; ?>">
                                                                            <td><?php echo $r; ?></td>
                                                                            <td><?php echo $rowpay['payment_type']; ?></td>
                                                                            <td><?php echo $rowpay['mod_of_pay']; ?></td>
                                                                            <td><?php echo $rowpay['paid_amount']; ?></td>
                                                                            <td><?php echo $rowpay['paid_date']; ?></td>
                                                                            <td><a class='btn btn-sm btn-primary edit-pay-btn'  data-bs-target='#paymentmodal' data-bs-toggle='modal' title='Edit' style='color:white'>
                                                                                <span class='fe fe-edit'> </span></a>&nbsp;&nbsp;
                                                                                    <a class='btn btn-sm btn-danger delete-pay-btn'  id='qusdelete' title='Delete' data-toggle='tooltip' style='color:white'>
                                                                                <span class='fe fe-trash-2'> </span></a></td>
                                                                                <!-- -->
                                                                            <td class="hidden-cell">Saved</td>
                                                                            <td class="hidden-cell"><?php echo $rowpay['id']; ?></td>
                                                                        </tr>

                                                                    <?php } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6 mb-4">
                                                <label class="col-md-6 form-label" for="Order">Container / Assets Supplied:</label>
                                                <input type="text" class="form-control" name="dassets" id="dassets" value="<?php echo $row1['containers']  ?>" placeholder="Enter Description of assets supplied if any">

                                            </div>

                                            <div class="col-md-3 mb-4">
                                                <label class="col-md-6 form-label" for="Order">Check Assets:</label>
                                                <input class="form-check-input" type="radio" name="Radio" id="Radio-sm" <?php if ($row1['container_status']=='Dispatched'){?> Checked <?php } ?> value="Dispatched">
                                                <label class="form-check-label" for="Radio-sm">
                                                    Dispatched
                                                </label>&nbsp;&nbsp;
                                                <input class="form-check-input" type="radio" name="Radio" id="Radio-md" <?php if ($row1['container_status']=='Regained'){?> Checked <?php } ?> value="Regained">
                                                <label class="form-check-label" for="Radio-md">
                                                    Regained
                                                </label>
                                            </div>

                                            <div class="col-md-3 mb-4">
                                                <label class="col-md-12 form-label" for="status">Status :</label>
                                                <select name="status" id="status" class="form-control form-select select2" data-bs-placeholder="Select Status" required>
                                                    <option value="<?php echo $row1['status'] ?>"><?php echo $row1['status'] ?></option>
                                                    <option value="Active">Active</option>
                                                    <option value="Inactive">Inactive</option>

                                                </select>
                                            </div>

                                        </div>




                                        <!-- ================================================================== -->






                                    </div>
                                    <div class="card-footer">
                                        <!--Row-->
                                        <div class="row">
                                            <div class="col-md-3"></div>
                                            <div class="col-md-9">
                                                <button type="submit" name="submit" class="btn btn-primary" onclick="saveDataToDatabase()" style="color:white;cursor:pointer;">Update Order</button>
                                                <a href="javascript:void(0)" class="btn btn-default float-end" id="cancel">Discard</a>
                                            </div>
                                        </div>
                                        <!--End Row-->
                                    </div>

                                  
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /ROW-1 CLOSED -->
                </div>
            </div>
        </div>
        <!-- End Main Content-->

<!-- ========================modals======================== -->
 <!-- Basic modal -->
        <div class="modal fade" id="suppliermodal">
            <div class="modal-dialog" role="document">
                <div class="modal-content modal-content-demo">
                    <div class="modal-header">
                        <h6 class="modal-title">Edit Product Details -</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <input type="hidden" class="form-control" id="modalrowid" name="modalrowid" required>
                     
                            <div class="col-md-6">
                                <label class="form-label" for="modalpname">Product Name :</label>
                                <input type="text" class="form-control" id="modalpname" name="modalpname" placeholder="Product Name" required readonly>
                                <input type="text" class="form-control" id="modalpid" name="modalpid" placeholder="Product Name" required readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="modalqty">Quantity :</label>
                                <input type="number" class="form-control" id="modalqty" name="modalqty" placeholder="Quantity" required>

                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="modalmrp">MRP :</label>
                                <input type="text" class="form-control" id="modalmrp" name="modalmrp" placeholder="MRP" required>

                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="modalgst">GST (5%) :</label>
                                <input type="text" class="form-control" id="modalgst" name="modalgst" placeholder="GST Amount" required readonly>

                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="modaltotal">Total :</label>
                                <input type="text" class="form-control" id="modaltotal" name="modaltotal" placeholder="Total Amount" required readonly>

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn ripple btn-primary" id="saveChangesBtn" type="button">Save changes</button>
                        <button class="btn ripple btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Basic modal -->
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
                                <label class="form-label" for="paytype">Payment Type :</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="modalpaytype" id="modalpaytype" required>
                                    <option value="" disabled selected>Select Payment Type</option>
                                    <option value="Advance Payment">Advance Payment</option>
                                    <option value="Intrim Payment">Intrim Payment</option>
                                    <option value="Final Payment">Final Payment</option>

                                </select>
                            </div>


                            <div class="col-md-6">
                                <label class="form-label" for="paymenttransmode">Transaction Mode :</label>
                                <select class="form-select mb-3" aria-label="Default select example" name="modalpaymenttransmode" id="modalpaymenttransmode" required>
                                    <option value="" disabled selected>Select Transaction Mode</option>
                                    <option value="Cash" data-questions="Cash">Cash</option>
                                                                        <option value="Gpay" data-questions="Gpay">Gpay</option>
                                                                        <option value="Bank Transfer" data-questions="Bank Transfer">Bank Transfer</option>
                                </select>
                            </div>
                         
                            <div class="col-md-6">
                                <label class="form-label" for="paymentamt">Payment Amount :</label>
                                <input type="number" class="form-control" id="modalpaymentamt" name="modalpaymentamt" placeholder="Payment Amount" required>

                            </div>

                          
                            <div class="col-md-6">
                                <label class="form-label" for="paycustbillno">Date of Pay :</label>
                                <input type="date" class="form-control" id="modalcuspayDate" name="modalcuspayDate" placeholder="Customer Pay Date" required>

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

        <!-- =================================modals ================ -->

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

    <!-- Perfect-scrollbar js-->
    <script src="assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/p-scroll-1.js"></script>

    <!-- Sidemenu js-->
    <script src="assets/plugins/sidemenu/sidemenu.js"></script>

    <!-- Sidebar js-->
    <script src="assets/plugins/sidebar/sidebar.js"></script>

   

    <!-- Sticky js-->
    <script src="assets/js/sticky.js"></script>

    <!-- Custom js-->
    <script src="assets/js/custom.js"></script>

    <!-- Switcher js -->
    <script src="assets/switcher/js/switcher.js"></script>
   
    <script src="edit-orders.js"></script>
    <script>
      $(document).ready(function(e) {
            $('#cancel').delegate('', 'click change', function() {
                window.location = "orderslist.php";
                return false;
            });
        });

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
    <script>
$(document).ready(function() {
    function calculateGST() {
        let mrp = parseFloat($('#modalmrp').val());
        let qty = parseInt($('#modalqty').val());

        if (!isNaN(mrp) && !isNaN(qty)) {
            let gst = (mrp * qty * 100) / 105;
            let total = mrp * qty;

            $('#modalgst').val(gst.toFixed(2));
            $('#modaltotal').val(total.toFixed(2));
        } else {
            $('#modalgst').val('');
            $('#modaltotal').val('');
        }
    }

    $('#modalmrp, #modalqty').on('change', calculateGST);
});
</script>

   
</body>

</html>
<?php }} ?>