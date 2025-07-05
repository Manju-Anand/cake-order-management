<?php
// Example connection parameters; replace with your actual database credentials
include "includes/connection.php";

// Get the data sent from the client
$data = json_decode(file_get_contents("php://input"), true);
// ====================== delete already entered data =============
$editid = $data['editid'];

if (isset($data['followupdataToSave'])) {
    $updateOrderStmt = $connection->prepare("UPDATE orders SET custid=?, additional_contact=?, order_date=?, delivery_date=?, delivery_time=?, additinal_location=?, containers=?, container_status=?, status=?, modified=?, total_amount=?, orderType=?, branch=?, gmaplocation=? WHERE id=?");

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
        $postdate = date("M d, Y h:i:s a");

        $updateOrderStmt->bind_param('ssssssssssssssi', $custname, $cinfo, $odate, $ddate, $dtime, $addlocation, $dassets, $selectedValue, $status, $postdate, $totamt, $ordertype, $branch, $dgoogle, $editid);

        if (!$updateOrderStmt->execute()) {
            echo "Error: " . $updateOrderStmt->error;
        }
    }
}

if (isset($data['supplierdataToSave'])) {
    $updateProductStmt = $connection->prepare("UPDATE order_products SET product_id=?, qty=?, mrp=?, gst=?, total=? WHERE id=?");
    $insertProductStmt = $connection->prepare("INSERT INTO order_products (product_id, qty, mrp, gst, total, order_id) VALUES (?, ?, ?, ?, ?, ?)");

    foreach ($data['supplierdataToSave'] as $row) {
        $pid = $row['pid'];
        $qty = $row['qty'];
        $mrp = $row['mrp'];
        $gst = $row['gst'];
        $total = $row['total'];
        $paystatus = $row['payStatus'];
        $productid = $row['productid'];

        if ($paystatus == "Edited") {
            $updateProductStmt->bind_param('sssssi', $pid, $qty, $mrp, $gst, $total, $productid);
            if (!$updateProductStmt->execute()) {
                echo "Error: " . $updateProductStmt->error;
            }
        } elseif ($paystatus == "New") {
            $insertProductStmt->bind_param('sssssi', $pid, $qty, $mrp, $gst, $total, $editid);
            if (!$insertProductStmt->execute()) {
                echo "Error: " . $insertProductStmt->error;
            }
        }
    }
}

if (isset($data['paymentdataToSave'])) {
    $updatePaymentStmt = $connection->prepare("UPDATE order_payments SET payment_type=?, mod_of_pay=?, paid_amount=?, paid_date=? WHERE id=?");
    $insertPaymentStmt = $connection->prepare("INSERT INTO order_payments (order_id, payment_type, mod_of_pay, paid_amount, paid_date) VALUES (?, ?, ?, ?, ?)");

    foreach ($data['paymentdataToSave'] as $row) {
        $paymentType = $row['PaymentType'];
        $transactionMode = $row['TransactionMode'];
        $paymentAmount = $row['PaymentAmount'];
        $cuspayDate = $row['cuspayDate'];
        $payStatus = $row['payStatus'];
        $paymentid = $row['paymentid'];

        if ($payStatus == "Edited") {
            echo "Pay Status - edited";
            $updatePaymentStmt->bind_param('ssssi', $paymentType, $transactionMode, $paymentAmount, $cuspayDate, $paymentid);
            if (!$updatePaymentStmt->execute()) {
                echo "Error: " . $updatePaymentStmt->error;
            }
        } elseif ($payStatus == "New") {
            echo "Pay Status - New";
            $insertPaymentStmt->bind_param('issss', $editid, $paymentType, $transactionMode, $paymentAmount, $cuspayDate);
            if (!$insertPaymentStmt->execute()) {
                echo "Error: " . $insertPaymentStmt->error;
            }
        }
    }
}

// Close the prepared statements
$updateOrderStmt->close();
if (isset($updateProductStmt)) $updateProductStmt->close();
if (isset($insertProductStmt)) $insertProductStmt->close();
if (isset($updatePaymentStmt)) $updatePaymentStmt->close();
if (isset($insertPaymentStmt)) $insertPaymentStmt->close();

// Close the database connection
$connection->close();
?>
