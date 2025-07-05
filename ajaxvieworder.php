<?php

include "includes/connection.php";
$recordId = $_POST["fname"];

$query = "select * from orders where id ='" . $recordId . "'";
$select_posts = mysqli_query($connection, $query);
$i = 0;
while ($row = mysqli_fetch_assoc($select_posts)) {
    $id = $row['id'];
    $post_title = $row['custid'];
    $post_custname = "";
    $post_address = "";
    $post_contactno = "";
    $querycust = "select * from customers where id ='" . $post_title . "'";
    $select_postscust = mysqli_query($connection, $querycust);
    while ($rowcust = mysqli_fetch_assoc($select_postscust)) {
        $post_custname = $rowcust['name'];
        $post_address = $rowcust['address'];
        $post_contactno = $rowcust['contactno'];
        $post_email = $rowcust['email'];
    }
    $post_delivery_date = $row['delivery_date'];
    $post_delivery_time = $row['delivery_time'];
    $post_order_date = $row['order_date'];
    $post_total_amount = $row['total_amount'];

    $post_addcontact = $row['additional_contact'];
    $post_additinal_location = $row['additinal_location'];
?>
    <div class="row">
        <div class="col-md-4">
            <strong>Customer Name : </strong> <?php echo $post_custname; ?><br>
            <strong>Address : </strong> <?php echo $post_address; ?><br>
            <strong>Contact No : </strong> <?php echo $post_contactno; ?><br>
            <strong>Customer Email : </strong> <?php echo $post_email; ?>
        </div>
        <div class="col-md-4">
            <strong>Additional Contact Info : </strong> <?php echo $post_addcontact; ?><br>
            <strong>Additional Location[If any] : </strong> <?php echo $post_additinal_location; ?>
        </div>
        <div class="col-md-4" style="padding-bottom: 50px;">
            <strong>Delivery Date & time : </strong> <?php echo $post_delivery_date;  ?>&nbsp;&nbsp; <?php echo $post_delivery_time;  ?><br>
            <strong>Order Date : </strong> <?php echo $post_order_date; ?><br>
            <strong>Total Amount : </strong> <?php echo $post_total_amount; ?><br>

        </div><br><br><br>

        <div class="col-md-12">
            <div class="table-responsive">
                <h3>Product Details</h3>
                <table class="table table-bordered mg-b-0">
                    <thead>
                        <tr style="background-color: #add8e6;">
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Qty</th>
                            <th>Selling Price</th>
                            <th>GST </th>
                            <th>Total</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $queryproduct = "select * from order_products where order_id ='" . $recordId . "'";
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


                        ?>
                            <tr>
                                <td><?php echo $r; ?></td>
                                <td><?php echo $productname; ?></td>
                                <td><?php echo $rowproduct['qty']; ?></td>
                                <td><?php echo $rowproduct['mrp']; ?></td>
                                <td><?php echo $rowproduct['gst']; ?></td>
                                <td><?php echo $rowproduct['total']; ?></td>
                            </tr>

                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <td colspan="2">Total</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td><?php echo $row['total_amount']; ?></td>

                    </tfoot>
                </table>

            </div>
        </div>
        <div class="col-md-12" style="padding-bottom: 50px;">
            <div class="table-responsive">
                <h3>Payment Details</h3>
                <table class="table table-bordered mg-b-0">
                    <thead>
                        <tr style="background-color: #add8e6;">
                            <th>#</th>
                            <th>Payment Type</th>

                            <th>Mode of Pay</th>
                            <th>Amount Paid</th>
                            <th>Paid Date </th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $querypay = "select * from order_payments where order_id ='" . $recordId . "'";
                        $select_postspay = mysqli_query($connection, $querypay);
                        $r = 0;
                        while ($rowpay = mysqli_fetch_assoc($select_postspay)) {
                            $r = $r + 1;

                        ?>
                            <tr>
                                <td><?php echo $r; ?></td>
                                <td><?php echo $rowpay['payment_type']; ?></td>
                                <td><?php echo $rowpay['mod_of_pay']; ?></td>
                                <td><?php echo $rowpay['paid_amount']; ?></td>
                                <td><?php echo $rowpay['paid_date']; ?></td>
                            </tr>

                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>


    </div>

<?php } ?>