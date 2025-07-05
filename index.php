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
$totproducts=0;
$totcustomers=0;
$totOrders=0;

$sql = "SELECT * FROM products";
$result = $connection->query($sql);
if ($result->num_rows > 0) {
	$totproducts=$result->num_rows;
}

$sql = "SELECT * FROM customers";
$result = $connection->query($sql);
if ($result->num_rows > 0) {
	$totcustomers=$result->num_rows;
}

$sql = "SELECT * FROM orders";
$result = $connection->query($sql);
if ($result->num_rows > 0) {
	$totOrders=$result->num_rows;
}

function showcustomer()
{
    global $connection;
    $query = "select * from orders order by id desc";
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
           
            $post_contactno = $rowcust['contactno'];
        }



        $post_container_status = $row['container_status'];
        $post_containers = $row['containers'];
       
        $post_order_date = $row['order_date'];
       
        if ($post_containers !== "") {
            $i = $i + 1;
            echo "<tr>";
            echo "<td>$i</td>";
            echo "<td>$post_custname</td>";
            echo "<td>$post_contactno</td>";
            echo "<td>$post_order_date</td>";
            echo "<td>$post_containers</td>";
            if ($post_container_status == "Regained") {

            echo "<td style='font-size:20px'><span class='badge bg-success'>$post_container_status</span></td>";
            }
            if ($post_container_status == "Dispatched") {

                echo "<td style='font-size:20px'><span class='badge bg-danger'>$post_container_status</span></td>";
                }

          


            echo "</tr>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
<!-- 782d90 -->
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="keywords"
		content="">

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
					<!-- Page Header -->
					<div class="page-header">
						<div>
							<h2 class="main-content-title tx-24 mg-b-5">Welcome To Dashboard</h2>

                            <?php
							//  echo "id : " . $_SESSION['adminid'] . ' , ' . $_SESSION['adminname'];
							  ?>

							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
								<li class="breadcrumb-item active" aria-current="page">Admin Dashboard</li>
							</ol>
						</div>
						<div class="d-flex">
							<div class="me-2">
								<!-- <a class="btn ripple btn-primary dropdown-toggle mb-0"
									href="javascript:void(0);" data-bs-toggle="dropdown" aria-haspopup="true"
									aria-expanded="true">
									<i class="fe fe-external-link"></i> Export <i class="fa fa-caret-down ms-1"></i>
								</a> -->
								<!-- <div class="dropdown-menu tx-13">
									<a class="dropdown-item" href="javascript:void(0);"><i
											class="fa fa-file-pdf-o me-2"></i>Export as
										Pdf</a>
									<a class="dropdown-item" href="javascript:void(0);"><i
											class="fa fa-image me-2"></i>Export as
										Image</a>
									<a class="dropdown-item" href="javascript:void(0);"><i
											class="fa fa-file-excel-o me-2"></i>Export as
										Excel</a>
								</div> -->
							</div>
							<div>
								<!-- <a href="javascript:void(0);"
									class="btn ripple btn-secondary navresponsive-toggler mb-0"
									data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
									aria-controls="navbarSupportedContent" aria-expanded="false"
									aria-label="Toggle navigation">
									<i class="fe fe-filter me-1"></i> Filter <i class="fa fa-caret-down ms-1"></i>
								</a> -->
							</div>
						</div>
					</div>
					<!-- End Page Header -->

					<!--Navbar-->
					<div class="responsive-background">
						<div class="collapse navbar-collapse" id="navbarSupportedContent">
							<div class="advanced-search br-3">
								<div class="row align-items-center">
									<div class="col-md-12 col-xl-4">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group mb-lg-0">
													<label>From :</label>
													<div class="input-group">
														<div class="input-group-text">
															<i class="fe fe-calendar lh--9 op-6"></i>
														</div><input class="form-control fc-datepicker"
															placeholder="11/01/2019" type="text">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group mb-lg-0">
													<label>To :</label>
													<div class="input-group">
														<div class="input-group-text">
															<i class="fe fe-calendar lh--9 op-6"></i>
														</div><input class="form-control fc-datepicker"
															placeholder="11/08/2019" type="text">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6 col-xl-3">
										<div class="form-group mb-lg-0">
											<label>Sales By Country :</label>
											<select class="form-control select2-flag-search select2"
												data-placeholder="Select Contry">
												<option value="AF">Afghanistan</option>
												<option value="AL">Albania</option>
												<option value="AD">Andorra</option>
												<option value="AG">Antigua and Barbuda</option>
												<option value="AU">Australia</option>
												<option value="AM">Armenia</option>
												<option value="AO">Angola</option>
												<option value="AR">Argentina</option>
												<option value="AT">Austria</option>
												<option value="AZ">Azerbaijan</option>
												<option value="BA">Bosnia and Herzegovina</option>
												<option value="BB">Barbados</option>
												<option value="BD">Bangladesh</option>
												<option value="BE">Belgium</option>
												<option value="BF">Burkina Faso</option>
												<option value="BG">Bulgaria</option>
												<option value="BH">Bahrain</option>
												<option value="BJ">Benin</option>
												<option value="BN">Brunei</option>
												<option value="BO">Bolivia</option>
												<option value="BT">Bhutan</option>
												<option value="BY">Belarus</option>
												<option value="CD">Congo</option>
												<option value="CA">Canada</option>
												<option value="CF">Central African Republic</option>
												<option value="CI">Cote d'Ivoire</option>
												<option value="CL">Chile</option>
												<option value="CM">Cameroon</option>
												<option value="CN">China</option>
												<option value="CO">Colombia</option>
												<option value="CU">Cuba</option>
												<option value="CV">Cabo Verde</option>
												<option value="CY">Cyprus</option>
												<option value="DJ">Djibouti</option>
												<option value="DK">Denmark</option>
												<option value="DM">Dominica</option>
												<option value="DO">Dominican Republic</option>
												<option value="EC">Ecuador</option>
												<option value="EE">Estonia</option>
												<option value="ER">Eritrea</option>
												<option value="ET">Ethiopia</option>
												<option value="FI">Finland</option>
												<option value="FJ">Fiji</option>
												<option value="FR">France</option>
												<option value="GA">Gabon</option>
												<option value="GD">Grenada</option>
												<option value="GE">Georgia</option>
												<option value="GH">Ghana</option>
												<option value="GH">Ghana</option>
												<option value="HN">Honduras</option>
												<option value="HT">Haiti</option>
												<option value="HU">Hungary</option>
												<option value="ID">Indonesia</option>
												<option value="IE">Ireland</option>
												<option value="IL">Israel</option>
												<option value="IN">India</option>
												<option value="IQ">Iraq</option>
												<option value="IR">Iran</option>
												<option value="IS">Iceland</option>
												<option value="IT">Italy</option>
												<option value="JM">Jamaica</option>
												<option value="JO">Jordan</option>
												<option value="JP">Japan</option>
												<option value="KE">Kenya</option>
												<option value="KG">Kyrgyzstan</option>
												<option value="KI">Kiribati</option>
												<option value="KW">Kuwait</option>
												<option value="KZ">Kazakhstan</option>
												<option value="LA">Laos</option>
												<option value="LB">Lebanons</option>
												<option value="LI">Liechtenstein</option>
												<option value="LR">Liberia</option>
												<option value="LS">Lesotho</option>
												<option value="LT">Lithuania</option>
												<option value="LU">Luxembourg</option>
												<option value="LV">Latvia</option>
												<option value="LY">Libya</option>
												<option value="MA">Morocco</option>
												<option value="MC">Monaco</option>
												<option value="MD">Moldova</option>
												<option value="ME">Montenegro</option>
												<option value="MG">Madagascar</option>
												<option value="MH">Marshall Islands</option>
												<option value="MK">Macedonia (FYROM)</option>
												<option value="ML">Mali</option>
												<option value="MM">Myanmar (formerly Burma)</option>
												<option value="MN">Mongolia</option>
												<option value="MR">Mauritania</option>
												<option value="MT">Malta</option>
												<option value="MV">Maldives</option>
												<option value="MW">Malawi</option>
												<option value="MX">Mexico</option>
												<option value="MZ">Mozambique</option>
												<option value="NA">Namibia</option>
												<option value="NG">Nigeria</option>
												<option value="NO">Norway</option>
												<option value="NP">Nepal</option>
												<option value="NR">Nauru</option>
												<option value="NZ">New Zealand</option>
												<option value="OM">Oman</option>
												<option value="PA">Panama</option>
												<option value="PF">Paraguay</option>
												<option value="PG">Papua New Guinea</option>
												<option value="PH">Philippines</option>
												<option value="PK">Pakistan</option>
												<option value="PL">Poland</option>
												<option value="QA">Qatar</option>
												<option value="RO">Romania</option>
												<option value="RU">Russia</option>
												<option value="RW">Rwanda</option>
												<option value="SA">Saudi Arabia</option>
												<option value="SB">Solomon Islands</option>
												<option value="SC">Seychelles</option>
												<option value="SD">Sudan</option>
												<option value="SE">Sweden</option>
												<option value="SG">Singapore</option>
												<option value="TG">Togo</option>
												<option value="TH">Thailand</option>
												<option value="TJ">Tajikistan</option>
												<option value="TL">Timor-Leste</option>
												<option value="TM">Turkmenistan</option>
												<option value="TN">Tunisia</option>
												<option value="TO">Tonga</option>
												<option value="TR">Turkey</option>
												<option value="TT">Trinidad and Tobago</option>
												<option value="TW">Taiwan</option>
												<option value="UA">Ukraine</option>
												<option value="UG">Uganda</option>
												<option value="UM">United States of America</option>
												<option value="UY">Uruguay</option>
												<option value="UZ">Uzbekistan</option>
												<option value="VA">Vatican City (Holy See)</option>
												<option value="VE">Venezuela</option>
												<option value="VN">Vietnam</option>
												<option value="VU">Vanuatu</option>
												<option value="YE">Yemen</option>
												<option value="ZM">Zambia</option>
												<option value="ZW">Zimbabwe</option>
											</select>
										</div>
									</div>
									<div class="col-md-6 col-xl-3">
										<div class="form-group mb-lg-0">
											<label>Products :</label>
											<select multiple="multiple" class="group-filter">
												<optgroup label="Mens">
													<option value="1">Foot wear</option>
													<option value="2">Top wear</option>
													<option value="3">Bootom wear</option>
													<option value="4">Men's Groming</option>
													<option value="5">Accessories</option>
												</optgroup>
												<optgroup label="Women">
													<option value="1">Western wear</option>
													<option value="2">Foot wear</option>
													<option value="3">Top wear</option>
													<option value="4">Bootom wear</option>
													<option value="5">Beuty Groming</option>
													<option value="6">Accessories</option>
													<option value="7">Jewellery</option>
												</optgroup>
												<optgroup label="Baby & Kids">
													<option value="1">Boys clothing</option>
													<option value="2">Girls Clothing</option>
													<option value="3">Toys</option>
													<option value="4">Baby Care</option>
													<option value="5">Kids footwear</option>
												</optgroup>
											</select>
										</div>
									</div>
									<div class="col-md-12 col-xl-2">
										<div class="form-group mb-lg-0">
											<label>Sales Type :</label>
											<select multiple="multiple" class="multi-select">
												<option value="1">Online</option>
												<option value="2">Offline</option>
												<option value="3">Reseller</option>
											</select>
										</div>
									</div>
								</div>
								<hr>
								<div class="text-end">
									<a href="javascript:void(0);" class="btn btn-primary" data-bs-toggle="collapse"
										data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
										aria-expanded="false" aria-label="Toggle navigation">Apply</a>
									<a href="javascript:void(0);" class="btn btn-secondary" data-bs-toggle="collapse"
										data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
										aria-expanded="false" aria-label="Toggle navigation">Reset</a>
								</div>
							</div>
						</div>
					</div>
					<!--End Navbar -->

					<!-- Row -->
					<div class="row row-sm">
						<div class="col-sm-6 col-xl-4 col-lg-6">
							<div class="card custom-card">
								<div class="card-body dash1">
									<div class="d-flex">
										<p class="mb-1 tx-inverse">Number Of Customers</p>
										<div class="ms-auto">
											<i class="fa fa-line-chart fs-20 text-primary"></i>
										</div>
									</div>
									<div>
										<h3 class="dash-25"><?php echo $totcustomers; ?></h3>
									</div>
									<div class="progress mb-1">
										<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70"
											class="progress-bar progress-bar-xs wd-70p" role="progressbar"></div>
									</div>
									<!-- <div class="expansion-label d-flex">
										<span class="text-muted">Last Month</span>
										<span class="ms-auto"><i
												class="fa fa-caret-up me-1 text-success"></i>0.7%</span>
									</div> -->
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-xl-4 col-lg-6">
							<div class="card custom-card">
								<div class="card-body dash1">
									<div class="d-flex">
										<p class="mb-1 tx-inverse">Number Of Products</p>
										<div class="ms-auto">
											<i class="fa fa-money fs-20 text-secondary"></i>
										</div>
									</div>
									<div>
										<h3 class="dash-25"><?php echo $totproducts; ?></h3>
									</div>
									<div class="progress mb-1">
										<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70"
											class="progress-bar progress-bar-xs wd-60p bg-secondary" role="progressbar">
										</div>
									</div>
									<!-- <div class="expansion-label d-flex">
										<span class="text-muted">Last Month</span>
										<span class="ms-auto"><i
												class="fa fa-caret-down me-1 text-danger"></i>0.43%</span>
									</div> -->
								</div>
							</div>
						</div>
						<div class="col-sm-6 col-xl-4 col-lg-6">
							<div class="card custom-card">
								<div class="card-body dash1">
									<div class="d-flex">
										<p class="mb-1 tx-inverse">Number of Orders</p>
										<div class="ms-auto">
											<i class="fa fa-usd fs-20 text-success"></i>
										</div>
									</div>
									<div>
										<h3 class="dash-25"><?php echo $totOrders; ?></h3>
									</div>
									<div class="progress mb-1">
										<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="70"
											class="progress-bar progress-bar-xs wd-50p bg-success" role="progressbar">
										</div>
									</div>
									<!-- <div class="expansion-label d-flex text-muted">
										<span class="text-muted">Last Month</span>
										<span class="ms-auto"><i
												class="fa fa-caret-down me-1 text-danger"></i>1.44%</span>
									</div> -->
								</div>
							</div>
						</div>
						
					</div>
					<!--End  Row -->

					<!-- Row -->
				
					<!-- End Row -->

					<!-- Row -->
				
					<!-- End Row -->

					<!-- Row-->
					<div class="row">
						<div class="col-sm-12 col-xl-12 col-lg-12">
							<div class="card custom-card">
								<div class="card-body">
									<div>
										<h6 class="card-title mb-1">Assets Summary</h6>
										<p class="text-muted card-sub-title mb-2">*******************************</p>
									</div>
									<div class="table-responsive br-3">
										<table class="table table-bordered text-nowrap mb-0">
											<thead>
												<tr>
													<th>#No</th>
													<th>Customer Name</th>
                                                    <th>Contact No</th>
                                                    <th>Order Date</th>
                                                    <th>Assets Description</th>
                                                    <th>Assets Status</th>
                                                   
												</tr>
											</thead>
											<tbody>
											<?php
                                                showcustomer();
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

		<?php include 'includes/footer.php';?>


	</div>
	<!-- End Page -->

	<!-- Back-to-top -->
	<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

	<!-- Jquery js-->
	<script src="assets/plugins/jquery/jquery.min.js"></script>

	<!-- Bootstrap js-->
	<script src="assets/plugins/bootstrap/popper.min.js"></script>
	<script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>

	<!-- Flot js-->
	<script src="assets/plugins/jquery.flot/jquery.flot.js"></script>
	<script src="assets/plugins/jquery.flot/jquery.flot.resize.js"></script>
	<script src="assets/js/chart.flot.sampledata.js"></script>

	<!-- Chart.Bundle js-->
	<script src="assets/plugins/chart.js/Chart.bundle.min.js"></script>

	<!-- Peity js-->
	<script src="assets/plugins/peity/jquery.peity.min.js"></script>

	<!-- Jquery-Ui js-->
	<script src="assets/plugins/jquery-ui/ui/widgets/datepicker.js"></script>

	<!-- Select2 js-->
	<script src="assets/plugins/select2/js/select2.min.js"></script>

	<!--MutipleSelect js-->
	<script src="assets/plugins/multipleselect/multiple-select.js"></script>
	<script src="assets/plugins/multipleselect/multi-select.js"></script>

	<!-- Perfect-scrollbar js-->
	<script src="assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/p-scroll-1.js"></script>

	<!-- Sidemenu js-->
	<script src="assets/plugins/sidemenu/sidemenu.js"></script>

	<!-- Sidebar js-->
	<script src="assets/plugins/sidebar/sidebar.js"></script>

	<!-- Sticky js-->
	<script src="assets/js/sticky.js"></script>

	<!-- Dashboard js-->
	<script src="assets/js/index.js"></script>

	<!-- Custom-Switcher js -->
	<script src="assets/js/custom-switcher.js"></script>

	<!-- Custom js-->
	<script src="assets/js/custom.js"></script>

	<!-- Switcher js -->
	<script src="assets/switcher/js/switcher.js"></script>

</body>

</html>