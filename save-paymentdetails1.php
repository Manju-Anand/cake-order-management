<?php
// Example connection parameters; replace with your actual database credentials
include "includes/connection.php";

// Get the data sent from the client
$data = json_decode(file_get_contents("php://input"), true);
// ======================== ======================
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

    $sql="INSERT INTO orders( custid, additional_contact, order_date, delivery_date, delivery_time, additinal_location, containers,
    container_status, status, created, modified, total_amount,orderType,branch,gmaplocation) VALUES ('{$custname}','{$cinfo}','{$odate}','{$ddate}'
    ,'{$dtime}','{$addlocation}','{$dassets}','{$selectedValue}','{$status}','{$postdate}','{$postdate}','{$totamt}',
    '{$ordertype}','{$branch}','{$dgoogle}')";
        
    if ($connection->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $connection->error;
    } else {
      $last_id = $connection->insert_id;

          // Iterate through the data and insert into the database
          foreach ($data['supplierdataToSave'] as $row) {
            $pname = $row['pname'];
            $pid = $row['pid'];
            $qty = $row['qty'];
            $mrp = $row['mrp'];
            $gst = $row['gst'];
            $total = $row['total'];
           
            date_default_timezone_set("Asia/Calcutta");
            $postdate = date("M d,Y h:i:s a");

            $sql="INSERT INTO order_products(product_id, qty, mrp, gst, total, order_id) 
            VALUES ('{$pid}','{$qty}','{$mrp}','{$gst}','{$total}','{$last_id}')";

                if ($connection->query($sql) !== TRUE) {
                  
                  echo "Error: " . $sql . "<br>" . $connection->error;
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


                $postdate = date("M d,Y h:i:s a");

                $sqlPayment="INSERT INTO order_payments( order_id, payment_type, mod_of_pay, paid_amount, paid_date)
                 VALUES ('{$last_id}','{$paymentType}','{$transactionMode}','{$paymentAmount}','{$cuspayDate}')";
                // if ($payStatus !== "Saved") {
                // Perform the SQL query to insert data into the second table (payment_customer)
               
                if ($connection->query($sqlPayment) !== TRUE) {
                    echo "Error: " . $sqlPayment . "<br>" . $connection->error;
                }
              // }
            }
          }




    }

}
}












// Close the database connection
$connection->close();
?>
