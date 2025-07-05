<?php
// Example connection parameters; replace with your actual database credentials
include "includes/connection.php";

// Get the data sent from the client
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['followupdataToSave'])) {
    $connection->begin_transaction();
    try {
        $orderStmt = $connection->prepare("INSERT INTO orders(custid, additional_contact, order_date, delivery_date, delivery_time, additinal_location, containers, container_status, status, created, modified, total_amount, orderType, branch, gmaplocation) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
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

            $orderStmt->bind_param('sssssssssssssss', $custname, $cinfo, $odate, $ddate, $dtime, $addlocation, $dassets, $selectedValue, $status, $postdate, $postdate, $totamt, $ordertype, $branch, $dgoogle);

            if (!$orderStmt->execute()) {
                throw new Exception("Order Insert Error: " . $orderStmt->error);
            }
            
            $last_id = $connection->insert_id;

            $productStmt = $connection->prepare("INSERT INTO order_products(product_id, qty, mrp, gst, total, order_id) VALUES (?, ?, ?, ?, ?, ?)");
            
            foreach ($data['supplierdataToSave'] as $productRow) {
                $pid = $productRow['pid'];
                $qty = $productRow['qty'];
                $mrp = $productRow['mrp'];
                $gst = $productRow['gst'];
                $total = $productRow['total'];

                $productStmt->bind_param('sssssi', $pid, $qty, $mrp, $gst, $total, $last_id);

                if (!$productStmt->execute()) {
                    throw new Exception("Product Insert Error: " . $productStmt->error);
                }
            }

            if (isset($data['paymentdataToSave'])) {
                $paymentStmt = $connection->prepare("INSERT INTO order_payments(order_id, payment_type, mod_of_pay, paid_amount, paid_date) VALUES (?, ?, ?, ?, ?)");

                foreach ($data['paymentdataToSave'] as $paymentRow) {
                    $paymentType = $paymentRow['PaymentType'];
                    $transactionMode = $paymentRow['TransactionMode'];
                    $paymentAmount = $paymentRow['PaymentAmount'];
                    $cuspayDate = $paymentRow['cuspayDate'];

                    $paymentStmt->bind_param('issss', $last_id, $paymentType, $transactionMode, $paymentAmount, $cuspayDate);

                    if (!$paymentStmt->execute()) {
                        throw new Exception("Payment Insert Error: " . $paymentStmt->error);
                    }
                }
            }
        }

        $connection->commit();
    } catch (Exception $e) {
        $connection->rollback();
        echo "Error: " . $e->getMessage();
    }

    $orderStmt->close();
    if (isset($productStmt)) $productStmt->close();
    if (isset($paymentStmt)) $paymentStmt->close();
}

// Close the database connection
$connection->close();
?>
