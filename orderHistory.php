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
	<meta name="description" content="Dashlead - Admin Panel HTML Dashboard Template">
	<meta name="author" content="Spruko Technologies Private Limited">
	<meta name="keywords" content="sales dashboard, admin dashboard, bootstrap 5 admin template, html admin template, admin panel design, admin panel design, bootstrap 5 dashboard, admin panel template, html dashboard template, bootstrap admin panel, sales dashboard design, best sales dashboards, sales performance dashboard, html5 template, dashboard template">

	<!-- Favicon -->
	<link rel="icon" href="assets/img/brand/favicon.ico" type="image/x-icon">

	<!-- Title -->
	<title>Dashlead - Admin Panel HTML Dashboard Template</title>

	<!---bootstrap css-->
	<link id="style" href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!--- FONT-ICONS CSS -->
	<link href="assets/css/icons.css" rel="stylesheet">

	<!---Style css-->
	<link href="assets/css/style.css" rel="stylesheet">

	<!---Plugins css-->
	<link href="assets/css/plugins.css" rel="stylesheet">

	<!-- Switcher css -->
	<link href="assets/switcher/css/switcher.css" rel="stylesheet">
	<link href="assets/switcher/demo.css" rel="stylesheet">

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
							<h2 class="main-content-title tx-24 mg-b-5">Order History</h2>
							<ol class="breadcrumb">
								<li class="breadcrumb-item"><a href="javascript:void(0);">Customer List</a></li>
								<li class="breadcrumb-item active" aria-current="page">Order History</li>
							</ol>
						</div>
						<div class="btn-list">
							<a class="btn ripple btn-primary" href="javascript:void(0);"><i class="fe fe-external-link"></i> Export</a>
							<a class="btn ripple btn-secondary" href="javascript:void(0);"><i class="fe fe-download"></i> Download</a>
							<a class="btn ripple btn-info" href="javascript:void(0);"><i class="fe fe-help-circle"></i> Help</a>
							<a class="btn ripple btn-danger dropdown-toggle" href="javascript:void(0);" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
								<i class="fe fe-settings"></i> Settings <i class="fa fa-caret-down ms-1"></i>
							</a>
							<div class="dropdown-menu tx-13">
								<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-eye me-2 float-start"></i>View</a>
								<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-plus-circle me-2 float-start"></i>Add</a>
								<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-mail me-2 float-start"></i>Email</a>
								<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-folder-plus me-2 float-start"></i>Save</a>
								<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-trash-2 me-2 float-start"></i>Remove</a>
								<a class="dropdown-item d-flex align-items-center" href="javascript:void(0);"><i class="fe fe-settings me-2 float-start"></i>More</a>
							</div>
						</div>
					</div>
					<!-- End Page Header -->

					<!-- Row -->
					<div class="row">
						<div class="col-lg-12">
							<div class="card custom-card">
								<div class="card-header custom-card-header rounded-bottom-0">
									<h5 class="mt-3">Orders Timeline</h5>
								</div>

								<div class="card-body">
									<div class="vtimeline">
										<?php
										$queryorder = "SELECT id, order_date, delivery_date, delivery_time, total_amount, orderType, branch FROM orders WHERE custid = ?";
										$the_cat_id = $_GET['view'];

										if ($stmt = $connection->prepare($queryorder)) {
											$stmt->bind_param('i', $the_cat_id);
											$stmt->execute();
											$stmt->bind_result($id, $order_date, $delivery_date, $delivery_time, $total_amount, $orderType, $branch);

											$orders = [];
											while ($stmt->fetch()) {
												$orders[] = [
													'id' => $id,
													'order_date' => $order_date,
													'delivery_date' => $delivery_date,
													'delivery_time' => $delivery_time,
													'total_amount' => $total_amount,
													'orderType' => $orderType,
													'branch' => $branch,
													'products' => []
												];
											}

											$stmt->close();

											foreach ($orders as &$order) {
												$querypayment = "SELECT payment_type FROM order_payments WHERE order_id = ?";
												$paystatus = 'Only Advance Payment Done'; // Default status

												if ($stmtpay = $connection->prepare($querypayment)) {
													$stmtpay->bind_param('i', $order['id']);
													$stmtpay->execute();
													$stmtpay->bind_result($paymentType);

													while ($stmtpay->fetch()) {
														if ($paymentType == 'Final Payment') {
															$paystatus = 'Fully Paid';
															break;
														} elseif ($paymentType == 'Intrim Payment') {
															$paystatus = 'Partially Paid';
														}
													}

													$stmtpay->close();
												} else {
													echo "Error: " . $connection->error;
												}

												$order['paystatus'] = $paystatus;

												// Fetch products for the current order
												$queryproduct = "SELECT * FROM order_products WHERE order_id = ?";
												if ($stmtproduct = $connection->prepare($queryproduct)) {
													$stmtproduct->bind_param('i', $order['id']);
													$stmtproduct->execute();
													$resultproduct = $stmtproduct->get_result();

													while ($rowproduct = $resultproduct->fetch_assoc()) {
														$productid = $rowproduct['product_id'];
														$productname = "";

														$queryproductname = "SELECT pname FROM products WHERE id = ?";
														if ($stmtproductname = $connection->prepare($queryproductname)) {
															$stmtproductname->bind_param('i', $productid);
															$stmtproductname->execute();
															$stmtproductname->bind_result($productname);
															$stmtproductname->fetch();
															$stmtproductname->close();
														}

														$order['products'][] = [
															'product_id' => $productid,
															'product_name' => $productname
														];
													}

													$stmtproduct->close();
												}
											}
											unset($order); // break the reference with the last element
											// Check if there are no orders
											if (empty($orders)) {
												echo "<p>No orders yet.</p>";
											} else {
											$i = 0;
											foreach ($orders as $order) {
												$i++;
												if ($i == 1) {
													echo "<div class='timeline-wrapper timeline-wrapper-primary'>";
												} elseif ($i == 2) {
													echo "<div class='timeline-wrapper timeline-inverted timeline-wrapper-secondary'>";
												} elseif ($i == 3) {
													echo "<div class='timeline-wrapper timeline-wrapper-info'>";
												} elseif ($i == 4) {
													echo "<div class='timeline-wrapper timeline-inverted timeline-wrapper-danger'>";
												} elseif ($i == 5) {
													echo "<div class='timeline-wrapper timeline-wrapper-success'>";
												} elseif ($i == 6) {
													echo "<div class='timeline-wrapper timeline-inverted timeline-wrapper-warning'>";
												} elseif ($i == 7) {
													$i = 1;
													echo "<div class='timeline-wrapper timeline-wrapper-dark'>";
												}

										?>


												<div class="timeline-badge"></div>
												<div class="timeline-panel">
													<div class="timeline-heading">
														<h6 class="timeline-title">Order ID: <?php echo $order['id']; ?></h6>
													</div>
													<div class="timeline-body">
														<h6 class="timeline-title">Successfully Delivered on <?php
																												$date = new DateTime($order['delivery_date']);
																												echo $date->format('d-m-Y') . "," .  $order['delivery_time'];
																												?>
														</h6>
														<p><strong>Order Date: </strong><?php
																						$date = new DateTime($order['order_date']);
																						echo $date->format('d-m-Y');
																						?><br><strong>Total Amount: </strong><?php echo $order['total_amount']; ?><br>
															<strong>Payment Status: </strong>
															<?php
															if ($order['paystatus'] == 'Fully Paid'){ ?>
																<span class='badge bg-success' style='font-size: 13px;'><?php echo $order['paystatus'];?></span>
															<?php }
															if ($order['paystatus'] == 'Partially Paid'){ ?>
																<span class='badge bg-info' style='font-size: 13px;'><?php echo $order['paystatus']; ?></span>
															<?php }
															if ($order['paystatus'] == 'Only Advance Payment Done'){ ?>
																<span class='badge bg-danger' style='font-size: 13px;'><?php echo $order['paystatus']; ?></span>
															<?php }
															?>
															<br><strong>Products Purchased:</strong>
															<?php
															$productNames = array_map(function ($product) {
																return $product['product_name'];
															}, $order['products']);
															echo implode(', ', $productNames);
															?>
														</p>
													</div>
													<div class="timeline-footer d-flex align-items-center flex-wrap">
														<i class="fe fe-heart text-muted me-1"></i>
														
														<span class="ms-md-auto ms-2">
															<i class="fe fe-calendar text-muted mx-1"></i>
															<?php
															$date = new DateTime($order['order_date']);
															echo $date->format('d-m-Y');
															?>
														</span>
													</div>
												</div>

										<?php
												echo "</div>";
														}
											}
										} else {
											echo "hai";
											echo "Error: " . $connection->error;
										}
										?>
										<!-- <pre> -->
											<?php 
											// print_r($orders); 
											?>
										<!-- </pre> -->
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

		<!-- Sidebar -->
		<div class="sidebar sidebar-right sidebar-animate">
			<div class="sidebar-icon">
				<a href="javascript:void(0);" class="text-right float-end text-dark fs-20 mt-2" data-bs-toggle="sidebar-right" data-bs-target=".sidebar-right"><i class="fe fe-x"></i></a>
			</div>
			<div class="sidebar-body">
				<h4 class="mt-3 ms-3">Notifications</h4>
				<hr class="mb-2">
				<div class="panel panel-primary">
					<div class="tab-menu-heading">
						<div class="tabs-menu">
							<!-- Tabs -->
							<ul class="nav panel-tabs justify-content-center">
								<li><a href="#tab1" class="active" data-bs-toggle="tab">Friends</a></li>
								<li><a href="#tab2" data-bs-toggle="tab">Chats</a></li>
								<li><a href="#tab3" data-bs-toggle="tab">Notifications</a></li>
							</ul>
						</div>
					</div>
					<div class="panel-body tabs-menu-body">
						<div class="tab-content">
							<div class="tab-pane active" id="tab1">
								<div class="tab-pane" id="friends" tabindex="0">
									<ul class="list-unstyled list-group list-group-flush">
										<li class="px-0 py-2">
											<div class="d-flex align-items-start">
												<div class="d-flex align-items-center flex-grow-1 overflow-hidden position-relative">
													<a href="javascript:void(0);" class="stretched-link"></a>
													<div class="me-2 min-w-fit-content">
														<img src="assets/img/users/12.jpg" alt="img" class="avatar avatar-sm rounded-circle">
													</div>
													<div class="flex-grow-1">
														<p class="mb-0 tx-medium text-truncate fs-15">Socrates Itumay</p>
														<span class="fs-11 text-muted text-truncate">(11)+390-2309</span>
													</div>
												</div>
												<a href="javascript:void(0);" class="mt-3 me-2">
													<i class="fe fe-edit fs-16"></i>
												</a>
											</div>
										</li>
										<li class="px-0 py-2">
											<div class="d-flex align-items-start">
												<div class="d-flex align-items-center flex-grow-1 overflow-hidden position-relative">
													<a href="javascript:void(0);" class="stretched-link"></a>
													<div class="me-2 min-w-fit-content">
														<img src="assets/img/users/2.jpg" alt="img" class="avatar avatar-sm rounded-circle">
													</div>
													<div class="flex-grow-1">
														<p class="mb-0 tx-medium text-truncate fs-15">Reynante Labares</p>
														<span class="fs-11 text-muted text-truncate">(21)+326-1254</span>
													</div>
												</div>
												<a href="javascript:void(0);" class="mt-3 me-2">
													<i class="fe fe-edit fs-16"></i>
												</a>
											</div>
										</li>
										<li class="px-0 py-2">
											<div class="d-flex align-items-start">
												<div class="d-flex align-items-center flex-grow-1 overflow-hidden position-relative">
													<a href="javascript:void(0);" class="stretched-link"></a>
													<div class="me-2 min-w-fit-content">
														<img src="assets/img/users/5.jpg" alt="img" class="avatar avatar-sm rounded-circle">
													</div>
													<div class="flex-grow-1">
														<p class="mb-0 tx-medium text-truncate fs-15">Owen Bongcaras</p>
														<span class="fs-11 text-muted text-truncate">(54)+125-7861</span>
													</div>
												</div>
												<a href="javascript:void(0);" class="mt-3 me-2">
													<i class="fe fe-edit fs-16"></i>
												</a>
											</div>
										</li>
										<li class="px-0 py-2">
											<div class="d-flex align-items-start">
												<div class="d-flex align-items-center flex-grow-1 overflow-hidden position-relative">
													<a href="javascript:void(0);" class="stretched-link"></a>
													<div class="me-2 min-w-fit-content">
														<img src="assets/img/users/7.jpg" alt="img" class="avatar avatar-sm rounded-circle">
													</div>
													<div class="flex-grow-1">
														<p class="mb-0 tx-medium text-truncate fs-15">Mariane Galeon</p>
														<span class="fs-11 text-muted text-truncate">(14)+025-5621</span>
													</div>
												</div>
												<a href="javascript:void(0);" class="mt-3 me-2">
													<i class="fe fe-edit fs-16"></i>
												</a>
											</div>
										</li>
										<li class="px-0 py-2">
											<div class="d-flex align-items-start">
												<div class="d-flex align-items-center flex-grow-1 overflow-hidden position-relative">
													<a href="javascript:void(0);" class="stretched-link"></a>
													<div class="me-2 min-w-fit-content">
														<img src="assets/img/users/8.jpg" alt="img" class="avatar avatar-sm rounded-circle">
													</div>
													<div class="flex-grow-1">
														<p class="mb-0 tx-medium text-truncate fs-15">Joyce Chua</p>
														<span class="fs-11 text-muted text-truncate">(11)+458-1205</span>
													</div>
												</div>
												<a href="javascript:void(0);" class="mt-3 me-2">
													<i class="fe fe-edit fs-16"></i>
												</a>
											</div>
										</li>
										<li class="px-0 py-2">
											<div class="d-flex align-items-start">
												<div class="d-flex align-items-center flex-grow-1 overflow-hidden position-relative">
													<a href="javascript:void(0);" class="stretched-link"></a>
													<div class="me-2 min-w-fit-content">
														<img src="assets/img/users/3.jpg" alt="img" class="avatar avatar-sm rounded-circle">
													</div>
													<div class="flex-grow-1">
														<p class="mb-0 tx-medium text-truncate fs-15">Sonia Fraser</p>
														<span class="fs-11 text-muted text-truncate">(21)+654-9517</span>
													</div>
												</div>
												<a href="javascript:void(0);" class="mt-3 me-2">
													<i class="fe fe-edit fs-16"></i>
												</a>
											</div>
										</li>
										<li class="px-0 py-2">
											<div class="d-flex align-items-start">
												<div class="d-flex align-items-center flex-grow-1 overflow-hidden position-relative">
													<a href="javascript:void(0);" class="stretched-link"></a>
													<div class="me-2 min-w-fit-content">
														<img src="assets/img/users/10.jpg" alt="img" class="avatar avatar-sm rounded-circle">
													</div>
													<div class="flex-grow-1">
														<p class="mb-0 tx-medium text-truncate fs-15">Owen Bongcaras</p>
														<span class="fs-11 text-muted text-truncate">(14)+753-4268</span>
													</div>
												</div>
												<a href="javascript:void(0);" class="mt-3 me-2">
													<i class="fe fe-edit fs-16"></i>
												</a>
											</div>
										</li>
										<li class="px-0 py-2">
											<div class="d-flex align-items-start">
												<div class="d-flex align-items-center flex-grow-1 overflow-hidden position-relative">
													<a href="javascript:void(0);" class="stretched-link"></a>
													<div class="me-2 min-w-fit-content">
														<img src="assets/img/users/11.jpg" alt="img" class="avatar avatar-sm rounded-circle">
													</div>
													<div class="flex-grow-1">
														<p class="mb-0 tx-medium text-truncate fs-15">Reynante Labares</p>
														<span class="fs-11 text-muted text-truncate">(10)+111-1611</span>
													</div>
												</div>
												<a href="javascript:void(0);" class="mt-3 me-2">
													<i class="fe fe-edit fs-16"></i>
												</a>
											</div>
										</li>
										<li class="px-0 py-2">
											<div class="d-flex align-items-start">
												<div class="d-flex align-items-center flex-grow-1 overflow-hidden position-relative">
													<a href="javascript:void(0);" class="stretched-link"></a>
													<div class="me-2 min-w-fit-content">
														<img src="assets/img/users/5.jpg" alt="img" class="avatar avatar-sm rounded-circle">
													</div>
													<div class="flex-grow-1">
														<p class="mb-0 tx-medium text-truncate fs-15">Owen Bongcaras</p>
														<span class="fs-11 text-muted text-truncate">(54)+125-7861</span>
													</div>
												</div>
												<a href="javascript:void(0);" class="mt-3 me-2">
													<i class="fe fe-edit fs-16"></i>
												</a>
											</div>
										</li>
										<li class="px-0 py-2">
											<div class="d-flex align-items-start">
												<div class="d-flex align-items-center flex-grow-1 overflow-hidden position-relative">
													<a href="javascript:void(0);" class="stretched-link"></a>
													<div class="me-2 min-w-fit-content">
														<img src="assets/img/users/7.jpg" alt="img" class="avatar avatar-sm rounded-circle">
													</div>
													<div class="flex-grow-1">
														<p class="mb-0 tx-medium text-truncate fs-15">Mariane Galeon</p>
														<span class="fs-11 text-muted text-truncate">(14)+025-5621</span>
													</div>
												</div>
												<a href="javascript:void(0);" class="mt-3 me-2">
													<i class="fe fe-edit fs-16"></i>
												</a>
											</div>
										</li>
									</ul>
								</div>
							</div>
							<div class="tab-pane" id="tab2">
								<div class="list-group list-group-flush">
									<div class="d-flex px-0 py-2">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/2.jpg"><span class="avatar-status"></span></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark" data-bs-toggle="modal" data-target="#chatmodel">Airi Satou</div>
												<p class="mb-0 fs-11 text-muted"> Hey! there I' am available.... </p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-16 me-2"><i class="fa fa-angle-right"></i></a>
									</div>
									<div class="d-flex px-0 py-2">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/1.jpg"><span class="avatar-status bg-success"></span></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark" data-bs-toggle="modal" data-target="#chatmodel">Angelica Ramos</div>
												<p class="mb-0 fs-11 text-muted"> Okay...I will be waiting for you </p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-16 me-2"><i class="fa fa-angle-right"></i></a>
									</div>
									<div class="d-flex px-0 py-2">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/3.jpg"><span class="avatar-status"></span></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark" data-bs-toggle="modal" data-target="#chatmodel">Ashton Cox</div>
												<p class="mb-0 fs-11 text-muted"> Hi we can explain our new project......
												</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-16 me-2"><i class="fa fa-angle-right"></i></a>
									</div>
									<div class="d-flex px-0 py-2">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/3.jpg"><span class="avatar-status"></span></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark" data-bs-toggle="modal" data-target="#chatmodel">Bradley Greer</div>
												<p class="mb-0 fs-11 text-muted"> New product Launching... </p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-16 me-2"><i class="fa fa-angle-right"></i></a>
									</div>
									<div class="d-flex px-0 py-2">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/4.jpg"><span class="avatar-status bg-success"></span></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark" data-bs-toggle="modal" data-target="#chatmodel">Brenden Wagner</div>
												<p class="mb-0 fs-11 text-muted"> Okay...I will be waiting for you </p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-16 me-2"><i class="fa fa-angle-right"></i></a>
									</div>
									<div class="d-flex px-0 py-2">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/5.jpg"><span class="avatar-status bg-success"></span></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark" data-bs-toggle="modal" data-target="#chatmodel">Brielle Williamson</div>
												<p class="mb-0 fs-11 text-muted"> Hi we can explain our new project......
												</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-16 me-2"><i class="fa fa-angle-right"></i></a>
									</div>
									<div class="d-flex px-0 py-2">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/6.jpg"><span class="avatar-status"></span></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark" data-bs-toggle="modal" data-target="#chatmodel">Bruno Nash</div>
												<p class="mb-0 fs-11 text-muted"> Hey! there I' am available....</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-16 me-2"><i class="fa fa-angle-right"></i></a>
									</div>

									<div class="d-flex px-0 py-2">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/7.jpg"><span class="avatar-status bg-success"></span></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark" data-bs-toggle="modal" data-target="#chatmodel">Caesar Vance</div>
												<p class="mb-0 fs-11 text-muted">Schedule Realease...... </p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-16 me-2"><i class="fa fa-angle-right"></i></a>
									</div>
									<div class="d-flex px-0 py-2">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/8.jpg"><span class="avatar-status bg-success"></span></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark" data-bs-toggle="modal" data-target="#chatmodel">Cara Stevens</div>
												<p class="mb-0 fs-11 text-muted"> Hi we can explain our new project......
												</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-16 me-2"><i class="fa fa-angle-right"></i></a>
									</div>
									<div class="d-flex px-0 py-2">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/9.jpg"><span class="avatar-status bg-success"></span></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark" data-bs-toggle="modal" data-target="#chatmodel">Cedric Kelly</div>
												<p class="mb-0 fs-11 text-muted">Contact me for details....</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-16 me-2"><i class="fa fa-angle-right"></i></a>
									</div>
									<div class="d-flex px-0 py-2">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/10.jpg"><span class="avatar-status"></span></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark" data-bs-toggle="modal" data-target="#chatmodel">Socrates Itumay</div>
												<p class="mb-0 fs-11 text-muted"> Hi we can explain our new project......
												</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-16 me-2"><i class="fa fa-angle-right"></i></a>
									</div>
									<div class="d-flex px-0 py-2">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/11.jpg"><span class="avatar-status bg-success"></span></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark" data-bs-toggle="modal" data-target="#chatmodel">Reynante Labares</div>
												<p class="mb-0 fs-11 text-muted"> Okay...I will be waiting for you </p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-16 me-2"><i class="fa fa-angle-right"></i></a>
									</div>
									<div class="d-flex px-0 py-2">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/12.jpg"><span class="avatar-status"></span></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark" data-bs-toggle="modal" data-target="#chatmodel">Owen Bongcaras</div>
												<p class="mb-0 fs-11 text-muted">New product Launching...</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-16 me-2"><i class="fa fa-angle-right"></i></a>
									</div>
									<div class="d-flex px-0 py-2">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/1.jpg"><span class="avatar-status bg-success"></span></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark" data-bs-toggle="modal" data-target="#chatmodel">Mariane Galeon</div>
												<p class="mb-0 fs-11 text-muted">cherryblossom@gmail.com</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-16 me-2"><i class="fa fa-angle-right"></i></a>
									</div>
								</div>
							</div>
							<div class="tab-pane" id="tab3">
								<div class="list-group list-group-flush">
									<div class="d-flex px-0 py-2 ">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/1.jpg"></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark">Madeleine</div>
												<p class="mb-0 fs-11 text-muted">Hey! there I'am available...</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-13 mt-1"><i class="fe fe-x"></i></a>
									</div>
									<div class="d-flex px-0 py-2 ">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/12.jpg"></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark">Dee End</div>
												<p class="mb-0 fs-11 text-muted">At sanctus labore rebum stet sed</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-13 mt-1"><i class="fe fe-x"></i></a>
									</div>
									<div class="d-flex px-0 py-2 ">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/2.jpg"></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark">Olivia</div>
												<p class="mb-0 fs-11 text-muted">Hey! there I'am available...</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-13 mt-1"><i class="fe fe-x"></i></a>
									</div>
									<div class="d-flex px-0 py-2 ">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/11.jpg"></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark">Mustafa Lee</div>
												<p class="mb-0 fs-11 text-muted">Sed amet stet clita dolores etc.,</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-13 mt-1"><i class="fe fe-x"></i></a>
									</div>
									<div class="d-flex px-0 py-2 ">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/3.jpg"></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark">Anthony</div>
												<p class="mb-0 fs-11 text-muted">New product Launching...</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-13 mt-1"><i class="fe fe-x"></i></a>
									</div>
									<div class="d-flex px-0 py-2 ">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/10.jpg"></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark">Lee Nonmi</div>
												<p class="mb-0 fs-11 text-muted">Tempor justo ipsum clita rebum lorem.</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-13 mt-1"><i class="fe fe-x"></i></a>
									</div>
									<div class="d-flex px-0 py-2 ">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/4.jpg"></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark">Socrates</div>
												<p class="mb-0 fs-11 text-muted">New Schedule Realease...</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-13 mt-1"><i class="fe fe-x"></i></a>
									</div>
									<div class="d-flex px-0 py-2 ">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/9.jpg"></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark">Peter Owt</div>
												<p class="mb-0 fs-11 text-muted">Tempor justo ipsum clita rebum lorem.</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-13 mt-1"><i class="fe fe-x"></i></a>
									</div>
									<div class="d-flex px-0 py-2 ">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/5.jpg"></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark">Percy kewshu</div>
												<p class="mb-0 fs-11 text-muted">You have Received Four files click to open</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-13 mt-1"><i class="fe fe-x"></i></a>
									</div>
									<div class="d-flex px-0 py-2 ">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/8.jpg"></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark">Rod Knee</div>
												<p class="mb-0 fs-11 text-muted">Ea duo eosamet ut.</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-13 mt-1"><i class="fe fe-x"></i></a>
									</div>
									<div class="d-flex px-0 py-2 ">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/6.jpg"></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark">Joyce Chua</div>
												<p class="mb-0 fs-11 text-muted">dummy text of the printing set.</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-13 mt-1"><i class="fe fe-x"></i></a>
									</div>
									<div class="d-flex px-0 py-2 ">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/7.jpg"></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark">Sonia Fraser</div>
												<p class="mb-0 fs-11 text-muted">when an unknown printer took et.</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-13 mt-1"><i class="fe fe-x"></i></a>
									</div>
									<div class="d-flex px-0 py-2 ">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/4.jpg"></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark">Reynante Labares</div>
												<p class="mb-0 fs-11 text-muted">when an unknown printer took et.</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-13 mt-1"><i class="fe fe-x"></i></a>
									</div>
									<div class="d-flex px-0 py-2 ">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/10.jpg"></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark">David Wallace</div>
												<p class="mb-0 fs-11 text-muted">remaining essentially It unchanged. </p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-13 mt-1"><i class="fe fe-x"></i></a>
									</div>
									<div class="d-flex px-0 py-2 ">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/3.jpg"></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark">Kevin James</div>
												<p class="mb-0 fs-11 text-muted">There are many variations of passages.</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-13 mt-1"><i class="fe fe-x"></i></a>
									</div>
									<div class="d-flex px-0 py-2 ">
										<div class="me-2">
											<span class="avatar avatar-sm brround cover-image" data-bs-image-src="assets/img/users/5.jpg"></span>
										</div>
										<div class="">
											<a href="chat.html">
												<div class="tx-medium text-dark">Kevin Glover</div>
												<p class="mb-0 fs-11 text-muted">Various versions have evolved over.</p>
											</a>
										</div>
										<a href="javascript:void(0);" class="ms-auto fs-13 mt-1"><i class="fe fe-x"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<!-- End Sidebar -->

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

	<!-- Timeline js-->
	<script src="assets/plugins/timeline/js/timeline.min.js"></script>
	<script src="assets/js/timline.js"></script>

	<!-- Perfect-scrollbar js-->
	<script src="assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
	<script src="assets/plugins/perfect-scrollbar/p-scroll-1.js"></script>


	<!-- Sidemenu js-->
	<script src="assets/plugins/sidemenu/sidemenu.js"></script>

	<!-- Sidebar js-->
	<script src="assets/plugins/sidebar/sidebar.js"></script>

	<!-- Sticky js-->
	<script src="assets/js/sticky.js"></script>

	<!-- Custom-Switcher js -->
	<script src="assets/js/custom-switcher.js"></script>

	<!-- Custom js-->
	<script src="assets/js/custom.js"></script>

	<!-- Switcher js -->
	<script src="assets/switcher/js/switcher.js"></script>

</body>

</html>s