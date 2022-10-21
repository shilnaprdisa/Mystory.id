<!DOCTYPE html> 
<html lang="en">
	<head>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
		<title>Dreams LMS</title>
		
		<!-- Favicon -->
		<link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.svg')}}">
		
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
		
		<!-- Fontawesome CSS -->
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/fontawesome.min.css')}}">
		<link rel="stylesheet" href="{{asset('assets/plugins/fontawesome/css/all.min.css')}}">	
		
		@stack('css')

		<!-- Feathericon CSS -->
        <link rel="stylesheet" href="assets/plugins/feather/feather.css">

		<!-- Main CSS -->
		<link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
	
	</head>
	<body>

		<!-- Main Wrapper -->
		<div class="main-wrapper">
		
			<!-- Header -->
            @include('layout.partials._header')
			<!-- /Header -->
			
			<!-- Breadcrumb -->
			<div class="page-banner instructor-bg-blk">
				<div class="container">
					<div class="row align-items-center student-group">
						<div class="col-lg-6 col-md-12">
							<div class="instructor-profile d-flex align-items-center">
								<div class="instructor-profile-pic">
									<a href="instructor-profile.html">
										<img src="assets/img/instructor/profile-avatar.jpg" alt="" class="img-fluid">
									</a>
								</div>
								<div class="instructor-profile-content">
									<h4><a href="instructor-profile.html">Jenny Wilson <span>Beginner</span></a></h4>
									<p>Instructor</p>
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-12">
							<div class="instructor-profile-menu">
								<ul class="nav">
									<li>
										<div class="d-flex align-items-center">
											<div class="instructor-profile-menu-img">
												<img src="assets/img/icon/icon-25.svg" alt="">
											</div>
											<div class="instructor-profile-menu-content">
												<h4>32</h4>
												<p>Courses</p>
											</div>
										</div>
									</li>
									<li>
										<div class="d-flex align-items-center">
											<div class="instructor-profile-menu-img">
												<img src="assets/img/icon/icon-26.svg" alt="">
											</div>
											<div class="instructor-profile-menu-content">
												<h4>11,604</h4>
												<p>Total Students</p>
											</div>
										</div>
									</li>
									<li>
										<div class="d-flex align-items-center">
											<div class="instructor-profile-menu-img">
												<img src="assets/img/icon/icon-27.svg" alt="">
											</div>
											<div class="instructor-profile-menu-content">
												<h4>12,230</h4>
												<p>Reviews</p>
											</div>
										</div>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="my-student-list">
								<ul>
									<li><a class="active" href="deposit-instructor-dashboard.html">Dashboard</a></li>
									<li><a  href="dashboard-instructor.html">Courses</a></li>
									<li><a href="withdrawal-instructor.html">Withdrawal</a></li>
									<li ><a href="#">Purchase history</a></li>
									<li ><a href="deposit-instructor.html">Deposit</a></li>
									<li class="mb-0"><a href="transactions-instructor.html">Transactions</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /Breadcrumb -->
			
			<!--Dashbord Student -->
			<div class="page-content">
				<div class="container">
					<div class="row">
						
						<!-- Profile Details -->
						<div class="col-xl-12 col-md-12">	
							<div class="settings-top-widget student-deposit-blk">
								<div class="row">
									<div class="col-lg-4 col-md-6 d-flex">
										<div class="card stat-info ttl-tickets">
											<div class="card-body">
												<div class="view-all-grp d-flex">
													<div class="student-ticket-view">
														<h3>50</h3>
														<p>Purchased Courses</p>
														<a href="dashboard-instructor.html" >View All</a>
													</div>
													<div class="img-deposit-ticket">
														<img src="assets/img/students/book.svg" alt="">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-6 d-flex">
										<div class="card stat-info open-tickets">
											<div class="card-body">
												<div class="view-all-grp d-flex">
													<div class="student-ticket-view">
														<h3>30</h3>
														<p>Total Transactions</p>
														<a href="transactions-instructor.html" >View All</a>
													</div>
													<div class="img-deposit-ticket">
														<img src="assets/img/students/receipt-text.svg" alt="">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-6 d-flex">
										<div class="card stat-info close-tickets">
											<div class="card-body">
												<div class="view-all-grp d-flex">
													<div class="student-ticket-view">
														<h3>20</h3>
														<p>Total Deposit</p>
														<a href="deposit-student.html" >View All</a>
													</div>
													<div class="img-deposit-ticket">
														<img src="assets/img/students/empty-wallet-tick.svg" alt="">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-6 d-flex">
										<div class="card stat-info medium-tickets">
											<div class="card-body">
												<div class="view-all-grp d-flex">
													<div class="student-ticket-view">
														<h3>$2055</h3>
														<p>Total Withdraw</p>
														<a href="withdrawal-instructor.html" >View All</a>
													</div>
													<div class="img-deposit-ticket">
														<img src="assets/img/students/empty-wallet-change.svg" alt="">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-6 d-flex">
										<div class="card stat-info blue-tickets">
											<div class="card-body">
												<div class="view-all-grp d-flex">
													<div class="student-ticket-view">
														<h3>30</h3>
														<p>Total Student</p>
													</div>
													<div class="img-deposit-ticket">
														<img src="assets/img/students/profile-user.svg" alt="">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-md-6 d-flex">
										<div class="card stat-info ttl-tickets">
											<div class="card-body">
												<div class="view-all-grp d-flex">
													<div class="student-ticket-view">
														<h3>50</h3>
														<p>Total Approved Course</p>
														<a href="dashboard-instructor.html" >View All</a>
													</div>
													<div class="img-deposit-ticket">
														<img src="assets/img/students/book.svg" alt="">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="settings-widget">
								<div class="settings-inner-blk p-0">
									<div class="comman-space pb-0">
										<div class="filter-grp ticket-grp d-flex align-items-center justify-content-between">
											<h3>Latest Transactions</h3>
										</div>
										<div class="settings-tickets-blk table-responsive">

											<!-- Referred Users-->
											<table class="table table-nowrap mb-0">
												<thead>
												  <tr>
													<th>Referred ID</th>
													<th>Details</th>
													<th>Amount</th>
													<th>Post Balance</th>
												  </tr>
												</thead>
												<tbody>
													<tr>
														<td><a href="javascript:;">K2WX7JJ6R1UA</a></td>
														<td>10 USD Refunded from withdrawal rejection </td>
														<td><span class="text-success">+ $45.00</span></td>
														<td>$45.00</td>
													</tr>
													<tr>
														<td><a href="javascript:;">9RVE1N1TA1H3</a></td>
														<td>Deposit Via Stripe Hosted - USD </td>
														<td><span class="text-success">+ $75.00</span></td>
														<td>$75.00</td>
													</tr>
													<tr>
														<td><a href="javascript:;">C83Z7EQ4A1WX</a></td>
														<td>Deposit Via Stripe Hosted - USD  </td>
														<td><span class="text-success">+ $100.00</span></td>
														<td>$100.00</td>
													</tr>
													<tr>
														<td><a href="javascript:;">1C6A5M4YPV39</a></td>
														<td>Withdraw Via Bank withdrawal </td>
														<td><span class="text-danger">- $5.00</span></td>
														<td>$5.00</td>
													</tr>
													<tr>
														<td><a href="javascript:;">K2WX7JJ6R1UA</a></td>
														<td>10 USD Refunded from withdrawal rejection </td>
														<td><span class="text-danger">- $25.00</span></td>
														<td>$25.00</td>
													</tr>
													<tr>
														<td><a href="javascript:;">KSM5CW4EOEGQ</a></td>
														<td>Added Balance Via Admin  </td>
														<td><span class="text-success">+ $160.00</span></td>
														<td>S160.00</td>
													</tr>
													<tr>
														<td><a href="javascript:;">K2WX7JJ6R1UA</a></td>
														<td>10 USD Refunded from withdrawal rejection </td>
														<td><span class="text-success">+ $150.00</span></td>
														<td> $150.00</td>
													</tr>
													<tr>
														<td><a href="javascript:;">9RVE1N1TA1H3</a></td>
														<td>Deposit Via Stripe Hosted - USD  </td>
														<td><span class="text-success">+ $45.00</span></td>
														<td>$45.00</td>
													</tr>
													<tr>
														<td><a href="javascript:;">C83Z7EQ4A1WX</a></td>
														<td>Deposit Via Stripe Hosted - USD  </td>
														<td><span class="text-success">+ $10.00</span></td>
														<td>$10.00</td>
													</tr>
													<tr>
														<td><a href="javascript:;">1C6A5M4YPV39</a></td>
														<td>Withdraw Via Bank withdrawal </td>
														<td><span class="text-danger">- $10.00</span></td>
														<td>$10.00</td>
													</tr>
												</tbody>
											  </table>
											<!-- /Referred Users-->	

										</div>									
									</div>
								</div>
							</div>
						</div>	
						<!-- Profile Details -->
						
					</div>
				</div>
			</div>	
			<!-- /Dashbord Student -->
			
			<!-- Footer -->
            @include('layout.partials._footer')
			<!-- /Footer -->
		   
		</div>
	   <!-- /Main Wrapper -->
	  
		<!-- jQuery -->
		<script src="{{asset('assets/js/jquery-3.6.0.min.js')}}"></script>
		<script src="{{asset('assets/js/ajax-jquery.min.js')}}"></script>
		
		<!-- Bootstrap Core JS -->
		<script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>

        @stack('js')
		
		<!-- Custom JS -->
		<script src="{{asset('assets/js/script.js')}}"></script>
		
	</body>
</html>