<?php  require 'include/repeated.php';?>

		<div class="ts-main-content"><!-- wraps the sidebar and main body, must always be included-->
		<?php include("include/sidebar.php");?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">

						<h2 class="page-title" style="margin-top:4%">Dashboard</h2>
						
						<div class="row">
							<div class="col-md-12">
								<div class="row">
									<?php $users = $admin->fetchusers(); ?>
									<div class="col-md-4">
										<div class="panel panel-default">
											<div class="panel-body bk-danger text-dark">
												<div class="stat-panel text-center">
												<?php
												//$admin->count_no_of_booked_hostel();

												?>
													
													<div class="stat-panel-title text-uppercase"> <b>All Users
														<div class="stat-panel-number p "><?php echo count($users);?></b></div>
													</div>
												</div>
											</div>
											<a href="users.php" class="block-anchor panel-footer text-center">Full Detail <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-4">
										<div class="panel panel-default">
											<div class="panel-body bk-warning text-dark">
												<div class="stat-panel text-center">
												<?php
												//$admin->count_no_of_booked_hostel();

												?>
													
													<div class="stat-panel-title text-uppercase"><b> Blocked Users
														<div class="stat-panel-number p "><?php echo count($admin->blockedusers());?></b></div>
													</div>
												</div>
											</div>
											<a href="Blocked.php" class="block-anchor panel-footer text-center">Full Detail <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									<div class="col-md-4">
										<div class="panel panel-default">
											<div class="panel-body bk-success text-dark">
												<div class="stat-panel text-center">
													<div class="stat-panel-title text-uppercase"><b>Reports
														<div class="stat-panel-number p "><?php echo count($admin->reports());?></b></div>
													 </div>
												</div>
											</div>
											<a href="reports.php" class="block-anchor panel-footer text-center">See All &nbsp; <i class="fa fa-arrow-right"></i></a>
										</div>
									</div>
									
									
									
								</div>
							</div>
						</div>

					
						
						

					</div>
				</div>

			</div>
		</div>
	</div>
				<?php include 'include/scripts.php'; ?>