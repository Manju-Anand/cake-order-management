<?php
// Example connection parameters; replace with your actual database credentials
include "includes/connection.php";

// Get the data sent from the client
$data = json_decode(file_get_contents("php://input"), true);
// ====================== delete already entered data =============
$editid = $data['editid'];

if (isset($data['followupdataToSave'])) {
    $updateOrderStmt = $connection->prepare("UPDATE customers SET name=?, address=?, contactno=?, email=?, landmark=?, status=?, modified=?, dob=?, anniversaryDate=?, custRemarks=?
      WHERE id=?");

    foreach ($data['followupdataToSave'] as $row) {
        $custname = $row['custname'];
        $cadd = $row['cadd'];
        $cphoneno = $row['cphoneno'];
        $cemail = $row['cemail'];
        $landmark = $row['landmark'];
        $status = $row['status'];
        $dob = $row['cdob'];
        $anniversaryDate = $row['canndate'];
        $custRemarks = $row['cremarks'];
      
        date_default_timezone_set("Asia/Calcutta");
        $postdate = date("M d, Y h:i:s a");

        $updateOrderStmt->bind_param('ssssssssssi', $custname, $cadd, $cphoneno, $cemail, $landmark, $status, $postdate, $dob, $anniversaryDate, $custRemarks,$editid);

        if (!$updateOrderStmt->execute()) {
            echo "Error: " . $updateOrderStmt->error;
        }
    }
}

if (isset($data['supplierdataToSave'])) {
    $updateProductStmt = $connection->prepare("UPDATE crelatives SET relation=?, rname=?, rage=?, rdob=? WHERE id=?");
    $insertProductStmt = $connection->prepare("INSERT INTO crelatives (custid, relation, rname, rage, rdob) VALUES (?, ?, ?, ?, ?)");

    foreach ($data['supplierdataToSave'] as $row) {
        $prelation = $row['prelation'];
        $pname = $row['pname'];
        $page = $row['page'];
        $pdob = $row['pdob'];
       
        $paystatus = $row['payStatus'];
        $precordid = $row['precordid'];

        if ($paystatus == "Edited") {
            $updateProductStmt->bind_param('ssssi', $prelation, $pname, $page, $pdob, $precordid);
            if (!$updateProductStmt->execute()) {
                echo "Error: " . $updateProductStmt->error;
            }
        } elseif ($paystatus == "New") {
            $insertProductStmt->bind_param('issss', $editid, $prelation, $pname, $page, $pdob);
            if (!$insertProductStmt->execute()) {
                echo "Error: " . $insertProductStmt->error;
            }
        }
    }
}



// Close the prepared statements
$updateOrderStmt->close();
if (isset($updateProductStmt)) $updateProductStmt->close();
if (isset($insertProductStmt)) $insertProductStmt->close();


// Close the database connection
$connection->close();
?>
