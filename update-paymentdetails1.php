<?php
// Example connection parameters; replace with your actual database credentials
include "includes/connection.php";

// Get the data sent from the client
$data = json_decode(file_get_contents("php://input"), true);
// ====================== delete already entered datas =============
$editid = $data['editid'];


// ====================== delete already entered datas =============
if (isset($data['followupdataToSave'])) {
  foreach ($data['followupdataToSave'] as $row) {
    $custname = $row['custname'];
    $odate = $row['odate'];
    $cinfo = $row['cinfo'];
    $ddate = $row['ddate'];
    $dtime = $row['dtime'];
    $addlocation = $row['addlocation'];
    $dassets = $row['dassets'];
    $selectedValue = $row['selectedValue'];
    $status = $row['status'];
    $totamt = $row['totamt'];
    $ordertype = $row['ordertype'];
    $branch = $row['branch'];
    $dgoogle = $row['dgoogle'];

    date_default_timezone_set("Asia/Calcutta");
    $postdate = date("M d,Y h:i:s a");


    $sql = "UPDATE orders SET custid='{$custname}',additional_contact='{$cinfo}',order_date='{$odate}',delivery_date='{$ddate}',delivery_time='{$dtime}',
    additinal_location='{$addlocation}',containers='{$dassets}',container_status='{$selectedValue}',status='{$status}',modified='{$postdate}',
    total_amount='{$totamt}',orderType='{$ordertype}' ,branch='{$branch}', gmaplocation='{$dgoogle}'  WHERE id='" . $editid . "'";



    if ($connection->query($sql) !== TRUE) {
      echo "Error: " . $sql . "<br>" . $connection->error;
    } else {
    }
  }
}

if (isset($data['supplierdataToSave'])) {
  // Iterate through the data and insert into the database
  foreach ($data['supplierdataToSave'] as $row) {
    $pname = $row['pname'];
    $pid = $row['pid'];
    $qty = $row['qty'];
    $mrp = $row['mrp'];
    $gst = $row['gst'];
    $total = $row['total'];
    $paystatus = $row['payStatus'];
    $productid = $row['productid'];

    if ($paystatus == "Edited") {
      $sql = "UPDATE order_products SET product_id='{$pid}',qty='{$qty}',mrp='{$mrp}',gst='{$gst}',total='{$total}'  WHERE id='" . $productid . "'";
    } elseif ($paystatus == "New") {
      $sql = "INSERT INTO order_products(product_id, qty, mrp, gst, total, order_id) VALUES ('{$pid}','{$qty}','{$mrp}','{$gst}','{$total}','{$editid}')";
    }
    if ($connection->query($sql) !== TRUE) {
      echo "Error: " . $sql . "<br>" . $connection->error;
    }
  }
}

// If you have a second table (payment_data), handle its data
if (isset($data['paymentdataToSave'])) {
  foreach ($data['paymentdataToSave'] as $row) {

    $paymentType = $row['PaymentType'];
    $transactionMode = $row['TransactionMode'];
    $paymentAmount = $row['PaymentAmount'];
    $cuspayDate = $row['cuspayDate'];
    $payStatus = $row['payStatus'];
    $paymentid = $row['paymentid'];
    if ($payStatus == "Edited") {
      echo "Pay Status- edited";
      $sqlPayment = "UPDATE order_payments SET payment_type='{$paymentType}',mod_of_pay='{$transactionMode}',paid_amount='{$paymentAmount}',
                  paid_date='{$cuspayDate}' WHERE id='" . $paymentid . "'";
                      if ($connection->query($sqlPayment) !== TRUE) {
                        echo "Error: " . $sqlPayment . "<br>" . $connection->error;
                      }
    } elseif ($payStatus == "New") {
      echo "Pay Status- New";
      $sqlPayment = "INSERT INTO order_payments( order_id, payment_type, mod_of_pay, paid_amount, paid_date)
                 VALUES ('{$editid}','{$paymentType}','{$transactionMode}','{$paymentAmount}','{$cuspayDate}')";
                     if ($connection->query($sqlPayment) !== TRUE) {
                      echo "Error: " . $sqlPayment . "<br>" . $connection->error;
                    }
    }
  


   
  }
}



// Close the database connection
$connection->close();
