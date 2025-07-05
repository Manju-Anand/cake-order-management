<?php
// Example connection parameters; replace with your actual database credentials
include "includes/connection.php";

// Get the data sent from the client
$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['followupdataToSave'])) {
    $connection->begin_transaction();
    try {
        $custStmt = $connection->prepare("INSERT INTO customers(name,address,contactno,email,landmark,status,created,modified, dob, anniversaryDate, custRemarks) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        foreach ($data['followupdataToSave'] as $row) {
            $custname = $row['custname'];
            $cadd = $row['cadd'];
            $cphoneno = $row['cphoneno'];
            $cemail = $row['cemail'];
            $landmark = $row['landmark'];
            $status = $row['status'];

            $cremarks = $row['cremarks'];
            $cdob = $row['cdob'];
            $canndate = $row['canndate'];
           
            date_default_timezone_set("Asia/Calcutta");
            $postdate = date("M d, Y h:i:s a");

            $custStmt->bind_param('sssssssssss', $custname, $cadd, $cphoneno, $cemail, $landmark, $status, $postdate, $postdate, $cdob, $canndate, $cremarks);

            if (!$custStmt->execute()) {
                throw new Exception("Order Insert Error: " . $custStmt->error);
            }
            
            $last_id = $connection->insert_id;

            $productStmt = $connection->prepare("INSERT INTO crelatives(custid, relation, rname, rage, rdob) VALUES (?, ?, ?, ?, ?)");
            
            foreach ($data['supplierdataToSave'] as $productRow) {
                $prelation = $productRow['prelation'];
                $pname = $productRow['pname'];
                $page = $productRow['page'];
                $pdob = $productRow['pdob'];
                $payStatus = $productRow['payStatus'];

                $productStmt->bind_param('sssss', $last_id, $prelation, $pname, $page, $pdob);

                if (!$productStmt->execute()) {
                    throw new Exception("Product Insert Error: " . $productStmt->error);
                }
            }


        }

        $connection->commit();
    } catch (Exception $e) {
        $connection->rollback();
        echo "Error: " . $e->getMessage();
    }

    $custStmt->close();
    if (isset($productStmt)) $productStmt->close();
    if (isset($custStmt)) $custStmt->close();
}

// Close the database connection
$connection->close();
?>
