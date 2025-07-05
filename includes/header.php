<?php
// session_start();

// Check if the 'adminname' session variable is set before using it
$adminname = isset($_SESSION['adminname']) ? $_SESSION['adminname'] : '';
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>
<!--Main Header -->
<div class="main-header side-header sticky">
				<div class="container-fluid main-container">
					<div class="main-header-left sidemenu">
						<a class="main-header-menu-icon" href="javascript:void(0);" data-bs-toggle="sidebar" id="mainSidebarToggle"><span></span></a>
					</div>
					<div class="main-header-left horizontal">
						<a class="main-logo" href="index.php">
							<img src="assets/img/dbluelogo.svg" class="desktop-logo desktop-logo-dark" alt="Divyaslogo">
							<img src="assets/img/dwhitelogo.svg" class="desktop-logo theme-logo" alt="Divyaslogo">
						</a>
					</div>
					<div class="main-header-right">
						<button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto collapsed" type="button"
							data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
							aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon fe fe-more-vertical"></span>
						</button>
						<div class="navbar navbar-expand-lg navbar-collapse responsive-navbar p-0">
							<div class="collapse navbar-collapse" id="navbarSupportedContent-4">
								<ul class="nav nav-item header-icons navbar-nav-right ms-auto">
									
									<!-- Theme-Layout -->
									<li class="dropdown  d-flex">
										<a class="nav-link icon theme-layout nav-link-bg layout-setting" href="javascript:void(0);">
											<span class="dark-layout"><i class="fe fe-moon"></i></span>
											<span class="light-layout"><i class="fe fe-sun"></i></span>
										</a>
									</li>
								
									
									<!-- FULL SCREEN -->
									<li class="dropdown">
										<a class="nav-link icon full-screen-link" href="javascript:void(0);">
											<i class="fe fe-maximize fullscreen-button"></i>
										</a>
									</li>
									<!-- FULL SCREEN -->
									<li class="dropdown main-header-notification">
										<a class="nav-link icon" href="javascript:void(0);" data-bs-toggle="dropdown" >
											<i class="fe fe-bell"></i>
											<span class="pulse bg-danger"></span>
										</a>
									
									</li>
									<li class="dropdown main-profile-menu">
									<?php
										// Define an array of colors
										$colors = array('bg-pink', 'bg-blue', 'bg-green', 'bg-purple', 'bg-orange','bg-primary','bg-cyan','bg-success');

										// Choose a random color from the array
										$randomColor = $colors[array_rand($colors)];
										?>
										<!-- <a class="main-img-user" href="javascript:void(0);" data-bs-toggle="dropdown"><img alt="avatar"
												src="assets/img/users/avatar.png"></a> -->
												<a class="main-img-user" href="javascript:void(0);" data-bs-toggle="dropdown"><div class="avatar avatar-sm <?php echo $randomColor; ?> tx-fixed-white">
														<?php echo strtoupper(substr($adminname, 0, 1)); ?>
													</div></a>
										<div class="dropdown-menu">
											<div class="header-navheading">
												<h6 class="main-notification-title"><?php echo strtoupper($adminname); ?></h6>
												<p class="main-notification-text">Administrator</p>
											</div><hr>
											<!-- <a class="dropdown-item border-top text-wrap" href="">
												<i class="fe fe-user"></i> My Profile
											</a>
											<a class="dropdown-item text-wrap" href="">
												<i class="fe fe-edit"></i> Edit Profile
											</a> -->
											
											<a class="dropdown-item text-wrap" href="./index.php?logout=1">
												<i class="fe fe-power"></i> Sign Out
											</a>
										</div>
									</li>
									<li class="dropdown header-settings">
										<!-- <a href="javascript:void(0);" class="nav-link icon" data-bs-toggle="sidebar-right"
											data-bs-target=".sidebar-right">
											<i class="fe fe-align-right"></i>
										</a> -->
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!--Main Header -->

			<!-- Sidemenu -->
			<div class="sticky">
				<aside class="app-sidebar ps horizontal-main">
					<div class="app-sidebar__header">
						<a class="main-logo" href="index.php">
							<img src="assets/img/dbluelogo.svg" class="desktop-logo desktop-logo-dark" alt="dashleadlogo">
							<img src="assets/img/dwhitelogo.svg" class="desktop-logo" alt="dashleadlogo">
							<img src="assets/img/favicon.png" class="mobile-logo mobile-logo-dark" alt="dashleadlogo">
							<img src="assets/img/favicon.png" class="mobile-logo" alt="dashleadlogo">
						</a>
					</div>
					<div class="main-sidemenu">
						<div class="slide-left disabled" id="slide-left">
							<svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
								<path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z"></path>
							</svg>
						</div>
						<ul class="side-menu">
							<li class="side-item side-item-category">Admin Dashboard</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="index.php">
									<span class="side-menu__icon">
										<i class="fe fe-airplay side_menu_img"></i>
									</span>
									<span class="side-menu__label">Dashboard</span>
								</a>
							</li>

							
							<li class="side-item side-item-category">Order Tracking</li>
													
							
							
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="orderslist.php">
									<span class="side-menu__icon"><i class="fe fe-users side_menu_img"></i></span>
									<span class="side-menu__label">Order Details</span>
								</a>
								
							</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="customerlist.php">
									<span class="side-menu__icon"><i class="fe fe-align-left side_menu_img"></i></span>
									<span class="side-menu__label">Customer Data</span>
								</a>
								
							</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="products.php">
									<span class="side-menu__icon"><i class="fe fe-more-vertical side_menu_img"></i></span>
									<span class="side-menu__label">Product Details</span>
								</a>
								
							</li>
						
							
							<li class="side-item side-item-category">Masters</li>
							
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="category.php">
									<span class="side-menu__icon"><i class="fe fe-award side_menu_img"></i></span>
									<span class="side-menu__label">Category</span>
								</a>
								
							</li>
							<li class="side-item side-item-category">Reports</li>
							
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="customerreports.php">
									<span class="side-menu__icon"><i class="fe fe-book-open side_menu_img"></i></span>
									<span class="side-menu__label">Customer List</span>
								</a>
								
							</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="productreports.php">
									<span class="side-menu__icon"><i class="fe fe-file side_menu_img"></i></span>
									<span class="side-menu__label">Product's List</span>
								</a>
								
							</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="ordersreport.php">
									<span class="side-menu__icon"><i class="fe fe-codepen side_menu_img"></i></span>
									<span class="side-menu__label">Order's List</span>
								</a>
								
							</li>
							<li class="slide">
								<a class="side-menu__item" data-bs-toggle="slide" href="assetsreport.php">
									<span class="side-menu__icon"><i class="fe fe-eye side_menu_img"></i></span>
									<span class="side-menu__label">Asset's List</span>
								</a>
								
							</li>


<!-- ================================================== -->
							
						
						</ul>
						<div class="slide-right" id="slide-right">
							<svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
								<path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z"></path>
							</svg>
						</div>
					</div>
				</aside>
			</div>
			<!-- End Sidemenu -->